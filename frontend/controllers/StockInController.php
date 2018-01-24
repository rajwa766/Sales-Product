<?php

namespace frontend\controllers;

use Yii;
use common\models\StockIn;
use common\models\StockInSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;


/**
 * StockInController implements the CRUD actions for StockIn model.
 */
class StockInController extends Controller
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
     * Lists all StockIn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StockInSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StockIn model.
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
     * Creates a new StockIn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StockIn();

        if ($model->load(Yii::$app->request->post())) {
            $model->remaining_quantity = $model->initial_quantity;
            $model->user_id = Yii::$app->user->identity->id;
            $model->product_id = '1';
           
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionCancel()
    {
        $data = Yii::$app->request->post();
        $order_id = $data['id'];
        $order_detail = \common\models\Order::find()->where(['id'=>$order_id])->one();
      
       if($order_detail->status == '5'){
        Yii::$app->db->createCommand()
        ->update('order', ['status' =>'7'], 'id =' . $order_id)
        ->execute();
       }elseif($order_detail->status == '3'){
        Yii::$app->db->createCommand()
        ->update('order', ['status' =>'8'], 'id =' . $order_id)
        ->execute();
    }else{
        Yii::$app->db->createCommand()
        ->update('order', ['status' =>'2'], 'id =' . $order_id)
        ->execute();
       }
      
        return true;
    }
    public function actionApprove()
    {
        $data = Yii::$app->request->post();
        $order_id = $data['id'];
        $user_id = $data['user_id'];
        $order_request_id = $data['order_request_id'];
        $stock_available = true;
        $total_order_quantity = \common\models\ProductOrder::order_quantity($order_id);
        $transaction_failed=false;
       $transaction = Yii::$app->db->beginTransaction();
   
        try 
        {
        foreach($total_order_quantity as $single_order){
           
            if($transaction_failed)
            {
                break;
            }
            while($single_order['quantity']>0){
                $stockin_quantity = \common\models\StockIn::avilaible_quantity($single_order['product_id'],$order_request_id);
                if($stockin_quantity != null){
    //  subtract the quantiy 
                $single_order['quantity'] = $single_order['quantity'] - $stockin_quantity['remaining_quantity'];
                // insert stock out 
            //    update stock in
              
                   if($single_order['quantity']> 0){
                   \common\models\StockIn::update_quantity($stockin_quantity['id'],0);
                   // insert stock in
                   \common\models\StockOut::insert_quantity($single_order['id'],$stockin_quantity['id'], $stockin_quantity['remaining_quantity']);
                 \common\models\StockIn::insert_quantity($single_order['product_id'],$single_order['order_price'],abs($single_order['quantity']),$user_id);
                   }else{
                    \common\models\StockIn::update_quantity($stockin_quantity['id'],abs($single_order['quantity']));
                    $stock_out_quantity= $stockin_quantity['remaining_quantity']+$single_order['quantity'] ;
                         // insert stock in
                 \common\models\StockOut::insert_quantity($single_order['id'],$stockin_quantity['id'],$stock_out_quantity);
                 \common\models\StockIn::insert_quantity($single_order['product_id'],$single_order['order_price'],$stock_out_quantity,$user_id);
                 
                   }
              
                
                
                }else{
                    $transaction_failed=true;
                    break;
                }
                
                    }
                   
    }
 
       
    }catch (Exception $e) 
    {
        $transaction_failed=true;
      
    }
   if($transaction_failed)
   {
    $transaction->rollBack();
    echo false;
   }
   else
   {
 //Bonus Calculation for parents
 $level_id = \common\models\User::findOne(['id'=>$order_request_id]);
 $level_id = $level_id->user_level_id;
 $order = \common\models\Order::findOne(['id'=>$order_id]);
 
 if($level_id != '1' && $order->status != '3' && $order->status != '5' ){
  
     $level_for_bonus = \common\models\LevelPercentage::findOne(['level_id'=>$level_id]);
             $parent_level = $level_for_bonus['parent_id'];
             if($parent_level == 2 && $level_for_bonus['is_company_wide'] == true){
                 $parent_users = \common\models\User::find()->where(['user_level_id'=>$parent_level])->all();
                 $total_user = (int) count($parent_users);
                 $single_price = (int)$level_for_bonus->percentage/$total_user;
                 $bonus_amount =  $single_price * (int)$order->entity_type;
               
                 foreach($parent_users as $parent_user){
                     $account_id = \common\models\Account::findOne(['user_id'=>$parent_user->id]);
                   
                     $gl = \common\models\Gl::create_gl(strval($bonus_amount),$account_id->id,$order_id,'1');
                    
                 }
             }
     
               //Bonus Calculation for current user
  $level_id = \common\models\User::findOne(['id'=>$user_id]);
  $level_id = $level_id->user_level_id;
  $level_for_bonus_itself = \common\models\LevelPercentage::find()->where(['level_id'=>$level_id])->andwhere(['parent_id'=>$level_id])->one();;
  $account_id = \common\models\Account::findOne(['user_id'=>$user_id]);
  $gl = \common\models\Gl::create_gl($level_for_bonus_itself['percentage'],$account_id->id,$order_id,'1');
 }
    $transaction->commit();  
  
    $order_detail = \common\models\Order::find()->where(['id'=>$order_id])->one();
    if($order_detail->status == '5'){
        \common\models\Order::update_transfer_status($order_id);
        
    }elseif($order_detail->status == '3'){
        \common\models\Order::update_return_status($order_id);
        
    }else{
        \common\models\Order::update_status($order_id);
        
    }
    echo true;
   }
    }
    /**
     * Updates an existing StockIn model.
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
    public function actionGetunits($id,$user_id){
        $order_quantity = (new Query())
        ->select('SUM(remaining_quantity) as remaning_stock')
        ->from('stock_in')   
        ->where("user_id = '$user_id'")
        ->andWhere("product_id = '$id'")
        ->groupby(['product_id'])
        ->one();
     return $order_quantity['remaning_stock'];
    }
    public function actionAllstock(){
        $q = Yii::$app->request->get('q');
        //  $id = Yii::$app->request->get('id');
          $type = Yii::$app->request->get('type');
          $type_order = Yii::$app->request->get('type_order');
          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          $out = ['results' => ['id' => '', 'text' => '']];
     
             
            if (!is_null($q)) {
                $query = new \yii\db\Query();
                  $query->select('stock_in.id as id, stock_in.remaining_quantity AS text')
                          ->from('stock_in')
                          ->join('join product on stock_in.product_id=product.id', [])
                          ->where(['like', 'product.name', $q])
                          ->andWhere(['=', 'stock_in.user_id', $type])
                      ->andWhere(['=','stock_in.product_id',$type_order])
                         ->limit(20);
                  
                  $command = $query->createCommand();
                  $data = $command->queryAll();
                  // if($data){
                  $out['results'] = array_values($data);
             }
             
             else{
              $query = new \yii\db\Query();
              $query->select('stock_in.id as id, stock_in.remaining_quantity AS text')
              ->from('stock_in')
              ->join('join product on stock_in.product_id=product.id', [])
             // ->where(['like', 'product.name', $q])
              ->andWhere(['=', 'stock_in.user_id', $type])
          ->andWhere(['=','stock_in.product_id',$type_order])
             ->limit(20);
              
              $command = $query->createCommand();
              $data = $command->queryAll();
              // if($data){
              $out['results'] = array_values($data);
             }
            
  
     
       return $out;
    }
    /**
     * Deletes an existing StockIn model.
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
     * Finds the StockIn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StockIn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StockIn::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
