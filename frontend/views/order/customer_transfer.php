<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ORDERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
     ?>

<p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['createtransfer'], ['class' => 'btn btn-success']) ?>
    </p>
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Transfer to',
                'attribute' => 'user_id',
                'value' => function($model) {
                    return $model->username($model->user_id);
                },
            ],
            [
                'label' => 'Transfer from',
                'attribute' => 'order_request_id',
                'value' => function($model) {
                    return $model->username($model->order_request_id);
                },
            ],
            'order_ref_no',
            'shipper',
            'cod',
            [
                'label' => 'Quantity and Price',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->productorder($model->id);
                },
            ],
     
            'additional_requirements',
         

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>



