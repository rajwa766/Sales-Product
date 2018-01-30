<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;
use yii\web\UploadedFile;

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
 * @property string $requested_date
 *
 * @property Account[] $accounts
 * @property User $user
 * @property ProductOrder[] $productOrders
 */
class Order extends \yii\db\ActiveRecord {

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
    public $single_price;
    public $total_price;
    public $product_id;
    public $quantity;

    const SCENARIO_ORDER = 'order';
    const SCENARIO_REQUEST = 'request';

    /**
     * @inheritdoc
     */
    public static function tableName() {
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

    public function scenarios() {

        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ORDER] = ['email', 'request_user_level', 'request_agent_name'];
        $scenarios[self::SCENARIO_REQUEST] = ['all_level', 'parent_user', 'child_level', 'child_user'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'order_request_id'], 'required'],
            [['all_level', 'parent_user', 'child_level', 'child_user'], 'required', 'on' => self::SCENARIO_REQUEST],
            [['email', 'request_user_level', 'request_agent_name'], 'required', 'on' => self::SCENARIO_ORDER],
            [['user_id', 'status', 'order_request_id', 'quantity', 'all_level', 'parent_user', 'child_user', 'child_level', 'request_user_level', 'rquest_customer', 'customer_id', 'quantity'], 'integer'],
            [['requested_date', 'order_type', 'request_agent_name', 'product_order_info', 'created_at', 'updated_at', 'created_by', 'updated_by', 'address', 'city', 'country', 'postal_code', 'district', 'province', 'mobile_no', 'phone_no', 'email', 'product_id', 'total_price', 'single_price', 'payment_method'], 'safe'],
            [['payment_slip'], 'file'],
            [['order_ref_no', 'shipper', 'cod', 'additional_requirements'], 'string', 'max' => 45],
            [['payment_slip'], 'string', 'max' => 250],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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
            'quantity' => Yii::t('app', 'Quantity'),
            'requested_date' => Yii::t('app', 'Requested Date'),
            'total_price' => Yii::t('app', 'Requested Date'),
            'single_price' => Yii::t('app', 'Requested Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts() {
        return $this->hasMany(Account::className(), ['order_id' => 'id']);
    }

    public static function all_status_dashboard($user_id) {
        $all_status = array();

        $all_status['current_level'] = Order::CurrentLevel($user_id);
        $all_status['current_stock'] = Order::CurrentStock($user_id);
        $all_status['current_profit'] = Order::CurrentProfit($user_id);
        $all_status['current_user'] = Order::CurrentUser($user_id);
        $all_status['user_remning'] = Order::CurrentRemaning($user_id, $all_status['current_user']);
        $all_status['total_order'] = Order::find()->where(['order_request_id' => Yii::$app->user->identity->id])->count();
        $all_status['pending_order'] = Order::find()->where(['order_request_id' => Yii::$app->user->identity->id])->andWhere(['status' => '0'])->count();
        $all_status['approved_order'] = Order::find()->where(['order_request_id' => Yii::$app->user->identity->id])->andWhere(['status' => '1'])->count();

        return $all_status;
    }

    public static function CurrentLevel($user_id) {
        $current_level = (new Query())
                ->select('users_level.name as current_level')
                ->from('user')
                ->innerJoin('users_level', 'user.user_level_id = users_level.id')
                ->where(['=', 'user.id', $user_id])
                ->one();
        return $current_level['current_level'];
    }

    public static function CurrentStock($user_id) {
        $current_stock = (new Query())
                ->select('SUM(remaining_quantity) as current_stock')
                ->from('stock_in')
                ->where(['=', 'user_id', $user_id])
                ->groupby(['product_id'])
                ->one();
        return $current_stock['current_stock'];
    }

