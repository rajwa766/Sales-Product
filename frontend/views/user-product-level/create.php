<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserProductLevel */

$this->title = 'Create User Product Level';
$this->params['breadcrumbs'][] = ['label' => 'User Product Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-product-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
