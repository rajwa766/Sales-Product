<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_product_level".
 *
 * @property integer $id
 * @property integer $user_level_id
 * @property integer $product_id
 * @property integer $units
 * @property double $price
 *
 * @property Product $product
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
            [['user_level_id', 'product_id'], 'required'],
            [['user_level_id', 'product_id', 'units'], 'integer'],
            [['price'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_level_id' => Yii::t('app', 'User Level ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'units' => Yii::t('app', 'Units'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
