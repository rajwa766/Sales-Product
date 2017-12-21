<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $order_ref_no
 * @property string $shipper
 * @property string $cod
 * @property string $additional_requirements
 * @property string $file
 * @property integer $user_id
 * @property integer $status
 * @property integer $order_request_id
 * @property integer $entity_id
 * @property integer $entity_type
 * @property string $requested_date
 *
 * @property Account[] $accounts
 * @property User $user
 * @property ProductOrder[] $productOrders
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_request_id'], 'required'],
            [['user_id', 'status', 'order_request_id', 'entity_id', 'entity_type'], 'integer'],
            [['requested_date'], 'safe'],
            [['order_ref_no', 'shipper', 'cod', 'additional_requirements'], 'string', 'max' => 45],
            [['file'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_ref_no' => 'Order Ref No',
            'shipper' => 'Shipper',
            'cod' => 'Cod',
            'additional_requirements' => 'Additional Requirements',
            'file' => 'File',
            'user_id' => 'User ID',
            'status' => 'Status',
            'order_request_id' => 'Order Request ID',
            'entity_id' => 'Entity ID',
            'entity_type' => 'Entity Type',
            'requested_date' => 'Requested Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['order_id' => 'id']);
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
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::className(), ['order_id' => 'id']);
    }
}
