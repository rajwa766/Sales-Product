<?php

namespace frontend\controllers;

use Yii;
use common\models\Order;
use common\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $Role =   Yii::$app->authManager->getRolesByUser($user_id);
        if(!isset($Role['super_admin'])){
            $dataProvider->query->andwhere(['created_by'=>Yii::$app->user->identity->id]);
            
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
        $dataProvider->query->andwhere(['order_request_id'=>Yii::$app->user->identity->id]);
        $dataProvider->query->andwhere(['o.status'=>'0']);
        return $this->render('pending', [
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
        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {
         
            if($model->order_type == "Order"){
                $model->order_request_id = $model->request_agent_name;
                $model->user_id = $model->rquest_customer;  
            }else{
                $model->order_request_id = $model->parent_user;
                $model->user_id = $model->child_user;
            }

            if($model->save()){
                $product_order = \common\models\ProductOrder::insert_order($model);
              
                if($product_order){
                    $shipping_address = \common\models\ShippingAddress::insert_shipping_address($model);
                
                }
             
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
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

    public function actionParentuser() {
        $q = Yii::$app->request->get('q');
      //  $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type');
    
     
        if(empty($type)){
            return [];
        }
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
         if (!is_null($q)) {
           $query = new \yii\db\Query();
             $query->select('id as id, username AS text')
                     ->from('user')
                     ->where(['like', 'username', $q])
                     ->andWhere(['=', 'user_level_id', $type])
                   //  ->andWhere(['like','customer_user_id',$customer_id])
                    ->limit(20);
             
             $command = $query->createCommand();
             $data = $command->queryAll();
             // if($data){
             $out['results'] = array_values($data);
        }
        
        else{
         $query = new \yii\db\Query();
         $query->select('id as id, username AS text')
                 ->from('user')
                ->where(['=', 'user_level_id', $type])
                ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
        }
     return $out;
 }

 public function actionLevel() {
    $q = Yii::$app->request->get('q');
  //  $id = Yii::$app->request->get('id');
    $type = Yii::$app->request->get('type');
   $typeone = Yii::$app->request->get('typeone');
 
    if(empty($type)){
        return [];
    }
     if(empty($typeone)){
        return [];
    }
 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 $out = ['results' => ['id' => '', 'text' => '']];
     if (!is_null($q)) {
       $query = new \yii\db\Query();
         $query->select('id as id, username AS text')
                 ->from('user')
                 ->where(['like', 'username', $q])
                 ->andWhere(['=', 'parent_id', $type])
                   ->andWhere(['=', 'user_level_id', $typeone])

               //  ->andWhere(['like','customer_user_id',$customer_id])
                ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
    }
    
    else{
     $query = new \yii\db\Query();
     $query->select('id as id, username AS text')
             ->from('user')
            ->where(['=', 'parent_id', $type])
                ->andWhere(['=', 'user_level_id', $typeone])
            ->limit(20);
     
     $command = $query->createCommand();
     $data = $command->queryAll();
     // if($data){
     $out['results'] = array_values($data);
    }
 return $out;
}

public function actionCustomerLevel() {
    $q = Yii::$app->request->get('q');
  //  $id = Yii::$app->request->get('id');
    $type = Yii::$app->request->get('type');

 
    if(empty($type)){
        return [];
    }
 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 $out = ['results' => ['id' => '', 'text' => '']];
     if (!is_null($q)) {
       $query = new \yii\db\Query();
         $query->select('id as id, name AS text')
                 ->from('users_level')
                 ->where(['like', 'name', $q])
                 ->andWhere(['=', 'parent_id', $type])
               //  ->andWhere(['like','customer_user_id',$customer_id])
                ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
    }
    
    else{
     $query = new \yii\db\Query();
     $query->select('id as id, name AS text')
             ->from('users_level')
            ->where(['=', 'parent_id', $type])
            ->limit(20);
     
     $command = $query->createCommand();
     $data = $command->queryAll();
     // if($data){
     $out['results'] = array_values($data);
    }
 return $out;
}

}
