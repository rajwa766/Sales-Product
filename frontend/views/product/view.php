<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
    <div class="view-product">
        <div class="col-md-8">
            <ul>
            <li>Name : <?php echo $model->name; ?></li>
            <li>Category Id :<?php echo $model->category_id; ?></li>
            <li>Description : <?php echo $model->description; ?></li>
            <li>Price : <?php echo $model->price; ?></li>
        </ul>
        
        </div>
        <div class="col-md-4 text-right">
             <img src="<?= Yii::$app->homeUrl; ?>images/beydey1.jpg" class="img-responsive">
        </div>
    </div>
   

</div>
