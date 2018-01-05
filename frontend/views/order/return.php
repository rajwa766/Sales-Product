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
        <?= Html::a(Yii::t('app', 'Create Order'), ['createreturn'], ['class' => 'btn btn-success']) ?>
    </p>
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.first_name',
            'user.last_name',
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
            // 'productOrders.quantity',
            // 'productOrders.order_price',
            'additional_requirements',
         

            [

                'header' => 'Approve',

                'format' => 'raw',

                'value' => function($model) {
                    if($model->status == '3'){
             return "<div class='payment_button_general_approve' ><a user_id='".$model->order_request_id."' ref_id='".$model->user_id."' class='" . $model->id . "' >Approve</a></div>";
                    }else{
             return "<div class='payment_button_general_approved' ><a>Approved</a></div>";
             
                    }
                }
            ],
            [
                'header' => 'Reject',
                'format' => 'raw',
             
                'value' => function($model) {
      if($model->status == '0'){
        return "<div class='payment_button_general_pending' ><a class='" . $model->id . "' >Cancel</a></div>";
      }else{
        return "<div class='payment_button_general_pending' ><a class='" . $model->id . "' >Completed</a></div>";
        
      }
    
                }
            ],
            //'file',
            //'user_id',
            //'status',
            //'order_request_id',
            //'entity_id',
            //'entity_type',
            //'requested_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>


<script>

        $("body").delegate(".payment_button_general_approve a", "click", function () {
       var id =    $(this).attr('class');
       var user_id =    $(this).attr('user_id');
       var order_request_id =    $(this).attr('ref_id');
       
            $.ajax({
                type: "POST",
            
                data:  {id:id, user_id:user_id,order_request_id: order_request_id },
               // data: "id="+id+"status+"+status,
                url: "<?php echo Yii::$app->getUrlManager()->createUrl('stock-in/approve'); ?>",
                success: function (test) {
                    $(this).parent().removeClass('payment_button_general_approve');
                    $(this).text('Approved');
                },
                error: function (exception) {
                    alert(exception);
                }
            });

        });
    </script>
