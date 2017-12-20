<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_detail".
 *
 * @property integer $id
 * @property integer $payment_method
 *
 * @property Account[] $accounts
 */
class PaymentDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'payment_method' => Yii::t('app', 'Payment Method'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['payment_detail_id' => 'id']);
    }
}
