<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ORDERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_ref_no',
            'shipper',
            'cod',
            'additional_requirements',
            'file',
            'user_id',
            'status',
            'order_request_id',
            'entity_id',
            'entity_type',
            'requested_date',
        ],
    ]) ?>

    <div class="container">
        <div class="row">
            
        </div>
    </div>

<?php
foreach($model->productOrders as $orders){ ?>

<table class="table table-striped table-bordered detail-view">
<tbody>
<tr>
<td>Order Quantity</td>
<td><?php 
echo $orders->quantity;
?></td>
</tr>
<tr>
<th>Order Price</td>
<td><?php 
echo $orders->order_price;
?></td>
</tr>

</tbody>
</table>
<?php
}

?>
<p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
