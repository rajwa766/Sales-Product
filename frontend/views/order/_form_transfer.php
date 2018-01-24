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
$Role =   Yii::$app->authManager->getRolesByUser($user_id);
$RoleName= array_keys($Role)[0];
?>

<!-- order starts from here-->
<div class="request-setting">
    <div class="">
<div class="row">
<?php
 $user_id = Yii::$app->user->getId();
 $Role =   Yii::$app->authManager->getRolesByUser($user_id);
 if(isset($Role['super_admin'])){
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
}else{
        echo $form->field($model, 'all_level')->hiddenInput(['value'=> Yii::$app->user->identity->user_level_id])->label(false);
} 
    ?>
</div>

<?php
 $user_id = Yii::$app->user->getId();
 $Role =   Yii::$app->authManager->getRolesByUser($user_id);
 if(isset($Role['super_admin'])){
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
                'url' => '../order/parentuser',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-all_level").val();return {q:params.term,type:type}; }')
            ],
        ],
        ])->label(false);
   
    ?>
    </div>
    </div>
<?php
 }else{
    echo $form->field($model, 'parent_user')->hiddenInput(['value'=> Yii::$app->user->identity->parent_id])->label(false);
}  
?>


<div class="row">
<div class="col-md-4">
    Transfer to
    </div>
    <div class="col-md-8">
        <?php
         if(isset($Role['super_admin'])){
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
                          var parent = $("#parent_sected_user").val();
                          var type = $("#order-all_level").val();
                          return {q:params.term,type:type,parent:parent}; }')
                  ],
              ],
              ])->label(false); 
         }else{
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
<div class="row">
<div class="col-md-9 order-panel">
    <h3>Order Detail</h3>
    <div class="row first-row">
    <div class="col-md-4">
    Order Ref/No
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'order_ref_no')->textInput(['maxlength' => true])->label(false) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Representative
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'order_ref_no')->textInput(['maxlength' => true])->label(false) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Select Shipper
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'shipper')->radioList([
                1 => 'EMS', 
             
                8 => 'Kerry BKK SAME DAY',
            ])->label(false); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    COD
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'cod')->textInput(['maxlength' => true])->label(false) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Additional Requirements
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'additional_requirements')->textarea(['rows' => '3'])->label(false) ?>

    </div>
</div>
<div class="row">
    <div class="col-md-4">
    Payment Method
    </div>
    <div class="col-md-8">
    <?php 
              //$model->payment_method_for_rent = '1';
echo $form->field($model, 'payment_method')->radioList([
    '1' => 'Credit Card',
    '2' => 'Cash on Delivery',
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
    <!-- Additional file -->
    </div>
    <div class="col-md-8">
    <?php
// $form->field($model, 'file')->widget(FileInput::classname(), [
//                     'pluginOptions' => [
//                         'allowedFileExtensions' => ['jpg', 'gif', 'png', 'bmp','pdf','jpeg'],
//                         'showUpload' => true,
//                         'initialPreview' => [
//                           //  $model->upload_invoice ? Html::img(Yii::$app->request->baseUrl . '/uploads/' . $model->upload_invoice) : null, // checks the models to display the preview
//                         ],
//                         'overwriteInitial' => true,
//                     ],
//                 ])->label(false);
//                 ?>
    </div>

</div>
</div>
</div>
<!-- this is order items section -->
<div class="row outer-container">
 <div class="col-md-9 order-panel">
    <h3>Order Items</h3>
    <div class="row first-row">
    <?php 
    echo $form->field($model, 'status')->hiddenInput(['value'=> '3'])->label(false);
    ?>

    <?php
        echo $form->field($model, 'product_id')->hiddenInput(['value'=> '1'])->label(false);
        
    ?>
      <?php
         if(!isset($Role['super_admin'])){
          $order_quantity = (new Query())
          ->select('SUM(remaining_quantity) as remaning_stock')
          ->from('stock_in')   
          ->where("user_id = '$user_id'")
          ->andWhere("product_id = '1'")
          ->groupby(['product_id'])
          ->one();
          ?>
    <div class="col-md-2">Total Stock
    
    </div>
    <div class="col-md-10" style="margin-bottom: 10px;">
  
    <input type="text" id="order-orde" readonly="true" class="form-control" value="<?=  $order_quantity['remaning_stock'] ?>" name="Order[total_stock]" maxlength="45">

          
</div>
<?php
         }else{ ?>
      <div class="col-md-2">Total Stock
    
    </div>
    <div class="col-md-10" style="margin-bottom: 10px;">
    <input type="text" id="order-orde" readonly="true" class="form-control" value="" name="Order[total_stock]" maxlength="45">

  

          
</div>
    <?php     }
         ?>
    <input type="hidden" id="parent_sected_user" readonly="true" class="form-control" value="" name="Order[total_stock]" maxlength="45">
         
          <div class="col-md-4"><?php echo $form->field($model, 'entity_type')->textInput(['maxlength' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'single_price')->textInput(['readonly' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'total_price')->textInput(['readonly' => true]); ?></div>
      <div class="noproduct"></div>
</div>
         </div>
</div>
<!-- this is customer section-->

<!-- customer section ends here-->



<div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {

    $('#order-parent_user').on('change', function () {
        var product_id = '1';
        $.post("../stock-in/getunits?id="+product_id+"&user_id="+$(this).val(), function (data) {
    $('#order-orde').val(data);
        });
        $.post("../user/getparentid?id="+$(this).val(), function (id_parent) {
            $("#order-child_user").select2('val', 'All');
    $('#parent_sected_user').val(id_parent);
        });
    });

$('#order-entity_type').on('blur', function () {
    if (parseInt($('#order-orde').val()) >= parseInt($('#order-entity_type').val())){
    if($('#order-entity_type').val()){
            $(".noproduct").hide();   
                       $('#order-single_price').val('760');
                       $('#order-total_price').val($('#order-entity_type').val() * 760);
          
        }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>the value can not empty and must be less then stock amount</h5>");
        }   
    }else{
        $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>OO no man this exceed the stock </h5>");
            $('#order-entity_type').val('');
        
    }
    });

    });

</script>