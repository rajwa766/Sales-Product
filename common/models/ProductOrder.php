<?php

namespace common\models;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "product_order".
 *
 * @property int $id
 * @property int $order_id
 * @property int $quantity
 * @property double $order_price
 * @property int $requested_amount
 * @property double $requested_price
 *
 * @property Order $order
 * @property StockOut[] $stockOuts
 */
class ProductOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id','product_id', 'quantity', 'requested_quantity'], 'integer'],
            [['order_price', 'requested_price'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'order_price' => Yii::t('app', 'Order Price'),
            'requested_quantity' => Yii::t('app', 'Requested Quantity'),
            'requested_price' => Yii::t('app', 'Requested Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOuts()
    {
        return $this->hasMany(StockOut::className(), ['product_order_id' => 'id']);
    }
    public static function insert_order($model){
        $order_data = json_decode($model->product_order_info);
        foreach ($order_data->order_info as $single_order) {
         $product_order = new ProductOrder();
         $product_order->isNewRecord = true;
         $product_order->id = null;
         $product_order->order_id = $model->id;
         $product_order->product_id = $model->product_id;
         $product_order->quantity = $single_order->unit; 
         $product_order->order_price =$single_order->price; 
         $product_order->requested_price =$single_order->price; 
         $product_order->requested_quantity = $single_order->unit; 
       $product_order->save();
     
        }
    }
    public static function insert_order_no_js($model){
         $product_order = new ProductOrder();
         $product_order->isNewRecord = true;
         $product_order->id = null;
         $product_order->order_id = $model->id;
         $product_order->product_id = $model->product_id;
         $product_order->quantity = $model->entity_type; 
         $product_order->order_price =$model->single_price; 
         $product_order->requested_price =$model->single_price; 
         $product_order->requested_quantity = $model->entity_type; 
      return $product_order->save();
    }
    public static function insert_user_order_js_bonus($model){
          $product_order = new ProductOrder();
          $product_order->isNewRecord = true;
          $product_order->id = null;
          $product_order->order_id = $model->id;
          $product_order->product_id = $model->product_id;
          $product_order->quantity = $model->entity_type; 
          $product_order->order_price ='0'; 
          $product_order->requested_price ='0'; 
          $product_order->requested_quantity = $model->entity_type; 
       return $product_order->save();
     }
    public static function insert_user_order_exel($model,$order){
       
      
         $product_order = new ProductOrder();
         $product_order->isNewRecord = true;
         $product_order->id = null;
         $product_order->order_id = $order->id;
         $product_order->product_id = '1';
         $product_order->quantity = $order->entity_type; 
         $product_order->order_price =$model->price; 
         $product_order->requested_price =$model->price; 
         $product_order->requested_quantity = $order->entity_type; 
       $product_order->save();
     
        
    }
    public static function insert_user_order($model,$order){
        $order_data = json_decode($model->product_order_info);
        foreach ($order_data->order_info as $single_order) {
         $product_order = new ProductOrder();
         $product_order->isNewRecord = true;
         $product_order->id = null;
         $product_order->order_id = $order->id;
         $product_order->product_id = '1';
         $product_order->quantity = $single_order->unit; 
         $product_order->order_price =$single_order->price; 
         $product_order->requested_price =$single_order->price; 
         $product_order->requested_quantity = $single_order->unit; 
       $product_order->save();
        }
    }
    public static function insert_user_order_js($model,$order){
         $product_order = new ProductOrder();
         $product_order->isNewRecord = true;
         $product_order->id = null;
         $product_order->order_id = $order->id;
         $product_order->product_id = '1';
         $product_order->quantity = $model->entity_type; 
         $product_order->order_price =$model->single_price; 
         $product_order->requested_price =$model->single_price; 
         $product_order->requested_quantity = $model->entity_type; 
       $product_order->save();
        
    }
    public static function order_quantity($order_id){
        return $order_quantity = (new Query())
        ->select('*')
        ->from('product_order')   
        ->where("order_id = '$order_id'")
        ->all();
    
    }
}
