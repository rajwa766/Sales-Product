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

     public static function insert_shipping_address($model){
        $order_data = json_decode($model->product_order_info);
        foreach ($order_data->order_info as $single_order) {
         $product_order = new ProductOrder();
         $product_order->isNewRecord = true;
         $product_order->id = null;
         $product_order->order_id = $model->id;
         $product_order->email = $single_order->email; 
         $product_order->phone_no =$single_order->phone_no; 
         $product_order->mobile_no =$single_order->mobile_no; 
         $product_order->postal_code = $single_order->postal_code; 
         $product_order->district =$single_order->district; 
         $product_order->province =$single_order->province; 
         $product_order->country = $single_order->country;
         $product_order->save();
     
        }
    }

}
