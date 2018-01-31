<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\models\order;
use kartik\file\FileInput;
use yii\db\Query;
?>

<!-- customer part start here -->
<div class="order-setting">
    <div class="admin">
        <div class="row first-row">
            <div class="col-md-4">
                <?= Yii::t('app', 'User Level') ?>
            </div>
            <div class="col-md-8">
                <?php
                    if (isset($Role['super_admin'])) {
                        echo $form->field($model, 'request_user_level')->widget(Select2::classname(), [
                            'data' => common\models\UsersLevel::getAllLevels(),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => ['placeholder' => 'Select a Level  ...'],
                            //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ])->label(false);
                    } else {
                        echo $form->field($model, 'request_user_level')->widget(Select2::classname(), [

                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => ['placeholder' => 'Select a Level  ...', 'value' => Yii::$app->user->identity->user_level_id],
                            //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ])->label(false);
                    }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= Yii::t('app', 'Agent Name') ?>
            </div>
            <div class="col-md-8">

                <?php
                if (isset($Role['super_admin'])) {
                    echo $form->field($model, 'request_agent_name')->widget(Select2::classname(), [
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Select a agent name ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            //'autocomplete' => true,
                            'ajax' => [
                                'url' => '../user/get-users',
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { var user_level = $("#order-request_user_level").val(); return {q:params.term,user_level:user_level}; }')
                            ],
                        ],
                    ])->label(false);
                } else {



                    echo $form->field($model, 'request_agent_name')->widget(Select2::classname(), [
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Select a agent name ...', 'value' => Yii::$app->user->identity->id],
                    ])->label(false);
                }
                ?>
            </div>
        </div>
    </div>
    <div class="agent">
        <div class="row">

        </div>

    </div>
</div>