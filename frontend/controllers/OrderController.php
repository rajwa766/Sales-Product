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
        $dataProvider->query->where(['order_request_id'=>Yii::$app->user->identity->id]);
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
              
               
                    $shipping_address = \common\models\ShippingAddress::insert_shipping_address($model);
               
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

public function actionGetReports()
{
     $model = new Order(); 
           return $this->render('report', [
            'model' => $model,
       
            
        ]);
}


public function actionAjaxreport(){

         $inventoryArr=array();
         $fromDate = Yii::$app->request->post('from_date');
    
         $toDate = Yii::$app->request->post('to_date');
         $userId = Yii::$app->user->getId();
         $stock_in_hand=0;
         $userame = Yii::$app->user->identity->username;

                $stock_in  = (new Query()) 
                               ->select('*')
                               ->from('stock_in')
                               ->innerJoin('product', 'product.id = stock_in.product_id')
                               ->where(['=','stock_in.user_id',$userId]);
                               if(!empty($fromDate))
                                    $stock_in->andWhere(['>=','DATE(stock_in.timestamp)',$fromDate]);
                                if(!empty($toDate))
                                    $stock_in->andWhere(['<=','DATE(stock_in.timestamp)',$toDate]);
                $stock_in=$stock_in->all();
        
                $stock_out  = (new Query()) 
                              ->select('*,stock_out.timestamp as stock_out_date')
                               ->from('stock_out')
                               ->innerJoin('stock_in', 'stock_out.stock_in_id = stock_in.id')
                               ->innerJoin('product', 'product.id = stock_in.product_id')
                               ->where(['=','stock_in.user_id',$userId]);
                              if(!empty($fromDate))
                                    $stock_out->andWhere(['>=','DATE(stock_out.timestamp)',$fromDate]);
                              if(!empty($toDate))
                                    $stock_out->andWhere(['<=','DATE(stock_out.timestamp)',$toDate]);
                $stock_out= $stock_out->all();
               
                foreach ($stock_in as $stock) {
                   $inventory=new \common\models\helpers\reports\InventoryReport();
                   $inventory->user=$userame;
                   $inventory->date=$stock['timestamp'];
                   $inventory->quantity=$stock['initial_quantity'];
                   $inventory->type='Stock In';
                   $inventory->product=$stock['name'];
                   $inventoryArr[]=$inventory;

                }
                 foreach ($stock_out as $stock) {
                   $inventory=new \common\models\helpers\reports\InventoryReport();
                   $inventory->user=$userame;
                   $inventory->date=$stock['stock_out_date'];
                   $inventory->quantity=$stock['quantity'];
                   $inventory->type='Stock Out';
                   $inventory->product=$stock['name'];
                   $inventoryArr[]=$inventory;

                }
                usort($inventoryArr, function($a, $b) {
                    return strtotime($a['date']) - strtotime($b['date']);
                });
                if(!empty($fromDate))
                {
                        $result=(new Query()) 
                               ->select('SUM(initial_quantity) as initial_quantity,sum(remaining_quantity) as remaining_quantity')
                               ->from('stock_in')
                               ->where(['=','stock_in.user_id',$userId])
                               ->andWhere(['<','DATE(stock_in.timestamp)',$fromDate])->one();
                               try
                               {
                                  $stock_in_hand=  $result['initial_quantity'] -$result['remaining_quantity'];
                               }
                               catch(Exception $e)
                               {

                               }
           
                }
               

            return $this->renderAjax('report_view', [
                'stock_in_hand' => $stock_in_hand,
                'inventoryArr' => $inventoryArr,
                
            ]);
                            
       
}

}