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

<style>
.order-setting-panel
{
    display:none;
}
</style>
<div class="order-form">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row main-container">
<div class="row">
<div class="col-md-9 order-setting-panel top_row">
    <div class="row">
        <div class="col-md-4">
        <?= Yii::t('app', 'Type') ?>
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'order_type')->dropdownList([
            //  'Order' => 'Order',
            'Request' => 'Request',
           ],
           ['id' => 'order-type']
       
     )->label(false) ?>
        </div>
    </div>

 <?php
$user_id = Yii::$app->user->getId();
$Role =   Yii::$app->authManager->getRolesByUser($user_id);
$RoleName= array_keys($Role)[0];
?>

<!-- order starts from here-->
<div class="request-setting">
    <div class="admin">
<div class="row">
<div class="col-md-4">
   <?= Yii::t('app', 'User Level') ?>
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


<div class="row">
<div class="col-md-4">
    <?= Yii::t('app', 'Parent User') ?>
    </div>
    <div class="col-md-8">
       <?php
       $user_id = Yii::$app->user->getId();
       $Role =   Yii::$app->authManager->getRolesByUser($user_id);
       if(isset($Role['super_admin'])){
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
<input id="not_admin" name="admin" value="1" type="hidden">

        <?php
    }else{
        echo $form->field($model, 'parent_user')->widget(Select2::classname(), [
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a Parent User ...','value'=>Yii::$app->user->identity->parent_id],
      
          ])->label(false); ?>
<input id="not_admin" name="admin" value="0" type="hidden">
          <?php
      
    }
    ?>
    </div>
</div>

<div class="row">
<div class="col-md-4">
     <?= Yii::t('app', 'Child Level') ?>
    </div>
    <div class="col-md-8">
        <?php
        echo $form->field($model, 'child_level')->widget(Select2::classname(), [
          'theme' => Select2::THEME_BOOTSTRAP,
          'options' => ['placeholder' => 'Select a child user Level ...'],
          'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../order/customer-level',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-all_level").val(); return {q:params.term,type:type}; }')
            ],
        ],
        ])->label(false);
 
    ?>
    </div>
</div>

<div class="row">
<div class="col-md-4">
    <?= Yii::t('app', 'Child Name') ?>
    </div>
    <div class="col-md-8">
        <?php
           $user_id = Yii::$app->user->getId();
           $Role =   Yii::$app->authManager->getRolesByUser($user_id);
           if(isset($Role['super_admin'])){
        echo $form->field($model, 'child_user')->widget(Select2::classname(), [
          'theme' => Select2::THEME_BOOTSTRAP,
          'options' => ['placeholder' => 'Select a current user Level ...'],
          'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../order/level',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-parent_user").val(); 
var typeone = $("#order-child_level").val();
                 return {q:params.term,type:type,typeone:typeone}; }')
            ],
        ],
        ])->label(false);
    }else{
        echo $form->field($model, 'child_user')->widget(Select2::classname(), [
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a current user Level ...','value'=>Yii::$app->user->identity->id],
         
          ])->label(false);  
    }
    ?>
    </div>
</div>
</div>
</div>
<!-- customer part start here -->

<div class="order-setting">
    <div class="admin">
