<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAllcustomer()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        $dataProvider->query->where(['user_level_id'=>Null]);
        $dataProvider->query->andwhere(['parent_id'=>Null]);
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
    public function actionView($id)
    {
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
        // $this->view->model = $model;
        if ($model->load(Yii::$app->request->post())) {

            $image = \yii\web\UploadedFile::getInstance($model, 'file');
            $data = \common\components\Excel::import($image->tempName, ['setFirstRecordAsKeys' => true]);
    
        $array_MR=array();
        $array_SuperVIP=array();
        $array_VIP=array();
 
            foreach ($data as $entry) {
                try {
                  
                    if($entry['Level']!="อื่นๆ")
                    {
                       
                        $user_model = new User();
                        $user_model->isNewRecord = true;
                        $user_model->id = NULL;
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
                            $user_model->user_level_id = '2';
                            $user_model->entity_type =  '5000';
                            $user_model->price =  '390';
                            
                        }
                        elseif(strpos($entry['Level'], 'Super VIP') !== false) {
                            $parent_ID= $array_MR[array_rand($array_MR)];
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = '4';
                            $user_model->entity_type =  '1000';
                            $user_model->price =  '440';
                            
                            
                            
                        }
                        elseif(strpos($entry['Level'], 'VIP') !== false) {
                            $parent_ID= $array_SuperVIP[array_rand($array_SuperVIP)];
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = '6';
                            $user_model->entity_type =  '500';
                            $user_model->price =  '480';
                            
                        }
                        elseif(strpos($entry['Level'], 'Advance') !== false) {
                            $parent_ID= $array_VIP[array_rand($array_VIP)];
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = '12';
                            $user_model->entity_type =  '50';
                            $user_model->price =  '590';
                            
                        }
                        elseif(strpos($entry['Level'], 'Begin') !== false) {
                            $parent_ID= $array_VIP[array_rand($array_VIP)];
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = '13';
                            $user_model->entity_type =  '10';
                            $user_model->price =  '630';
                            
                        }
                        elseif(strpos($entry['Level'], 'Inter') !== false) {
                            $parent_ID= $array_VIP[array_rand($array_VIP)];
                            $user_model->parent_id = $parent_ID;
                            $user_model->user_level_id = '11';
                            $user_model->entity_type =  '100';
                            $user_model->price =  '550';
                            
                        }
                        $user_model->save();
                        
                        \common\models\StockStatus::set_minimum_stock_level($user_model->id);
                        \common\models\Account::create_accounts($user_model);
                        if (strpos($entry['Level'], 'MR') !== false) {
                            $array_MR[]=$user_model->id;
                        }
                        elseif(strpos($entry['Level'], 'Super VIP') !== false) {
                            $array_SuperVIP[]=$user_model->id;
                        }
                        elseif(strpos($entry['Level'], 'VIP') !== false) {
                            $array_VIP[]=$user_model->id;
                        }
                         $order = \common\models\Order::insert_order($user_model);
                        
                         if($order->id)
                         {
                             $product_order = \common\models\ProductOrder::insert_user_order_exel($user_model,$order);
                             $shipping_address = \common\models\ShippingAddress::insert_shipping_address_excel($user_model,$order->id);
                             $stock_in = \common\models\StockIn::approve($order->id,$user_model->id,$user_model->parent_id);
                         }
                         $auth = \Yii::$app->authManager;
                         $role = $auth->getRole('general'); 
                         $auth->assign($role, $user_model->id);
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
        // $searchModel = new ChartOfAccountsSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // if (Yii::$app->request->isAjax) {
        //     return $this->renderAjax('index', [
        //                 'searchModel' => $searchModel,
        //                 'dataProvider' => $dataProvider,
        //     ]);
        // } else {
        //     return $this->render('index', [
        //                 'searchModel' => $searchModel,
        //                 'dataProvider' => $dataProvider,
        //     ]);
        // }
    }
                

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGetparentid($id){
$parent_id = User::findOne(['id'=>$id]);
return $parent_id->parent_id;
    }
    public function actionCreate()
    {
        $model = new User();
     
        if ($model->load(Yii::$app->request->post())) {
            $transaction_failed=false; 
            $transaction = Yii::$app->db->beginTransaction();
            
                 try 
                 {
                     //upload image
                     $photo = UploadedFile::getInstance($model, 'profile');
                     
                     if ($photo !== null) {
                       $model->profile= $photo->name;
                       $ext = end((explode(".", $photo->name)));
                       $model->profile = Yii::$app->security->generateRandomString() . ".{$ext}";
                       $path =  Yii::getAlias('@app').'/web/uploads/'.$model->profile;
                    //   $path = Yii::getAlias('@upload') .'/'. $model->payment_slip;
                       $photo->saveAs($path);
                   }
            $current_level_id =  \common\models\UsersLevel::findOne($model->user_level_id);
            if($model->parent_user){
                $model->parent_id = $model->parent_user;  
            }else{
            $model->parent_id = Yii::$app->user->identity->id;  
            }
            // check seller or general
            if($current_level_id->max_user == '-1'){
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('seller');
            }else{
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('general'); 
            }
            //   check the limit of user
            $total_user_current_level = User::find()->where(['=','parent_id',$model->parent_id])->count();
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->getpassword();
            //    check not company user and not seller and user space remain
            if($current_level_id->max_user != '-1' && $total_user_current_level>$current_level_id->max_user && $model->company_user != '1'){
                return $this->render(['more_user', 'model' => $model]);  
            }else{
            if($model->save()){
                \common\models\StockStatus::set_minimum_stock_level($model->id);
                \common\models\Account::create_accounts($model);
                $order = \common\models\Order::insert_order($model);
               
                if($order->id)
                {
                    $product_order = \common\models\ProductOrder::insert_user_order_js($model,$order);
                    $shipping_address = \common\models\ShippingAddress::insert_shipping_address_user($model,$order);
                    $stock_in = \common\models\StockIn::approve($order->id,$model->id,$model->parent_id);
               }
               //bonus super vip
              
                if($model->user_level_id == '4'){
                    $order = \common\models\Order::insert_order_bonus($model,'50');
                     if($order->id)
                     {
                         $product_order = \common\models\ProductOrder::insert_user_order_js_bonus($model,$order);
                        
                         $shipping_address = \common\models\ShippingAddress::insert_shipping_address_user($model,$order);
                         $stock_in = \common\models\StockIn::approve($order->id,$model->id,'1');
                    }
                }
             
                  //bonus  vip
                  if($model->user_level_id == '6'){
                    $order = \common\models\Order::insert_order_bonus($model,'20');
                    if($order->id)
                    {
                      
                        $product_order = \common\models\ProductOrder::insert_user_order_js_bonus($model,$order);
                       
                        $shipping_address = \common\models\ShippingAddress::insert_shipping_address_user($model,$order);
                        $stock_in = \common\models\StockIn::approve($order->id,$model->id,'1');
                   }
                }
            
                $auth->assign($role, $model->id);
            }else{
                $transaction_failed=true; 
            }
        
            }
        }catch (Exception $e) 
        {
            $transaction_failed=true;
          
        }
        if($transaction_failed)
        {
         $transaction->rollBack();
         return $this->redirect(['error', 'model' => $model]);
         
        }  else
        {
         $transaction->commit();  
         return $this->redirect(['view', 'id' => $model->id]);
         
        }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCustomer()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('customer');
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->getpassword();
          
            if($model->save()){
                $auth->assign($role, $model->id);
            return $this->redirect(['view', 'id' => $model->id]);
    }else{
        return $this->render('customer_create', [
            'model' => $model,
        ]);  
    }
}else{
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
    public function actionUpdate($id)
    {
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
    public function actionGetuseraddress($id)
    {
     $user_detail = User::findOne(['id'=>$id]);
     return Json::encode($user_detail, $asArray = true);
   
    }
    public function actionAlllevel($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
            if (!is_null($q)) {
              $query = new \yii\db\Query();
                $query->select('id as id, name AS text')
                        ->from('users_level')
                        ->where(['like', 'name', $q])
                        ->andWhere(['!=', 'max_user', '-1'])
                       ->limit(20);
                
                $command = $query->createCommand();
                $data = $command->queryAll();
                $out['results'] = array_values($data);
            } elseif ($id > 0) {
                $out['results'] = ['id' => $id, 'text' => \common\models\UserLevel::find($id)->id];
            }
        return $out;
    }
    public function actionParentuserupdate() {
        $q = Yii::$app->request->get('q');
      //  $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type');
        $level_id = \common\models\UsersLevel::findOne(['id',$type]);
        $company_user = Yii::$app->request->get('company_user');
     
        if(empty($type)){
            return [];
        }
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
         if (!is_null($q)) {
           $query = new \yii\db\Query();
             $query->select('id as id, username AS text')
                     ->from('user')
                     ->where(['like', 'username', $q])
                     ->andWhere(['=', 'user_level_id', $level_id->parent_id ])
                 ->limit(20);
             $command = $query->createCommand();
             $data = $command->queryAll();
             // if($data){
             $out['results'] = array_values($data);
        }
        
        else{
         $query = new \yii\db\Query();
         $query->select('id as id, username AS text')
                 ->from('user')
                ->where(['=', 'user_level_id', $level_id->parent_id])
              ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
        }
     return $out;
 }
    public function actionParentuser() {
        $q = Yii::$app->request->get('q');
      //  $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type');
        $company_user = Yii::$app->request->get('company_user');
     
        if(empty($type)){
            return [];
        }
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
         if (!is_null($q)) {
           $query = new \yii\db\Query();
             $query->select('id as id, username AS text')
                     ->from('user')
                     ->where(['like', 'username', $q])
                     ->andWhere(['=', 'user_level_id', $type]);
                     if($type != '1'){
                        $query->andWhere(['=', 'company_user', $company_user]);
                     }
                     
                   //  ->andWhere(['like','customer_user_id',$customer_id])
                   $query->limit(20);
             
             $command = $query->createCommand();
             $data = $command->queryAll();
             // if($data){
             $out['results'] = array_values($data);
        }
        
        else{
         $query = new \yii\db\Query();
         $query->select('id as id, username AS text')
                 ->from('user')
                ->where(['=', 'user_level_id', $type]);
                if($type != '1'){
                    $query->andWhere(['=', 'company_user', $company_user]);
                 }
                 
               //  ->andWhere(['like','customer_user_id',$customer_id])
               $query->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
        }
     return $out;
 }
 public function actionLevel() {
    $q = Yii::$app->request->get('q');
  //  $id = Yii::$app->request->get('id');
    $type = Yii::$app->request->get('type');
    $company_user = Yii::$app->request->get('company_user');
 
    if(empty($type)){
        return [];
    }
 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 $out = ['results' => ['id' => '', 'text' => '']];
     if (!is_null($q)) {
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
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
    }
    
    else{
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
     $data = $command->queryAll();
     // if($data){
     $out['results'] = array_values($data);
    }
 return $out;
}
public function actionAllusers() {
    $q = Yii::$app->request->get('q');
 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 $out = ['results' => ['id' => '', 'text' => '']];
     if (!is_null($q)) {
       $query = new \yii\db\Query();
         $query->select('id as id, username AS text')
                 ->from('user')
                 ->where(['like', 'username', $q])
               
                ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
    }
    
    else{
     $query = new \yii\db\Query();
     $query->select('id as id, username AS text')
             ->from('user')
        
            ->limit(20);
     
     $command = $query->createCommand();
     $data = $command->queryAll();
     // if($data){
     $out['results'] = array_values($data);
    }
 return $out;
}
public function actionAllcustomers() {
    $q = Yii::$app->request->get('q');
  //  $id = Yii::$app->request->get('id');
    //$type = Yii::$app->request->get('type');

 
  
 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 $out = ['results' => ['id' => '', 'text' => '']];
     if (!is_null($q)) {
       $query = new \yii\db\Query();
         $query->select('id as id, username AS text')
                 ->from('user')
                 ->where(['like', 'username', $q])
                 ->andWhere(['user_level_id'=>Null])
                 ->andWhere(['parent_id'=>Null])
                ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
    }
    
    else{
     $query = new \yii\db\Query();
     $query->select('id as id, username AS text')
             ->from('user')
             ->where(['user_level_id'=>Null])
             ->andWhere(['parent_id'=>Null])
            ->limit(20);
     
     $command = $query->createCommand();
     $data = $command->queryAll();
     // if($data){
     $out['results'] = array_values($data);
    }
 return $out;
}
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
