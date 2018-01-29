<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shipping_address".
 *
 * @property int $id
 * @property int $order_id
 * @property string $email
 * @property string $phone_no
 * @property string $mobile_no
 * @property string $postal_code
 * @property string $district
 * @property string $province
 * @property string $country
 *
 * @property Order $order
 */
class ShippingAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id'], 'integer'],
            [['email', 'phone_no', 'mobile_no', 'postal_code', 'district', 'province', 'country'], 'string', 'max' => 100],
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
            'email' => Yii::t('app', 'Email'),
            'phone_no' => Yii::t('app', 'Phone No'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'district' => Yii::t('app', 'District'),
            'province' => Yii::t('app', 'Province'),
            'country' => Yii::t('app', 'Country'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    public static function insertShippingAddress($model,$order_id){
        $shipping_address = new ShippingAddress();
        $shipping_address->isNewRecord = true;
        $shipping_address->id = null;
        $shipping_address->order_id = $order_id;
        $shipping_address->email = $model->email; 
        $shipping_address->phone_no =$model->phone_no; 
        $shipping_address->mobile_no =$model->mobile_no; 
        $shipping_address->postal_code = $model->postal_code; 
        $shipping_address->district =$model->district; 
        $shipping_address->province =$model->province; 
        $shipping_address->address =$model->address; 
        $shipping_address->country = $model->country;
       return $shipping_address->save();
    
       
   }

}
