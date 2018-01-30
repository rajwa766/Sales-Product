<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'post_code' => Yii::t('app', 'Post Code'),
            'district' => Yii::t('app', 'District'),
            'province' => Yii::t('app', 'Province'),
            'mobile' => Yii::t('app', 'Mobile'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
    public static function all_customer_with_param($q){
        $query = new \yii\db\Query();
        $query->select('id as id, username AS text')
                ->from('user')
                ->where(['like', 'username', $q])
                ->andWhere(['user_level_id'=>Null])
                ->andWhere(['parent_id'=>Null])
               ->limit(20);
        $command = $query->createCommand();
       return $data = $command->queryAll();
    }
    public static function all_customer(){
        $query = new \yii\db\Query();
        $query->select('id as id, username AS text')
                ->from('user')
                ->where(['user_level_id'=>Null])
                ->andWhere(['parent_id'=>Null])
               ->limit(20);
        $command = $query->createCommand();
     return   $data = $command->queryAll();
    }
}
