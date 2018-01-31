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


<div class="order-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row main-container">
        <div class="row">
            <div class="col-md-9 order-setting-panel top_row">


                <?php
                $user_id = Yii::$app->user->getId();
                $Role = Yii::$app->authManager->getRolesByUser($user_id);
                $RoleName = array_keys($Role)[0];
                ?>

                <!-- order starts from here-->
                <div class="request-setting">
                    <div class="">
                        <div class="row">
                            <?php
                            $user_id = Yii::$app->user->getId();
                            $Role = Yii::$app->authManager->getRolesByUser($user_id);
                            if (isset($Role['super_admin'])) {
                                ?>
                                <div class="col-md-4">
                                    User Level
                                </div>
                                <div class="col-md-8">
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
                                    ])->label(false);
                                    ?>
                                </div>
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
                'url' => '../user/parentuser',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-all_level").val();return {q:params.term,type:type}; }')
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
                'url' => '../order/parentuser',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { 
                          var parent = $("#parent_sected_user").val();
                          var type = $("#order-all_level").val();
                          return {q:params.term,type:type,parent:parent}; }')
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
                'url' => '../order/parentuseradmin',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { 
                    var parent = $("#order-parent_user").val();
                    var type = $("#order-all_level").val();
                    return {q:params.term,type:type,parent:parent}; }')
            ],
        ],
    ])->label(false);
}
?>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- this is order detail section -->
        <div class="row">
            <div class="col-md-9 order-panel">
<?=
Yii::$app->controller->renderPartial('_order_detail', [
    'model' => $model,
    'form' => $form,
]);
?>
            </div>
        </div>
        <!-- this is order items section -->
        <div class="row ">
            <div class="col-md-9 order-panel">
<?=
Yii::$app->controller->renderPartial('_order_item', [
    'model' => $model,
    'form' => $form,
]);
?>
            </div>
        </div>
        <input type="hidden" id="parent_sected_user" readonly="true" class="form-control"  maxlength="45">


        <div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>
        </div>

            <?php ActiveForm::end(); ?>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {

            $('#order-parent_user').on('change', function () {
                var product_id = '1';
                $.post("../stock-in/getunits?id=" + product_id + "&user_id=" + $(this).val(), function (data) {
                    $('#order-orde').val(data);
                });
                $.post("../user/getparentid?id=" + $(this).val(), function (id_parent) {
                    $("#order-child_user").select2('val', 'All');
                    $('#parent_sected_user').val(id_parent);
                });
            });

            $('#order-quantity').on('blur', function () {
                if (parseInt($('#order-orde').val()) >= parseInt($('#order-quantity').val())) {
                    if ($('#order-quantity').val()) {
                        $(".noproduct").hide();
                        $('#order-single_price').val('760');
                        $('#order-total_price').val($('#order-quantity').val() * 760);

                    } else {
                        $(".noproduct").show();
                        $(".noproduct").html("<h5 style='text-align:center;color:red;'>The value can not empty and must be less then stock amount</h5>");
                    }
                } else {
                    $(".noproduct").show();
                    $(".noproduct").html("<h5 style='text-align:center;color:red;'>Out of Stock</h5>");
                    $('#order-quantity').val('');

                }
            });

        });

    </script>