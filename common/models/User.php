<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * User model
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property string $link
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $parent_id
 * @property integer $user_level_id
 * @property string $phone_no
 * @property string $address
 * @property integer $city
 * @property integer $country
 *
 * @property Order[] $orders
 * @property StockIn[] $stockIns
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    public $all_level;
    public $parent_user;
    public $stock_in;
    public $quantity;
    public $product_order_info;
    public $price;
    public $unit_price;
    public $total_price;
    public $product_id;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function getPassword()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['username', 'password', 'email', 'first_name', 'last_name'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['status', 'created_at', 'updated_at', 'parent_id', 'user_level_id'], 'integer'],
            [['created_at', 'updated_at', 'phone_no', 'address', 'city', 'country', 'all_level', 'parent_user', 'stock_in', 'quantity', 'product_order_info', 'price', 'unit_price', 'total_price', 'company_user', 'product_id'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['profile'], 'file'],
            [['link'], 'string', 'max' => 450],
            [['phone_no'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 5000],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getOrders()
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }
    public function getStockIns()
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public function getProfile()
    {
        $user = User::find()
            ->where(['id' => Yii::app()->user->id])
            ->one();
    }
    public static function insert_user($model)
    {
        $user = new User();
        $user->isNewRecord = true;
        $user->id = null;
        $user->setPassword($model->email);
        $user->generateAuthKey();
        $user->username = $model->email;
        $user->email = $model->email;
        $user->phone_no = $model->phone_no;
        $user->mobile_no = $model->mobile_no;
        $user->mobile_no = $model->mobile_no;
        $user->address = $model->address;
        $user->postal_code = $model->postal_code;
        $user->district = $model->district;
        $user->province = $model->province;
        $user->country = $model->country;
        if ($user->save()) {
            return $user;
        }
    }
    public static function CreateUser($model)
    {
        $result = "";
        $transaction_failed = false;
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
            //upload image
            $photo = UploadedFile::getInstance($model, 'profile');
            if ($photo !== null) {

                $model->profile = $photo->name;
                $array = explode(".", $photo->name);
                $ext = end($array);
                $model->profile = Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = Yii::getAlias('@app') . '/web/uploads/' . $model->profile;
                $photo->saveAs($path);
            }

            $current_level = \common\models\UsersLevel::findOne($model->user_level_id);
            if ($model->parent_user) {
                $model->parent_id = $model->parent_user;
            } else {
                $model->parent_id = Yii::$app->user->identity->id;
            }
            // check seller or general
            if ($current_level->max_user == '-1') {
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('seller');
            } else {
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('general');
            }

            //   check the limit of user
            $total_user_current_level = User::find()->where(['=', 'user_level_id', $model->user_level_id])->count();
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->getpassword();
            //    check not company user and not seller and user space remain
            if ($current_level->max_user != '-1' && $total_user_current_level > $current_level->max_user && $model->company_user != '1') {
                $result = "max_user_reached";
            } else {

                if ($model->save()) {
                    \common\models\StockStatus::set_minimum_stock_level($model->id);
                    \common\models\Account::create_accounts($model);
                    $order = \common\models\Order::insertOrder($model, true);

                    //bonus for super vip or vip
                    $super_vip_level = array_search('Super Vip Team', \common\models\Lookup::$user_levels);
                    $vip_level = array_search('VIP Team', \common\models\Lookup::$user_levels);
                    if ($model->user_level_id == $super_vip_level || $model->user_level_id == $vip_level) {
                        $model->unit_price = '0';
                        if ($model->user_level_id == $super_vip_level) {
                            $model->quantity = '50';
                            $order = \common\models\Order::insertOrder($model, true, true);
                        } else if ($model->user_level_id == $vip_level) {
                            $model->quantity = '20';
                            $order = \common\models\Order::insertOrder($model, true, true);
                        }

                    }
                    $auth->assign($role, $model->id);
                    $transaction->commit();
                    $result=$model->id;
                } else {
                    $result = "transaction_failed";
                }

            }
        } catch (Exception $e) {
            $transaction->rollBack();
            $result = "transaction_failed";

        }
        return $result;
    }

    public function username($id)
    {
        $users = \common\models\User::find()->where(['id' => $id])->one();
        return $users['username'];

    }

    public function getUserLevel()
    {
        return $this->hasOne(UsersLevel::className(), ['id' => 'user_level_id']);
    }
}
