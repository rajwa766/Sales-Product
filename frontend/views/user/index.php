<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index table-responsive">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
             'first_name',
             'last_name',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            // 'created_at',
            // 'link',
            // 'updated_at',
            // 'parent_id',
            [
                'label' => 'Parent User',
                'attribute' => 'parent_id',
                'value' => function($model) {
                    return $model->username($model->parent_id);
                },
            ],
            'userLevel.name',
            //'phone_no',
            // 'address',
        // 'city',
            //'country',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{edit}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->homeUrl . 'user/view/' . $model->id);
                },
                'edit' => function ($url, $model) {
                    $user_id = Yii::$app->user->getId();
                    $Role = Yii::$app->authManager->getRolesByUser($user_id);
                    if (isset($Role['super_admin'])) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->homeUrl . 'user/update/' . $model->id);
                    }
                },
            ],
        ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
