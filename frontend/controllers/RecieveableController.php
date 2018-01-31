<?php
namespace frontend\controllers;

use Yii;
use common\models\Gl;
use common\models\GlSearch;
use common\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class RecieveableController extends Controller
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

   public function actionIndex()
    {
        $searchModel = new GlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->query->where(['account_id' => Yii::$app->user->identity->id]);
       
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate() {
        $model = new Gl();

        if ($model->load(Yii::$app->request->post())) {
            $createRecieveable = Gl::create_gl($model->amount,$model->receivable_user,$model->payable_user,'','1');
            return $this->redirect(['//gl/view', 'id' => $createRecieveable]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }
     public function actionView($id)
    {
        return $this->render('view', [
            'model' => Gl::findOne(['id'=>$id]),
        ]);
    }
    public function actionGetrecieveableamount($id,$payable_id){
           $receivable_account=\common\models\Account::findOne(['user_id'=>$id,'account_type'=>1]);
        $payable_account=\common\models\Account::findOne(['user_id'=>$payable_id,'account_type'=>2]);
    
        return Gl::totalRecieveable($receivable_account->id,$payable_account->id);
       
    }



}
