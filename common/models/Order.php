<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $order_ref_no
 * @property string $shipper
 * @property string $cod
 * @property string $additional_requirements
 * @property string $file
 * @property int $user_id
 * @property int $status
 * @property int $order_request_id
 * @property int $entity_id
 * @property int $entity_type
 * @property string $requested_date
 *
 * @property Account[] $accounts
 * @property User $user
 * @property ProductOrder[] $productOrders
 */
class Order extends \yii\db\ActiveRecord
{
    public $order_type;
    public $all_level;
    public $parent_user;
    public $child_user;
    public $child_level;
    public $request_user_level;
    public $request_agent_name;
    public $rquest_customer;
    public $product_order_info;
    //customer address
    public $address;
    public $phone_no;
    public $mobile_no;
    public $postal_code;
    public $district;
    public $province;
    public $country;
    public $email;
    // stored value
    public $customer_id;
   
   
   

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }
    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_request_id'], 'required'],
            [['user_id', 'status', 'order_request_id', 'entity_id', 'entity_type','all_level','parent_user','child_user','child_level','request_user_level','rquest_customer','customer_id'], 'integer'],
            [['requested_date','order_type','request_agent_name','product_order_info', 'created_at', 'updated_at', 'created_by', 'updated_by','address','city','country','postal_code','district','province','mobile_no','phone_no','email'], 'safe'],
            
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
            'id' => Yii::t('app', 'ID'),
            'order_ref_no' => Yii::t('app', 'Order Ref No'),
            'shipper' => Yii::t('app', 'Shipper'),
            'cod' => Yii::t('app', 'Cod'),
            'additional_requirements' => Yii::t('app', 'Additional Requirements'),
            'file' => Yii::t('app', 'File'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'order_request_id' => Yii::t('app', 'Order Request ID'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'entity_type' => Yii::t('app', 'Entity Type'),
            'requested_date' => Yii::t('app', 'Requested Date'),
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
