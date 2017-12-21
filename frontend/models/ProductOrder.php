<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_order".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $quantity
 * @property double $order_price
 * @property integer $requested_amount
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
            [['order_id', 'quantity', 'requested_amount'], 'integer'],
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
            'id' => 'ID',
            'order_id' => 'Order ID',
            'quantity' => 'Quantity',
            'order_price' => 'Order Price',
            'requested_amount' => 'Requested Amount',
            'requested_price' => 'Requested Price',
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
}
