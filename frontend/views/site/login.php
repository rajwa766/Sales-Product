<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
body
{
	background-image:url('../images/login.jpg');
	background-repeat:no-repeat;
	background-size:cover;
}
.white-text
{
	color:white;
	text-color:white;
}
</style>
<div class="col-md-12">
<div class="col-md-8">
    <h2 class="white-text"><?= Html::encode($this->title) ?></h2>

    <p class="white-text">Please fill out the following fields to login:</p>

  
        <div class="">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('username',['class'=>'white-text']) ?>

                <?= $form->field($model, 'password')->passwordInput()->label('password',['class'=>'white-text']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('remember me',['class'=>'white-text']) ?>

                <div style="color:#fff;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::a('Signup', ['/site/signup'], ['class'=>'btn btn-success']) ?>

                </div>

            <?php ActiveForm::end(); ?>
        
    </div>
</div>
</div>
