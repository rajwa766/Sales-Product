<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $post_code
 * @property string $district
 * @property string $province
 * @property string $mobile
 * @property string $phone
 * @property string $email
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'post_code', 'district', 'province', 'mobile', 'phone', 'email'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'post_code' => 'Post Code',
            'district' => 'District',
            'province' => 'Province',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }
}
