<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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


    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $current_level_id =  \common\models\UsersLevel::findOne($model->user_level_id);
            if($model->parent_user){
                $model->parent_id = $model->parent_user;  
            }else{
            $model->parent_id = Yii::$app->user->identity->id;  
            }
            if($current_level_id->max_user == '-1'){
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('seller');
            }else{
                $auth = \Yii::$app->authManager;
                $role = $auth->getRole('general'); 
            }
            $total_user_current_level = User::find()->where(['=','parent_id',$model->parent_id])->count();
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->getpassword();
            if($current_level_id->max_user != '-1' && $total_user_current_level>$current_level_id->max_user){
                return $this->redirect(['more_user', 'id' => $model->id]);  
            }else{
            if($model->save()){
               
                $auth->assign($role, $model->id);
            }
            return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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

    public function actionParentuser() {
        $q = Yii::$app->request->get('q');
      //  $id = Yii::$app->request->get('id');
        $type = Yii::$app->request->get('type');
    
     
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
                     ->andWhere(['=', 'user_level_id', $type])
                   //  ->andWhere(['like','customer_user_id',$customer_id])
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
                ->where(['=', 'user_level_id', $type])
                ->limit(20);
         
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

 
    if(empty($type)){
        return [];
    }
 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 $out = ['results' => ['id' => '', 'text' => '']];
     if (!is_null($q)) {
       $query = new \yii\db\Query();
         $query->select('id as id, name AS text')
                 ->from('users_level')
                 ->where(['like', 'name', $q])
                 ->andWhere(['=', 'parent_id', $type])
               //  ->andWhere(['like','customer_user_id',$customer_id])
                ->limit(20);
         
         $command = $query->createCommand();
         $data = $command->queryAll();
         // if($data){
         $out['results'] = array_values($data);
    }
    
    else{
     $query = new \yii\db\Query();
     $query->select('id as id, name AS text')
             ->from('users_level')
            ->where(['=', 'parent_id', $type])
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
