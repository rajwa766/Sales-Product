<?php
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
?>
<!-- Agent order starts from here-->
<div class="transfer-setting">
    <div class="first-row">
    <div class="row first-row admin">
                            <?php
if (isset($Role['super_admin'])) {
    ?>
                                <div class="col-md-4">
                                    User Level
                                </div>
                                <div class="col-md-8">
                                    <?php
echo $form->field($model, 'all_level')->widget(Select2::classname(), [
        'data' => common\models\UsersLevel::getAlllevels(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a Level  ...'],
        //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
        'theme' => Select2::THEME_BOOTSTRAP,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false);
    ?>
                                </div>

                                    <?php
} else {
    echo $form->field($model, 'all_level')->hiddenInput(['value' => Yii::$app->user->identity->user_level_id])->label(false);
}
?>
                    </div>

                        <?php
$user_id = Yii::$app->user->getId();
$Role = Yii::$app->authManager->getRolesByUser($user_id);
if (isset($Role['super_admin'])) {
    ?>
                        <div class="row">
                            <div class="col-md-4">
                                Transfer From
                            </div>
                            <div class="col-md-8">
    <?php
echo $form->field($model, 'parent_user')->widget(Select2::classname(), [
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a Parent User ...'],
        'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../user/get-users',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var user_level = $("#order-all_level").val();return {q:params.term,user_level:user_level}; }'),
            ],
        ],
    ])->label(false);
    ?>
                            </div>
                        </div>
                                <?php
} else {
    echo $form->field($model, 'parent_user')->hiddenInput(['value' => Yii::$app->user->identity->parent_id])->label(false);
}
?>


                    <div class="row">
                        <div class="col-md-4">
                            Transfer to
                        </div>
                        <div class="col-md-8">
<?php
if (isset($Role['super_admin'])) {
    echo $form->field($model, 'child_user')->widget(Select2::classname(), [
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a child user Level ...'],
        'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../user/get-users',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) {
                          var parent_id = $("#parent_sected_user").val();
                          var user_level = $("#order-all_level").val();
                          return {q:params.term,user_level:user_level,parent_id:parent_id}; }'),
            ],
        ],
    ])->label(false);
} else {
    echo $form->field($model, 'child_user')->widget(Select2::classname(), [
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a child user Level ...'],
        'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../user/get-users',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) {
                    var parent_id = $("#order-parent_user").val();
                    var user_level = $("#order-all_level").val();
                    return {q:params.term,user_level:user_level,parent_id:parent_id}; }'),
            ],
        ],
    ])->label(false);
}
?>
                        </div>
                    </div>



    </div>
</div>