<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_product_level".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $units
 * @property double $price
 * @property integer $user_level_id
 *
 * @property Product $product
 * @property UsersLevel $userLevel
 */
class UserProductLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_product_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'user_level_id'], 'required'],
            [['product_id', 'units', 'user_level_id'], 'integer'],
            [['price'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersLevel::className(), 'targetAttribute' => ['user_level_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'units' => 'Units',
            'price' => 'Price',
            'user_level_id' => 'User Level ID',
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
    public function getUserLevel()
    {
        return $this->hasOne(UsersLevel::className(), ['id' => 'user_level_id']);
    }
}
