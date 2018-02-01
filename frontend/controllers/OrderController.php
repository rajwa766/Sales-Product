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
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['order_request_id' => Yii::$app->user->identity->id]);
        $dataProvider->query->andWhere(['o.status' => '0']);

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
        $dataProvider->query->andWhere(['o.status' => '2']);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
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

    public function actionTransfer()
    {
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

    public function actionReturn()
    {
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
    public function actionCustomerCreate()
    {
        $model = new Order();
        return $this->render('customer_create', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $type=Yii::$app->request->get('type');
        if(empty($type))
        {
            $type="Order";
        }
        $model = new Order();
        $product=\common\models\Product::findOne(['id'=>'1']);
        if ($model->load(Yii::$app->request->post())) {
           
            $orderCreate = \common\models\Order::CreateOrder($model);
            if ($orderCreate == 'transaction_complete') {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'type'=>$type,
            'product'=>$product,
        ]);
    }

    public function actionCreateReturn()
    {
        $type="Return";
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            $orderCreate = \common\models\Order::CreateOrder($model);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'type'=>$type,
        ]);
    }

    public function actionCreatetransfer()
    {
        $type="Transfer";
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            $orderTransfer = \common\models\Order::CreateOrder($model);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'type'=>$type,
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

   
}