    public static function CurrentProfit($user_id) {
        $stock_in_remaning_price = (new Query())
                ->select('SUM(initial_quantity * price) -  SUM(remaining_quantity *price) as stock_in_price')
                ->from('stock_in')
                ->where(['=', 'user_id', $user_id])
                ->one();

        $total_buying_price = (new Query())
                ->select('SUM(product_order.order_price * product_order.quantity) as buying_price ')
                ->from('order')
                ->innerJoin('product_order', 'product_order.order_id = order.id')
                ->where(['=', 'order.user_id', $user_id])
                ->andWhere(['=', 'order.status', '1'])
                ->one();

        $total_return_price = (new Query())
                ->select('SUM(product_order.order_price * product_order.quantity) as return_price')
                ->from('order')
                ->innerJoin('product_order', 'product_order.order_id = order.id')
                ->where(['=', 'order.user_id', $user_id])
                ->andWhere(['=', 'order.status', '4'])
                ->one();
        $total_sale_price = (new Query())
                ->select('SUM(product_order.order_price * product_order.quantity) as return_price')
                ->from('order')
                ->innerJoin('product_order', 'product_order.order_id = order.id')
                ->where(['=', 'order.order_request_id', $user_id])
                ->andWhere(['=', 'order.status', '1'])
                ->one();
        $total_price = floatval($total_buying_price['buying_price']) - floatval($total_return_price['return_price']);
        $total_purcahse_price = $total_price - floatval($stock_in_remaning_price['stock_in_price']);
        return $total_purcahse_price - floatval($total_sale_price);
    }

    public static function CurrentUser($user_id) {
        return (new Query())
                        ->select('*')
                        ->from('user')
                        ->where(['=', 'parent_id', $user_id])
                        ->count();
    }

