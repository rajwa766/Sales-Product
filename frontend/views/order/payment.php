<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Attendence;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="attendence-index">
   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
       'action' => ['order/payment-method'],
       ]
           ); ?>
    <h1>EPAYLINK Testing</h1>
    <input type="text" name="payment_method" value="">
    <input type="hidden" name="id" value="<?= $model->id; ?>">
    <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>
                                </div>
      <?php ActiveForm::end(); ?>
</div>
