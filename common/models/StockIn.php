<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_in".
 *
 * @property int $id
 * @property string $timestamp
 * @property int $initial_quantity
 * @property int $remaining_quantity
 * @property double $price
 * @property int $product_id
 * @property int $user_id
 *
 * @property Product $product
 * @property User $user
 * @property StockOut[] $stockOuts
 */
class StockIn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_in';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['initial_quantity', 'remaining_quantity', 'product_id', 'user_id'], 'integer'],
            [['price'], 'number'],
            [['product_id', 'user_id'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'timestamp' => Yii::t('app', 'Timestamp'),
            'initial_quantity' => Yii::t('app', 'Initial Quantity'),
            'remaining_quantity' => Yii::t('app', 'Remaining Quantity'),
            'price' => Yii::t('app', 'Price'),
            'product_id' => Yii::t('app', 'Product ID'),
            'user_id' => Yii::t('app', 'User ID'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOuts()
    {
        return $this->hasMany(StockOut::className(), ['stock_in_id' => 'id']);
    }
}
