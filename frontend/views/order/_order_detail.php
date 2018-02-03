<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\models\order;
use kartik\file\FileInput;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<h3>Order Detail</h3>
<div class="row first-row">
    <div class="col-md-4">
        <?= Yii::t('app', 'Representative') ?>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input id="order-representative" class="form-control" readonly aria-invalid="false" type="text">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <?= Yii::t('app', 'Payment Method') ?>
    </div>
    <div class="col-md-8">
        <?php
        //$model->payment_method_for_rent = '1';
        echo $form->field($model, 'payment_method')->radioList([
            '1' => 'Credit Card',
            // '2' => 'Cash on Delivery',
            '3' => 'Bank Transfer',
        ])->label(false);
        ?>
        <div class="payment_slip">    
            <?=
            $form->field($model, 'payment_slip')->widget(FileInput::classname(), [

                'pluginOptions' => [
                    'showUpload' => true,
                    'initialPreview' => [
                        $model->payment_slip ? Html::img(Yii::$app->request->baseUrl . '../../uploads/' . $model->payment_slip) : null, // checks the models to display the preview
                    ],
                    'overwriteInitial' => false,
                ],
            ]);
            ?>
        </div>  
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= Yii::t('app', 'Postal Code') ?>
    </div>
    <div class="col-md-8">
        <?php
        echo $form->field($model, 'postal_code')->widget(Select2::classname(), [
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a Postal Code ...'],
            'pluginOptions' => [
                'allowClear' => true,
                //'autocomplete' => true,
                'ajax' => [
                    'url' => '../postcode/all-code',
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) { ; return {q:params.term}; }')
                ],
            ],
        ])->label(false);
        ?>
    </div>

</div>
   