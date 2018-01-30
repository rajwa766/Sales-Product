<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_level".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $max_user
 *
 * @property UserProductLevel[] $userProductLevels
 */
class UsersLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'max_user'], 'integer'],
            [['name'], 'string', 'max' => 450],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'User Type'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'max_user' => Yii::t('app', 'Max User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProductLevels()
    {
        return $this->hasMany(UserProductLevel::className(), ['user_level_id' => 'id']);
    }
    public static function getalllevel(){
         $data= UsersLevel::find()->where(['!=', 'max_user', '-1'])->all();
         $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption
      return $value;
   }
   public static function getalllevel_with_seller(){
    $data= UsersLevel::find()->all();
    $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption
 return $value;
}
public static function customer_by_parent_with_param($q,$type){
      
    $query = new \yii\db\Query();
    $query->select('id as id, name AS text')
            ->from('users_level')
            ->where(['like', 'name', $q])
            ->andWhere(['=', 'parent_id', $type])
           ->limit(20);
    $command = $query->createCommand();
 return   $data = $command->queryAll();
}
public static function customer_by_parent($type){
    $query = new \yii\db\Query();
    $query->select('id as id, name AS text')
            ->from('users_level')
           ->where(['=', 'parent_id', $type])
           ->limit(20);
    $command = $query->createCommand();
  return  $data = $command->queryAll();
}
public static function all_level_seach($q){
    $query = new \yii\db\Query();
    $query->select('id as id, name AS text')
            ->from('users_level')
            ->where(['like', 'name', $q])
            ->andWhere(['!=', 'max_user', '-1'])
           ->limit(20);
    $command = $query->createCommand();
    return $data = $command->queryAll();
}
public static function all_level_with_param($q,$type,$company_user){
    $query = new \yii\db\Query();
    $query->select('id as id, name AS text')
            ->from('users_level')
            ->where(['like', 'name', $q]);
            if($company_user == '1'){
               $query->andWhere(['>=', 'parent_id', $type]);
            }else{
               $query->andWhere(['=', 'parent_id', $type]);
            }
          $query->limit(20);
    $command = $query->createCommand();
   return $data = $command->queryAll();
}
public static function all_levels($type,$company_user){
    $query = new \yii\db\Query();
    $query->select('id as id, name AS text')
            ->from('users_level');
            if($company_user == '1'){
               $query->andWhere(['>=', 'parent_id', $type]);
            }else{
               $query->andWhere(['=', 'parent_id', $type]);
            }
            $query->limit(20);
    $command = $query->createCommand();
   return  $data = $command->queryAll();
}
    public static function getlevel(){
       $parent_id =  Yii::$app->user->identity->user_level_id;
        $data= UsersLevel::find()->where(['=','parent_id',$parent_id])->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption
     return $value;
  }
}
