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
 * CategoryController implements the CRUD actions for Category model.
 */
class ReportsController extends Controller
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

    public function actionInventoryReport()
{
     $model = new Order(); 
           return $this->render('inventory/index', [
            'model' => $model,
       
            
        ]);
}
public function actionInventoryReportResult(){

    $inventoryArr=array();
    $fromDate = Yii::$app->request->post('from_date');

    $toDate = Yii::$app->request->post('to_date');
    $userId = Yii::$app->request->post('user_id');
 
    if(!$userId){
       $userId = Yii::$app->user->getId();
    }
    $stock_in_hand=0;
    $remaining_stock=0;
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
              $remaining_stock+=$inventory->quantity;
              $inventory->type='Stock In';
              $inventory->product=$stock['name'];
              $inventoryArr[]=$inventory;

           }
            foreach ($stock_out as $stock) {
              $inventory=new \common\models\helpers\reports\InventoryReport();
              $inventory->user=$userame;
              $inventory->date=$stock['stock_out_date'];
              $inventory->quantity=$stock['quantity'];
              $remaining_stock-=$inventory->quantity;
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
          
           $remaining_stock+=$stock_in_hand;
       return $this->renderAjax('inventory/_inventoryreport', [
           'remaining_stock' => $remaining_stock,
           'stock_in_hand' => $stock_in_hand,
           'inventoryArr' => $inventoryArr,
           
       ]);
                       
  
}
public function actionOrderReport()
{
     $model = new Order(); 
           return $this->render('order/index', [
            'model' => $model,
       
            
        ]);
}
public function actionOrderReportResult(){
      $model = new Order(); 
         $fromDate = Yii::$app->request->post('from_date');
         $toDate = Yii::$app->request->post('to_date');
         $userId = Yii::$app->request->post('user_id');
         $status = Yii::$app->request->post('status');
      
         if(!$userId){
            $userId = Yii::$app->user->getId();
         }
         $order  = (new Query()) 
          ->select('*')
          ->from('order')
          ->where(['or',
             ['order_request_id'=>$userId],
             ['user_id'=>$userId]
        ]);
         if(!empty($fromDate))
               $order->andWhere(['>=','DATE(created_at)',$fromDate]);
         if(!empty($toDate))
               $order->andWhere(['<=','DATE(created_at)',$toDate]);
         if(!(empty($status) && $status!="0"))
               $order->andWhere(['=','status',$status]);
        $order= $order->all();
        return $this->renderAjax('order/_orderreport', [
            'order' => $order,
            'model' => $model,
            
        ]);

}
}
