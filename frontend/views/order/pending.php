<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\select2\Select2;

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


 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'order_request_id',
                'label'=>Yii::t('app', 'Transfer from'),
                'value'=>function ($model) { 
                    return $model->username($model->order_request_id);
                },
                'filter'=>Select2::widget([
                'model' => $searchModel,
                'initValueText' => isset($model->order_request_id) ? $model->username($model->order_request_id) : "",
                'attribute' => 'order_request_id',
               'options' => ['placeholder' => 'Select User Name ...'],
               'pluginOptions' => [
                'allowClear' => true,
                //'autocomplete' => true,
                'ajax' => [
                    'url' => Url::base().'/user/get-users',
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                ],
            ],
        // ... other params
    ]),
     ],
     [
        'attribute' => 'user_id',
        'label'=>Yii::t('app', 'Transfer to'),
        'value'=>function ($model) { 
            return $model->username($model->user_id);
        },
        'filter'=>Select2::widget([
        'model' => $searchModel,
        'attribute' => 'user_id',
        'initValueText' => isset($model->user_id) ? $model->username($model->user_id) : "",
       'options' => ['placeholder' => 'Select User Name ...'],
       'pluginOptions' => [
        'allowClear' => true,
        //'autocomplete' => true,
        'ajax' => [
            'url' => Url::base().'/user/get-users',
            'dataType' => 'json',
            'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
        ],
    ],
    // ... other params
    ]),
    ], 
  
            'order_ref_no',
            //'shipper',
            //'cod',
            
            [
                'label' => 'Quantity and Price',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->productorder($model->id);
                },
            ],
            // 'productOrders.quantity',
            // 'productOrders.order_price',
            [
                'header' => 'Approve',
                'format' => 'raw',
                'value' => function($model) {
                    if($model->status == '0'){
                        return "<div class='payment_button_general_approve' ><a user_id='".$model->user_id."' ref_id='".$model->order_request_id."' class='" . $model->id . "' >Approve</a></div>";
                                }else{
                        return "<div class='payment_button_general_approved' ><a user_id='".$model->user_id."' ref_id='".$model->order_request_id."' class='" . $model->id . "' >Approved</a></div>";
                    }
                }
            ],
            [
                'header' => 'Reject',
                'format' => 'raw',
             
                'value' => function($model) {
            if($model->status == '0'){
                return "<div class='payment_button_general_cancel' ><a class='" . $model->id . "' >Cancel</a></div>";
            }else{
                return "<div class='payment_button_general_pending' ><a class='" . $model->id . "' >Completed</a></div>";
                
            }
    
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{edit}',//{delete}
            'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/order/'.$model->id);
                    },
                    'edit' => function ($url, $model) {
                        $Role = Yii::$app->authManager->getRolesByUser($model->user_id);
                        if($model->status == array_search('Pending', \common\models\Lookup::$status) && isset($Role['customer'])){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/order/update/'.$model->id);
                        }
                    },
                    // 'delete' => function ($url, $model) {
                    //     if($model->status == array_search('Pending', \common\models\Lookup::$status)){
                    //         return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/order/delete/'.$model->id);
                    //     }
                    
                    // },
                    
                ],
            ],
        ],
        
    ]); ?>
    <?php Pjax::end(); ?>


<script>
        $("body").delegate(".payment_button_general_cancel a", "click", function () {
       var id =    $(this).attr('class');
            $.ajax({
                type: "POST",
                context: this,
                data:  {id:id},
               // data: "id="+id+"status+"+status,
                url: "<?php echo Yii::$app->getUrlManager()->createUrl('stock-in/cancel'); ?>",
                success: function (test) {
                   $(this).parent().removeClass('payment_button_general_cancel');
                   $(this).text('Cancled');
                   
                },
                error: function (exception) {
                    alert(exception);
                }
            });

        });
        $("body").delegate(".payment_button_general_approve a", "click", function () {
       var id =    $(this).attr('class');
       var user_id =    $(this).attr('user_id');
       var order_request_id =    $(this).attr('ref_id');
            $.ajax({
                type: "POST",
                context: this,
                data:  {id:id, user_id:user_id,order_request_id: order_request_id },
               // data: "id="+id+"status+"+status,
                url: "<?php echo Yii::$app->getUrlManager()->createUrl('stock-in/approve'); ?>",
                success: function (test) {
                   if(test == '1'){
                    $(this).parent().removeClass('payment_button_general_approve');
                   $(this).text('Approved');
                   }else{
                    $(this).text('Out of Stock');
                    $(this).css("color", "red"); 
                   }
                  
                },
                error: function (exception) {
                    alert(exception);
                }
            });

        });
    </script>

