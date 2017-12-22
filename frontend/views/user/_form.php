<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
    
    </div>
</div>    


  
    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    </div>
    <div class="col-md-6">
    <?php
        if ($model->isNewRecord) {
            $model->status = '1';
        }
        ?>
<?= $form->field($model, 'status')->checkbox() ?>
    
    </div>
</div>   
    

    <div class="row">
    <div class="col-md-6">
    <label>Use Level</label>
                <?php
                echo Select2::widget([
                    'model' => $model,
                    'attribute' => 'user_level_id',
                    'data' => common\models\UsersLevel::getlevel(),
                    'id' => 'account-type',
                    'options' => ['placeholder' => 'Select Customer Name ...'],
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
    </div>
</div>   


    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'city')->textInput() ?>
    
    </div>
</div>   
<div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'country')->textInput() ?>
    </div>
    <div class="col-md-6">
    </div>
</div>  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
