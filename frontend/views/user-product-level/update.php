<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserProductLevel */

$this->title = 'Update User Product Level: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Product Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-product-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
