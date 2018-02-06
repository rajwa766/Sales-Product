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
        var_dump($dataProvider);
        exit();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPending()
    {
        $pending_status = array_search('Pending', \common\models\Lookup::$status);
        $searchModel = new OrderSearch();
        $searchModel->status=$pending_status;
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
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);
        $cancel_status = array_search('Request Canceled', \common\models\Lookup::$status);
        $dataProvider->query->andWhere(['o.status' => $cancel_status]);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $approved_status = array_search('Approved', \common\models\Lookup::$status);
        $dataProvider->query->where(['o.status' => $approved_status]);
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        if (!isset($Role['super_admin'])) {
            $dataProvider->query->andFilterWhere(['or',
                ['order_request_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id]]);
        }
        
       
        if (isset($Role['super_admin'])) {
            $view = 'pending';
        } else {
            $view = 'index';
        }
        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransfer()
    {
        $searchModel = new OrderSearch();
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $transfer_request_status = array_search('Transfer Request', \common\models\Lookup::$status);
        $dataProvider->query->where(['o.status' => $transfer_request_status]);
        if (isset($Role['super_admin'])) {
            $view = 'transfer';
        } else {
            $dataProvider->query->andFilterWhere(['or',
                ['order_request_id' => Yii::$app->user->identity->id],
                ['user_id' => Yii::$app->user->identity->id]]);
            $view = 'customer_transfer';
        }

        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReturn()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $return_request_status = array_search('Return Request', \common\models\Lookup::$status);
        $dataProvider->query->where(['o.status' => $return_request_status]);
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

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
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
                return $this->redirect(['view', 'id' => $model->id]);
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
        $type = "Order";
        $model = $this->findModel($id);
        $model = Order::getShippingDetail($model);
        $model = \common\models\User::RequestedUserDetail($model);
        $model = \common\models\ProductOrder::productOrderDetail($model);
        $currentStock = \common\models\helpers\Statistics::CurrentStock($model->request_agent_name);
        $model->total_stock = $currentStock;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $isOrderSaved=$model->save();
            $isShippingSaved=\common\models\ShippingAddress::updateShippingAddress($model);
            $isProductOrderSaved=\common\models\ProductOrder::updateProductOrder($model);
            if($isShippingSaved && $isProductOrderSaved && $isOrderSaved)
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                $result = array("error"=>"Some error occured, please try again later.");
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
        $this->findModel($id)->delete();

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
