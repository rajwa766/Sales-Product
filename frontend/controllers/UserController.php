<?php

namespace frontend\controllers;

use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAllcustomer() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->where(['user_level_id' => null]);
        $dataProvider->query->andwhere(['parent_id' => null]);
        return $this->render('customer_index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $user_id = Yii::$app->user->getId();
        $all_status = \common\models\Order::all_status_dashboard($user_id);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'all_status' => $all_status,
        ]);
    }

    public function actionImport() {
        $model = new \common\models\Upload();
        $data = "";
        $count = 0;
        if ($model->load(Yii::$app->request->post())) {

            $array_MR = array();
            $array_SuperVIP = array();
            $array_VIP = array();
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
            $data = \common\components\Excel::import($file->tempName, ['setFirstRecordAsKeys' => true]);

            foreach ($data as $entry) {
                try {
                    if ($entry['Level'] != "อื่นๆ") {
                        $user_model = new User();
                        $user_model->isNewRecord = true;
                        $user_model->id = null;
                        $user_model->username = '' . $entry['User'];
                        $user_model->email = '' . $entry['Email'];
                        $user_model->phone_no = '' . $entry['Phone'];
                        $user_model->address = '' . $entry['Address'];
                        $user_model->province = '' . $entry['Province'];
                        $user_model->first_name = '' . $entry['Name'];
                        $user_model->password = '' . $entry['Password'];

                        $user_model->setPassword($user_model->password);
                        $user_model->generateAuthKey();
                        if (strpos($entry['Level'], 'MR') !== false) {
                            $user_model->parent_id = Yii::$app->user->identity->id;
                            $user_model->user_level_id = array_search('Management Team', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '5000';
                            $user_model->unit_price = '390';
                        } elseif (strpos($entry['Level'], 'Super VIP') !== false) {
                            $max_key = \common\models\helpers\ArrayUtils::MaxAttributeInAssociativeArray($array_MR, 'quantity');
                            $parent_ID = $array_MR[$max_key]['id'];
                            $array_MR[$max_key]['quantity'] -= 1000;
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = array_search('Super Vip Team', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '1000';
                            $user_model->unit_price = '440';
                        } elseif (strpos($entry['Level'], 'VIP') !== false) {
                            $max_key = \common\models\helpers\ArrayUtils::MaxAttributeInAssociativeArray($array_SuperVIP, 'quantity');
                            $parent_ID = $array_SuperVIP[$max_key]['id'];
                            $array_SuperVIP[$max_key]['quantity'] -= 500;
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = array_search('VIP Team', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '500';
                            $user_model->unit_price = '480';
                        } elseif (strpos($entry['Level'], 'Pro') !== false) {
                            $max_key = \common\models\helpers\ArrayUtils::MaxAttributeInAssociativeArray($array_VIP, 'quantity');
                            $parent_ID = $array_VIP[$max_key]['id'];
                            $array_VIP[$max_key]['quantity'] -= 250;
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = array_search('PRO Level', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '250';
                            $user_model->unit_price = '520';
                        } elseif (strpos($entry['Level'], 'Inter') !== false) {
                            $max_key = \common\models\helpers\ArrayUtils::MaxAttributeInAssociativeArray($array_VIP, 'quantity');
                            $parent_ID = $array_VIP[$max_key]['id'];
                            $array_VIP[$max_key]['quantity'] -= 100;
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = array_search('INTER Level', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '100';
                            $user_model->unit_price = '550';
                        } elseif (strpos($entry['Level'], 'Advance') !== false) {
                            $max_key = \common\models\helpers\ArrayUtils::MaxAttributeInAssociativeArray($array_VIP, 'quantity');
                            $parent_ID = $array_VIP[$max_key]['id'];
                            $array_VIP[$max_key]['quantity'] -= 50;
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = array_search('ADVANCE Level', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '50';
                            $user_model->unit_price = '590';
                        } elseif (strpos($entry['Level'], 'Begin') !== false) {
                            $max_key = \common\models\helpers\ArrayUtils::MaxAttributeInAssociativeArray($array_VIP, 'quantity');
                            $parent_ID = $array_VIP[$max_key]['id'];
                            $array_VIP[$max_key]['quantity'] -= 10;
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = array_search('BEGIN Level', \common\models\Lookup::$user_levels);
                            $user_model->quantity = '10';
                            $user_model->unit_price = '630';
                        }
                        if (!empty($user_model) && !empty($user_model->email)) {
                            $result = \common\models\User::CreateUser($user_model);
                            if (strpos($entry['Level'], 'MR') !== false) {
                                $array_MR[] = array('id' => $result, 'quantity' => 5000);
                            } elseif (strpos($entry['Level'], 'Super VIP') !== false) {
                                $array_SuperVIP[] = array('id' => $result, 'quantity' => 1000);
                            } elseif (strpos($entry['Level'], 'VIP') !== false) {
                                $array_VIP[] = array('id' => $result, 'quantity' => 500);
                            }
                        }
                    }
                } catch (\Exception $e) {
                    var_dump($e);
                    exit();
                    continue;
                }
            }
        }
        return $this->render('user_upload', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGetparentid($id) {
        $parent_id = User::findOne(['id' => $id]);
        return $parent_id->parent_id;
    }

    public function actionCreate() {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $error = \common\models\User::CreateUser($model);
            if ($error == "transaction_failed") {
                return $this->redirect(['error', 'model' => $model]);
            } else if ($error == "max_user_reached") {
                return $this->render('more_user', ['model' => $model]);
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCustomer() {
        $model = new User();
        if ($model->load(Yii::$app->request->post($model))) {
            $customerCreate = User::CreateCustomer($model);
            if ($customerCreate) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('customer_create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $oldmodel = $this->findModel($id);
            $changelog_entry = \common\models\ChangeLog::insert_data($oldmodel);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionGetuseraddress($id) {
        $user_detail = User::findOne(['id' => $id]);
        return Json::encode($user_detail, $asArray = true);
    }

//  parent user of selected user
    public function actionGetUsers() {
        $q = Yii::$app->request->get('q');
        $user_level = Yii::$app->request->get('user_level');
        $company_user = Yii::$app->request->get('company_user');
        $parent_id = Yii::$app->request->get('parent_id');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\User::getUsers($q, $parent_id, $user_level, $company_user);
    }

// all level
    public function actionGetLevels() {
        $q = Yii::$app->request->get('q');
        $parent_id = Yii::$app->request->get('parent_id');
        $max_user = Yii::$app->request->get('max_user');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\UsersLevel::getLevels($q, $parent_id, $max_user);
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