    public static function CurrentRemaning($user_id, $urent_users) {
        $total_user = (new Query())
                ->select('*')
                ->from('user')
                ->innerJoin('users_level', 'users_level.id = user.user_level_id')
                ->where(['=', 'user.id', $user_id])
                ->one();
        return $total_user['max_user'] - $urent_users;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getShippingAddresses() {
        return $this->hasOne(ShippingAddress::className(), ['order_id' => 'id']);
    }

    public function username($id) {
        $users = \common\models\User::find()->where(['id' => $id])->one();
        return $users->username;
    }

    public static function saveSlip($model, $photo) {
        $model->payment_slip = $photo->name;
        $array = explode(".", $photo->name);
        $ext = end($array);
        $model->payment_slip = Yii::$app->security->generateRandomString() . ".{$ext}";
        $path = Yii::getAlias('@app') . '/web/uploads/' . $model->payment_slip;
        $photo->saveAs($path);
    }

    public static function CreateOrder($model) {
        $result = "";
        $transaction_failed = false;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($model->order_type == "Order") {
                $model->order_request_id = $model->request_agent_name;
                $model->user_id = $model->rquest_customer;
                $check_user_already_exist = \common\models\User::find()->where([ 'email' => $model->email])->one();
                if ($check_user_already_exist) {
                    $model->user_id = $check_user_already_exist->id;
                } else {
                    $customer_user = \common\models\User::insert_user($model);
                    $auth = \Yii::$app->authManager;
                    $role = $auth->getRole('customer');
                    $auth->assign($role, $customer_user->id);
                    $model->user_id = $customer_user->id;
                }
            } else {
                $model->order_request_id = $model->parent_user;
                $model->user_id = $model->child_user;
            }
            
            $payment_method = array_search('Bank Transfer', \common\models\Lookup::$order_status);
            if ($model->payment_method == $payment_method) {
                $photo = UploadedFile::getInstance($model, 'payment_slip');
                if ($photo !== null) {
                    $photo_save = Order::saveSlip($model, $photo);
                }
            }
            if ($model->save()) {
                $product_order = \common\models\ProductOrder::insertProductOrder($model->quantity, $model->single_price, $model);
                $shipping_address = \common\models\ShippingAddress::insertShippingAddress($model, $model->id);
                $transaction->commit();
                $result = "transaction_complete";
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            $result = "transaction_failed";
        }
        return $result;
    }
public static function CreateOrderReturn($model){
       if ($model->order_type == "Order") {
                $model->order_request_id = $model->request_agent_name;
                $model->user_id = $model->rquest_customer;
            } else {
                $model->order_request_id = $model->parent_user;
                $model->user_id = $model->child_user;
            }
            if ($model->save()) {
                $product_order = \common\models\ProductOrder::insertProductOrder($model->quantity, $model->single_price, $model);
            }
}
public static function CreateOrderTransfer($model){
        $model->order_request_id = $model->parent_user;
            $model->user_id = $model->child_user;
            $model->status  = array_search('Transfer Request', \common\models\Lookup::$status);
            if ($model->save()) {
                $product_order = \common\models\ProductOrder::insertProductOrder($model->quantity, $model->single_price, $model);
            }
}
    public static function insertOrder($user_model, $approve_order = false, $is_bonus = false) {
        $order = new Order();
        $order->isNewRecord = true;
        $order->id = null;
        $order->user_id = $user_model->id;
        if (!$is_bonus) {
            $order->order_request_id = $user_model->parent_id;
            $pending_status = array_search('Pending', \common\models\Lookup::$status);
            $order->status = $pending_status;
        } else {
            $order->order_request_id = '1';
            $bonus_status = array_search('Bonus', \common\models\Lookup::$status);
            $order->status = $bonus_status;
        }
        $order->save();
        if ($order->id) {
            $product_order = \common\models\ProductOrder::insertProductOrder($user_model->quantity, $user_model->unit_price, $order);
            $shipping_address = \common\models\ShippingAddress::insertShippingAddress($user_model, $order->id);
            if ($approve_order) {
                $stock_in = \common\models\StockIn::approve($order->id, $user_model->id, $user_model->parent_id);
            }
        }
        return $order;
    }

    public static function cancel_request($order_id) {
        $order_detail = Order::find()->where(['id' => $order_id])->one();
        $transfer_request = array_search('Transfer Request', \common\models\Lookup::$status);
        $transfer_cancel = array_search('Transfer Canceled', \common\models\Lookup::$status);
        $return_request = array_search('Return Request', \common\models\Lookup::$status);
        $return_cancel = array_search('Return Canceled', \common\models\Lookup::$status);
        $request_cancel = array_search('Request Canceled', \common\models\Lookup::$status);
        if ($order_detail->status == $transfer_request) {
            Yii::$app->db->createCommand()
                    ->update('order', ['status' => $transfer_cancel], 'id =' . $order_id)
                    ->execute();
        } elseif ($order_detail->status == $return_request) {
            Yii::$app->db->createCommand()
                    ->update('order', ['status' => $return_cancel], 'id =' . $order_id)
                    ->execute();
        } else {
            Yii::$app->db->createCommand()
                    ->update('order', ['status' => $request_cancel], 'id =' . $order_id)
                    ->execute();
        }
        return true;
    }

    public static function update_status($id) {
        return Yii::$app->db->createCommand()
                        ->update('order', ['status' => '1'], 'id =' . $id)
                        ->execute();
    }

    public static function update_return_status($id) {
        return Yii::$app->db->createCommand()
                        ->update('order', ['status' => '4'], 'id =' . $id)
                        ->execute();
    }

    public static function update_transfer_status($id) {
        return Yii::$app->db->createCommand()
                        ->update('order', ['status' => '6'], 'id =' . $id)
                        ->execute();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders() {
        return $this->hasMany(ProductOrder::className(), ['order_id' => 'id']);
    }

    public function productorder($id) {
        $i = 1;
        $product_order_data = "";
        $order = \common\models\ProductOrder::find()->where(['=', 'order_id', $id])->all();

        foreach ($order as $p_order) {
            $product_order_data .= '<div class="vehicle_grid"> ' . $i . '&nbsp;&nbsp;Quantity' . $p_order->quantity . '&nbsp;&nbsp;Price/Unit#' . $p_order->order_price . '<br></div>';
            $i++;
        }
        return $product_order_data;
    }

}
