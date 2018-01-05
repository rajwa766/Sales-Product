<?php

namespace common\models;
use yii\db\Query;

use Yii;

/**
 * This is the model class for table "stock_in".
 *
 * @property int $id
 * @property string $timestamp
 * @property int $initial_quantity
 * @property int $remaining_quantity
 * @property double $price
 * @property int $product_id
 * @property int $user_id
 *
 * @property Product $product
 * @property User $user
 * @property StockOut[] $stockOuts
 */
class StockIn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_in';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['initial_quantity', 'remaining_quantity', 'product_id', 'user_id'], 'integer'],
            [['price'], 'number'],
            [['product_id', 'user_id'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'initial_quantity' => Yii::t('app', 'Initial Quantity'),
            'remaining_quantity' => Yii::t('app', 'Remaining Quantity'),
            'price' => Yii::t('app', 'Price'),
            'product_id' => Yii::t('app', 'Product ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOuts()
    {
        return $this->hasMany(StockOut::className(), ['stock_in_id' => 'id']);
    }
    public static function insert_quantity($product_id,$price,$quantity,$user_id){
          $stockIn = new StockIn();
          $stockIn->isNewRecord = true;
          $stockIn->id = null;
          $stockIn->initial_quantity = $quantity;
          $stockIn->remaining_quantity = $quantity;
          $stockIn->price = $price;
          $stockIn->product_id = $product_id;
          $stockIn->user_id = $user_id;
      return  $stockIn->save();
     }
     public static function update_quantity($id,$amount){
     return    Yii::$app->db->createCommand()
        ->update('stock_in', ['remaining_quantity' =>$amount ], 'id =' . $id)
        ->execute();
   }
    public static function avilaible_quantity($product_id,$request_user_id){
        return $order_quantity = (new Query())
        ->select('*')
        ->from('stock_in')   
        ->where("user_id = '$request_user_id'")
        ->andWhere("product_id = '$product_id'")
        ->andWhere("remaining_quantity > '0'")
        ->limit('1')
        ->one();
       
    }

    public function stockInReport($user_id)
    {

    return  $model = User::find()
    ->where(['user_id' => $user_id])
    
    ->all();
    }
}
