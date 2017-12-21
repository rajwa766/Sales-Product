<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $payment_detail_id
 *
 * @property Order $order
 * @property PaymentDetail $paymentDetail
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'payment_detail_id'], 'required'],
            [['id', 'order_id', 'payment_detail_id'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['payment_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentDetail::className(), 'targetAttribute' => ['payment_detail_id' => 'id']],
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
            'payment_detail_id' => 'Payment Detail ID',
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
    public function getPaymentDetail()
    {
        return $this->hasOne(PaymentDetail::className(), ['id' => 'payment_detail_id']);
    }
}
