<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gl".
 *
 * @property int $id
 * @property string $amount
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $payment_detail_id
 * @property int $order_id
 * @property int $account_id
 *
 * @property Account $account
 * @property Order $order
 * @property PaymentDetail $paymentDetail
 */
class Gl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'payment_detail_id', 'order_id', 'account_id'], 'integer'],
            [['payment_detail_id', 'order_id', 'account_id'], 'required'],
            [['amount'], 'string', 'max' => 45],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
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
            'id' => Yii::t('app', 'ID'),
            'amount' => Yii::t('app', 'Amount'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'payment_detail_id' => Yii::t('app', 'Payment Detail ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'account_id' => Yii::t('app', 'Account ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
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