<div class="row">
<div class="col-md-4">
    l <?= Yii::t('app', 'User Leve') ?>
    </div>
    <div class="col-md-8">
      <?php
        $user_id = Yii::$app->user->getId();
        $Role =   Yii::$app->authManager->getRolesByUser($user_id);
        if(isset($Role['super_admin'])){
    echo $form->field($model, 'request_user_level')->widget(Select2::classname(), [
        'data' => common\models\UsersLevel::getalllevel(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a Level  ...'],
        //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
    
        'theme' => Select2::THEME_BOOTSTRAP,
        'pluginOptions' => [
            'allowClear' => true,
        ],

    ])->label(false);
    }else{
        echo $form->field($model, 'request_user_level')->widget(Select2::classname(), [
           
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a Level  ...','value'=>Yii::$app->user->identity->user_level_id],
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
            
            $user_id = Yii::$app->user->getId();
         $Role =   Yii::$app->authManager->getRolesByUser($user_id);
         if(isset($Role['super_admin'])){
        echo $form->field($model, 'request_agent_name')->widget(Select2::classname(), [
          'theme' => Select2::THEME_BOOTSTRAP,
          'options' => ['placeholder' => 'Select a agent name ...'],
          'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../order/parentuser',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-request_user_level").val(); return {q:params.term,type:type}; }')
            ],
        ],
        ])->label(false);
    }else{
      
        
     
    echo $form->field($model, 'request_agent_name')->widget(Select2::classname(), [
      'theme' => Select2::THEME_BOOTSTRAP,
      'options' => ['placeholder' => 'Select a agent name ...','value'=>Yii::$app->user->identity->id],
     
    ])->label(false);
    }
    ?>
    </div>
</div>
</div>
 <div class="agent">
    <div class="row">
    <div class="col-md-4">
       <?= Yii::t('app', 'Customer Name') ?>
        </div>
        <div class="col-md-8">
            <?php
            echo $form->field($model, 'rquest_customer')->widget(Select2::classname(), [
              'theme' => Select2::THEME_BOOTSTRAP,
              'options' => ['placeholder' => 'Select a customer name ...'],
              'pluginOptions' => [
                'id' => 'customer-name',
                'allowClear' => true,
                //'autocomplete' => true,
                'ajax' => [
                    'url' => '../user/allcustomers',
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) {  return {q:params.term}; }')
                ],
            ],
            
            ])->label(false);
     
        ?>
        </div>
    </div>

</div>


</div>
</div>
<div class="row">
<div class="col-md-9 order-panel">
    <h3><?= Yii::t('app', 'Order Detail') ?></h3>
    <div class="row first-row">
    <div class="col-md-4">
     <?= Yii::t('app', 'Order Ref/No') ?>
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'order_ref_no')->textInput(['maxlength' => true])->label(false) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
     <?= Yii::t('app', 'Representative') ?>
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'order_ref_no')->textInput(['maxlength' => true])->label(false) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
     <?= Yii::t('app', 'Select Shipper') ?>
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'shipper')->radioList([
                1 => 'EMS', 
          
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
    
   <?=  Yii::t('app', 'Additional Requirements'); ?>
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'additional_requirements')->textarea(['rows' => '3'])->label(false) ?>
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
    <h3> <?= Yii::t('app', 'Order Items') ?></h3>
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
    <div class="col-md-2"> <?= Yii::t('app', 'Total Stock') ?>
    
    </div>
    <div class="col-md-10" style="margin-bottom: 10px;">
    
    <input type="text" id="order-orde" readonly="true" class="form-control" value="<?=  $order_quantity['remaning_stock'] ?>" name="Order[total_stock]" maxlength="45">

          
</div>
<?php
         }
         ?> 
             <div class="col-md-4"><?php echo $form->field($model, 'entity_type')->textInput(['maxlength' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'single_price')->textInput(['readonly' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'total_price')->textInput(['readonly' => true]); ?></div>
      <div class="noproduct"></div>
     
</div>

</div>
</div>
<!-- this is customer section-->




<!-- customer section ends here-->
<div class="help-block help-block-error vehcle_not_found" style="color: #a94442;"></div>


<div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
    $('#order-product_id').on('change', function () {
        $.post("../stock-in/getunits?id=" + $(this).val()+"&user_id="+$('#order-child_user').val(), function (data) {
    $('#order-orde').val(data);
        });
    });
  


     $('#order-entity_type').on('blur', function () {
         //if admin
if($('#not_admin').val() == '1'){

        $.post("../user-product-level/getunitsprice?id=" + $('#order-entity_type').val()+"&user_level="+$('#order-child_level').val()+"&product_id="+$('#order-product_id').val(), function (data) {
         
        var json = $.parseJSON(data);
        if(json.price){
            $(".noproduct").hide();
            $(".noproduct").hide();
                       $('#order-single_price').val(json.price);
                       $('#order-total_price').val(parseFloat($('#order-entity_type').val())  * parseFloat(json.price));
      
        }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You cannot purchse Minimun then this "+json.units+"</h5>");
            $('#order-entity_type').val('');
        }
        });
}else{
    //if agent
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
}
    });


    TypeChange();
    var role="<?php echo array_keys($Role)[0];?>";
    if(role=='super_admin')
    {
        $('.admin').show();
        $('.order-setting-panel').show();
    }
    else if(role=='general')
    {
         $('.admin').hide();
         $('.agent').show();
         $('.order-setting-panel').show();
    }
    jQuery('#order-type').on('change', function() {

        TypeChange();
    });
});
function TypeChange()
{
    var value = $('#order-type option:selected').text();
    if(value == "Request")
    {
         jQuery(".order-setting").hide();
         jQuery(".request-setting").show();
        //  jQuery(".shipping-address").hide();
    }
    else
    {
        jQuery(".request-setting").hide();
        jQuery(".order-setting").show();
        jQuery(".shipping-address").show();
    }

}

</script>
