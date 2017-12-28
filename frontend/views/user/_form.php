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
    <div class="row no-margin">
    <div class="col-md-6">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    
    </div>
</div>   
    <div class="row no-margin">
    <div class="col-md-6">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly' => !$model->isNewRecord]) ?>
    
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
    
    </div>
</div>    


  
    <div class="row no-margin">
    <div class="col-md-6">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
    </div>
</div>   
    
     <div class="row no-margin">
    <div class="col-md-6">
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'city')->textInput() ?>
    
    </div>
</div> 
<?php
    $user_id = Yii::$app->user->getId();
    $Role =   Yii::$app->authManager->getRolesByUser($user_id);
    if(isset($Role['super_admin'])){ ?>
<div class="row no-margin">
    <div class="col-md-6">
    <?php
            echo $form->field($model, 'all_level')->widget(Select2::classname(), [
                'data' => common\models\UsersLevel::getalllevel(),
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Select a Level  ...'],
                //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
            
                'theme' => Select2::THEME_BOOTSTRAP,
                'pluginOptions' => [
                'allowClear' => true,
                ],

            ]);
            ?>
    </div>
    <div class="col-md-6">
    <?php
echo $form->field($model, 'parent_user')->widget(Select2::classname(), [
  'theme' => Select2::THEME_BOOTSTRAP,
  'options' => ['placeholder' => 'Select a Parent User ...'],
  'pluginOptions' => [
    'allowClear' => true,
    //'autocomplete' => true,
    'ajax' => [
        'url' => '../user/parentuser',
        'dataType' => 'json',
        'data' => new \yii\web\JsExpression('function(params) { var type = $("#user-all_level").val();return {q:params.term,type:type}; }')
    ],
],
]);
         
            ?>
    </div>
</div>  
<?php } ?>
    <div class="row no-margin">
        <div class="col-md-6">
    <?= $form->field($model, 'country')->textInput(['readonly' =>true,'value'=>'Thailand ']) ?>
    </div>
         <?php if($model->isNewRecord){?>
    <div class="col-md-6">
    <?php
    $user_id = Yii::$app->user->getId();
    $Role =   Yii::$app->authManager->getRolesByUser($user_id);
    if(isset($Role['super_admin'])){ ?>
   <?php
echo $form->field($model, 'user_level_id')->widget(Select2::classname(), [
  'theme' => Select2::THEME_BOOTSTRAP,
  'options' => ['placeholder' => 'Select a current user Level ...'],
  'pluginOptions' => [
    'allowClear' => true,
    //'autocomplete' => true,
    'ajax' => [
        'url' => '../user/level',
        'dataType' => 'json',
        'data' => new \yii\web\JsExpression('function(params) { var type = $("#user-all_level").val();return {q:params.term,type:type}; }')
    ],
],
]);
         
            ?>


    <?php }else{?>
    <label>Use Level</label>
                <?php
                echo Select2::widget([
                    'model' => $model,
                    'attribute' => 'user_level_id',
                    'data' => common\models\UsersLevel::getlevel(),
                    'id' => 'account-type',
                    'options' => ['placeholder' => 'Select Level ...'],
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
              ?>
    </div>
    <?php  } ?>
    </div>
    <?php } ?>
    
</div>   
  
<div class="row no-margin">
    <div class="col-md-6">
    <?php
        if ($model->isNewRecord) {
            $model->status = '1';
        }
        ?>
<?= $form->field($model, 'status')->checkbox() ?>
    
    </div>
    <div class="col-md-6">
    </div>
</div>  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
