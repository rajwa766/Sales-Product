<?php

namespace frontend\controllers;

use Yii;
use common\models\Order;
use common\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use common\models\StockIn;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actionIndex() {
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

    public function actionPending() {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);
        $dataProvider->query->andWhere(['o.status' => '0']);

        return $this->render('pending', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCancel() {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);
        $dataProvider->query->andWhere(['o.status' => '2']);

        return $this->render('pending', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved() {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);
        $dataProvider->query->andWhere(['o.status' => '1']);
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
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

    public function actionTransfer() {
        $searchModel = new OrderSearch();
        $user_id = Yii::$app->user->getId();
        $Role = Yii::$app->authManager->getRolesByUser($user_id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['or',
            ['o.status' => '5'],
            ['o.status' => '6']]);
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

    public function actionReturn() {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);
        $dataProvider->query->andWhere(['o.status' => '3']);

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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCustomerCreate() {
        $model = new Order();
        return $this->render('customer_create', [
                    'model' => $model,
        ]);
    }

    public function actionCreate() {
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->order_type == "Order") {
                $model->order_request_id = $model->request_agent_name;
                $model->user_id = $model->rquest_customer;
                $check_user_already_exist = \common\models\User::find()
                        ->where([ 'email' => $model->email])
                        ->one();
                if ($check_user_already_exist) {
                    $model->user_id = $check_user_already_exist->id;
                } else {
                    $customer_user = \common\models\User::insert_user($model);
                    $auth = \Yii::$app->authManager;
                    $role = $auth->getRole('customer');
                    $auth->assign($role, $customer_user->id);
                    $model->user_id = $customer_user->id;
                }
            } else {
                $model->order_request_id = $model->parent_user;
                $model->user_id = $model->child_user;
            }
            if ($model->payment_method == '3') {
                $photo = UploadedFile::getInstance($model, 'payment_slip');

                if ($photo !== null) {
                    $model->payment_slip = $photo->name;
                    $array = explode(".", $photo->name);
                    $ext = end($array);
                    $model->payment_slip = Yii::$app->security->generateRandomString() . ".{$ext}";
                    $path = Yii::getAlias('@app') . '/web/uploads/' . $model->payment_slip;
                    //   $path = Yii::getAlias('@upload') .'/'. $model->payment_slip;
                    $photo->saveAs($path);
                }
            }
            if ($model->save()) {
                $product_order = \common\models\ProductOrder::insert_order_no_js($model);
                $shipping_address = \common\models\ShippingAddress::insert_shipping_address($model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionCreatereturn() {
        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->order_type == "Order") {
                $model->order_request_id = $model->request_agent_name;
                $model->user_id = $model->rquest_customer;
            } else {
                $model->order_request_id = $model->parent_user;
                $model->user_id = $model->child_user;
            }
            if ($model->save()) {
                $product_order = \common\models\ProductOrder::insert_order_no_js($model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create_return', [
                    'model' => $model,
        ]);
    }

    public function actionCreatetransfer() {
        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {
            $model->order_request_id = $model->parent_user;
            $model->user_id = $model->child_user;
            $model->status = '5';
            if ($model->save()) {
                $product_order = \common\models\ProductOrder::insert_order_no_js($model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create_transfer', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionParentuser() {
        $q = Yii::$app->request->get('q');
        $type = Yii::$app->request->get('type');
        $parent = Yii::$app->request->get('parent');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\User::getParent($q, $type, $parent);
    }

    public function actionLevel() {
        $q = Yii::$app->request->get('q');
        $type = Yii::$app->request->get('type');
        $typeone = Yii::$app->request->get('typeone');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\User::getParentUserAdmin($q, $typeone, $type);
    }

    public function actionCustomerLevel() {
        $q = Yii::$app->request->get('q');
        $type = Yii::$app->request->get('type');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\UsersLevel::getCustomers($q, $type);
    }

    public function actionInventoryReports() {
        $model = new Order();
        return $this->render('report', [
                    'model' => $model,
        ]);
    }

    public function actionStatusReports() {
        $model = new Order();
        return $this->render('status_report', [
                    'model' => $model,
        ]);
    }

}
