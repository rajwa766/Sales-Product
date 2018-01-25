<?php
namespace common\models;
use yii\db\Query;
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
    public static function approve($order_id,$user_id,$order_request_id )
    {
        $data = Yii::$app->request->post();
       
        $stock_available = true;
        $total_order_quantity = \common\models\ProductOrder::order_quantity($order_id);
        $transaction_failed=false;
        $transaction = Yii::$app->db->beginTransaction();
        try 
        {
            foreach($total_order_quantity as $single_order){
            
                if($transaction_failed)
                {
                    break;
                }
                while($single_order['quantity']>0){
                    $stockin_quantity = \common\models\StockIn::avilaible_quantity($single_order['product_id'],$order_request_id);
                    if($stockin_quantity != null){
                        //  subtract the quantiy 
                        $single_order['quantity'] = $single_order['quantity'] - $stockin_quantity['remaining_quantity'];
                        // insert stock out and update stock in
                    if($single_order['quantity']> 0){
                            \common\models\StockIn::update_quantity($stockin_quantity['id'],0);
                            \common\models\StockOut::insert_quantity($single_order['id'],$stockin_quantity['id'], $stockin_quantity['remaining_quantity']);
                            \common\models\StockIn::insert_quantity($single_order['product_id'],$single_order['order_price'],abs($single_order['quantity']),$user_id);
                    }else{
                            \common\models\StockIn::update_quantity($stockin_quantity['id'],abs($single_order['quantity']));
                            $stock_out_quantity= $stockin_quantity['remaining_quantity']+$single_order['quantity'] ;
                            \common\models\StockOut::insert_quantity($single_order['id'],$stockin_quantity['id'],$stock_out_quantity);
                            \common\models\StockIn::insert_quantity($single_order['product_id'],$single_order['order_price'],$stock_out_quantity,$user_id);
                    }
                
                    }else{
                        $transaction_failed=true;
                        
                        break;
                    }
                    
                }
        }
    }catch (Exception $e) 
    {
        $transaction_failed=true;
    }
   if($transaction_failed)
   {
        $transaction->rollBack();
        echo false;
   }
   else
   {
    $total_amount=array_sum($total_order_quantity['total_price']);
    \common\models\Gl::create_gl($total_amount,$user_id,$order_request_id,$order_id,'1');
    //Bonus Calculation for parents
    $level_id = \common\models\User::findOne(['id'=>$order_request_id]);
    $level_id = $level_id->user_level_id;
    if($level_id != '1'){
                $level_for_bonus = \common\models\LevelPercentage::findOne(['level_id'=>$level_id]);
                $parent_level = $level_for_bonus['parent_id'];
                $order = \common\models\Order::findOne(['id'=>$order_id]);
                if($parent_level == 2 && $level_for_bonus['is_company_wide'] == true){
                    $parent_users = \common\models\User::find()->where(['user_level_id'=>$parent_level])->all();
                    $total_user = (int) count($parent_users);
                    $single_price = (int)$level_for_bonus->percentage/$total_user;
                    $bonus_amount =  $single_price * (int)$order->entity_type;
                    foreach($parent_users as $parent_user){
                        \common\models\Gl::create_gl(strval($bonus_amount),$parent_user->id,1,$order_id,'1');
                       
                    }
                }
        
        //Bonus Calculation for current user
        $level_id = \common\models\User::findOne(['id'=>$user_id]);
        $level_id = $level_id->user_level_id;
        $level_for_bonus_itself = \common\models\LevelPercentage::find()->where(['level_id'=>$level_id])->andwhere(['parent_id'=>$level_id])->one();;
        $account_id = \common\models\Account::findOne(['user_id'=>$user_id]);
        \common\models\Gl::create_gl($level_for_bonus_itself['percentage'],$$user_id,1,$order_id,'1');
    }
    $transaction->commit();    
    \common\models\Order::update_status($order_id);
    echo true;
   }
    }
    public static function insert_quantity($product_id,$price,$quantity,$user_id){
          $stockIn = new StockIn();
          $stockIn->isNewRecord = true;
          $stockIn->id = null;
          $stockIn->initial_quantity = $quantity;
          $stockIn->remaining_quantity = $quantity;
          $stockIn->price = $price;
          $stockIn->product_id = $product_id;
          $stockIn->user_id = $user_id;
      return  $stockIn->save();
     }
     public static function update_quantity($id,$amount){
     return    Yii::$app->db->createCommand()
        ->update('stock_in', ['remaining_quantity' =>$amount ], 'id =' . $id)
        ->execute();
   }
    public static function avilaible_quantity($product_id,$request_user_id){
        return $order_quantity = (new Query())
        ->select('*')
        ->from('stock_in')   
        ->where("user_id = '$request_user_id'")
        ->andWhere("product_id = '$product_id'")
        ->andWhere("remaining_quantity > '0'")
        ->limit('1')
        ->one();
       
    }
    public static function getallproduct(){
        $data= Product::find()->all();
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name'); //id = your ID model, name = your caption
     return $value;
    }
    public function stockInReport($user_id)
    {
    return  $model = User::find()
    ->where(['user_id' => $user_id])
    
    ->all();
    }
}