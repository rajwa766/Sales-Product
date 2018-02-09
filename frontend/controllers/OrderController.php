<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\OrderSearch;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        if (!isset($Role['super_admin'])) {
            $dataProvider->query->andwhere(['created_by' => Yii::$app->user->identity->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPending()
    {
        $pending_status = array_search('Pending', \common\models\Lookup::$status);
        $searchModel = new OrderSearch();
        $searchModel->status = $pending_status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        if (!isset($Role['super_admin'])) {
            $dataProvider->query->andFilterWhere(['or',
                ['order_request_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id]]);
        }

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCancel()
    {
        $cancel_status = array_search('Request Canceled', \common\models\Lookup::$status);
        $searchModel = new OrderSearch();
        $searchModel->status = $cancel_status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
        $approved_status = array_search('Approved', \common\models\Lookup::$status);
        $searchModel = new OrderSearch();
        $searchModel->status = $approved_status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        if (!isset($Role['super_admin'])) {
            $dataProvider->query->andFilterWhere(['or',
                ['order_request_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id]]);
        }
        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransfer()
    {
        $transfer_request_status = array_search('Transfer Request', \common\models\Lookup::$status);
        $searchModel = new OrderSearch();
        $searchModel->status = $transfer_request_status;
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (!isset($Role['super_admin'])) {
            $dataProvider->query->andFilterWhere(['or',
                ['order_request_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id]]);
        }
        return $this->render("transfer", [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReturn()
    {
        $return_request_status = array_search('Return Request', \common\models\Lookup::$status);
        $searchModel = new OrderSearch();
        $searchModel->status = $return_request_status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        if (!isset($Role['super_admin'])) {
            $dataProvider->query->andFilterWhere(['or',
                ['order_request_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id]]);
        }
        return $this->render('return', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPaymentMethod()
    {
        $method = Yii::$app->request->post('payment_method');
        $id = Yii::$app->request->post('id');
        if ($method) {
            $paymentCard = array_search('Credit Card', \common\models\Lookup::$order_status);
            Yii::$app->db->createCommand()
                ->update('order', ['status' => $paymentCard], 'id =' . $id)
                ->execute();
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            $this->actionUpdate($id);
        }

    }
    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->order_external_code != null) {
            $response = \common\models\StockIn::GetOrderExternalStatus($model->order_external_code);
            if ($response != null) {

                $response = json_decode($response);
                if ($model->shipping_status != $response->shipping_status) {
                    $model->shipping_status = $response->shipping_status;
                    $model->order_tracking_code = $response->tracking_no;
                    $model->save();
                }
            }
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    public function actionPayment($id)
    {
        return $this->render('payment', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $type = Yii::$app->request->get('type');
        if (empty($type)) {
            $type = "Order";
        }
        $model = new Order();
        $product = \common\models\Product::findOne(['id' => '1']);
        if ($model->load(Yii::$app->request->post())) {

            $orderCreate = \common\models\Order::CreateOrder($model);
            if ($orderCreate == 'transaction_complete') {
                // $orderStatus = array_search('Payment Pending', \common\models\Lookup::$status);
                // if ($model->status == $orderStatus) {
                //     return $this->redirect(['payment', 'id' => $model->id]);
                // } else {
                return $this->redirect(['view', 'id' => $model->id]);
                // }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'type' => $type,
            'product' => $product,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model = Order::updateBeforeLoad($model);
        $type = $model->order_type;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $isOrderSaved = \common\models\Order::updateSave($model);
          
            $isShippingSaved = \common\models\ShippingAddress::updateShippingAddress($model);
            $isProductOrderSaved = \common\models\ProductOrder::updateProductOrder($model);
            if ($isShippingSaved && $isProductOrderSaved && $isOrderSaved) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $result = array("error" => "Some error occured, please try again later.");
                return $this->redirect(['error', 'error' => $result["error"]]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $Role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id);
        if($model!=null && ($model->created_by==Yii::$app->user->identity->id || isset($Role['super_admin'])))
        {
            Yii::$app->db->createCommand()->delete('shipping_address', 'order_id = ' . $id)->execute();
            Yii::$app->db->createCommand()->delete('product_order', 'order_id = ' . $id)->execute();
            $model->delete();
        }
        return $this->redirect(['index']);
    }
    public function actionError($error)
    {
        return $this->render('error', [
            'error' => $error,
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
