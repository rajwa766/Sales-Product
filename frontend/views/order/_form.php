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
<?php  if (!Yii::$app->user->isGuest) {?>
<div class="row">
<div class="col-md-9 order-setting-panel top_row">
    <div class="row">
        <div class="col-md-4">
        Type
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'order_type')->dropdownList([
             'Order' => 'Order',
            'Request' => 'Request',
           ],
           ['id' => 'order-type']
       
     )->label(false) ?>
        </div>
    </div>

 <?php
    $user_id = Yii::$app->user->getId();
    $Role =   Yii::$app->authManager->getRolesByUser($user_id);
$Role =   Yii::$app->authManager->getRolesByUser($user_id);
$RoleName= array_keys($Role)[0];
        ?>

<!-- order starts from here-->
<div class="request-setting">
    <div class="admin">
<div class="row">
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


<div class="row">
<div class="col-md-4">
    Parent User
    </div>
    <div class="col-md-8">
       <?php
    
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
    }else{
        echo $form->field($model, 'parent_user')->widget(Select2::classname(), [
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a Parent User ...','value'=>Yii::$app->user->identity->parent_id],
      
          ])->label(false); 
    }
    ?>
    </div>
</div>

<div class="row">
<div class="col-md-4">
    Child Level
    </div>
    <div class="col-md-8">
        <?php
         if(isset($Role['super_admin'])){
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
    }else{
        echo $form->field($model, 'child_level')->widget(Select2::classname(), [
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'Select a Parent User ...','value'=>Yii::$app->user->identity->id],
      
          ])->label(false);  
    }
    ?>
    </div>
</div>

<div class="row">
<div class="col-md-4">
    Child Name
    </div>
    <div class="col-md-8">
        <?php
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
    User Level
    </div>
    <div class="col-md-8">
      <?php
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
    Agent Name
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
  
    </div>

</div>


</div>
</div>
<?php } ?>
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
                2 => 'Register',
                3 => 'Alpha', 
                4 => 'Lazada',
                5 => 'WH Pick up', 
                6 => 'KerryND',
                7 => 'Kerry2D (UPC)', 
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
    <?= $form->field($model, 'cod')->textarea(['rows' => '3'])->label(false) ?>
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
    echo $form->field($model, 'product_id')->hiddenInput(['value'=> '1'])->label(false);
  
    ?>
    <div class="stock_field">
        <?php   if(!Yii::$app->user->isGuest){?>
     <div class="col-md-2">Total Stock
    
    </div>
    <div class="col-md-10" style="margin-bottom: 10px;">
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
    <input type="text" id="order-orde" readonly="true" class="form-control" value="<?=  $order_quantity['remaning_stock'] ?>" name="Order[total_stock]" maxlength="45">

          <?php
         }else{
 ?>
    <input type="text" id="order-orde" readonly="true" class="form-control" name="Order[total_stock]" maxlength="45">
    <?php } 
        
    ?>
</div>
    </div>
         <?php }?>   

      <div class="col-md-4"><?php echo $form->field($model, 'entity_type')->textInput(['maxlength' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'single_price')->textInput(['maxlength' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'total_price')->textInput(['maxlength' => true]); ?></div>
    <div class="col-md-2">
  Quantity
    </div>
  
    <div class="col-md-8">
             <?php
    echo $form->field($model, 'entity_type')->textInput(['maxlength' => true])->label(false);
                ?> 
        <?php
                
 

 ?>
 

    </div>
    <div class="col-md-2"> <?php if(!Yii::$app->user->isGuest){ ?>
    <button class=" btn btn-brand-primary add-button" id="add-button" type="button"><span class="loading-next-btn"></span>add item</button>
        <button class=" btn btn-brand-primary add-button" id="add-butto_customer" type="button"><span class="loading-next-btn"></span>add item</button>
    <?php }else{ 
    
        ?>
    <button class=" btn btn-brand-primary add-button" id="add-butto_customer_before_login" type="button"><span class="loading-next-btn"></span>add item</button>

    <?php 
    echo $form->field($model, 'request_agent_name')->hiddenInput(['value'=> $_GET['id']])->label(false);
    echo $form->field($model, 'order_type')->hiddenInput(['value'=> 'Order'])->label(false);
    echo $form->field($model, 'order_type')->hiddenInput(['value'=> 'Order'])->label(false);
    
} ?>
    </div>
</div>
<input type="hidden" id="order-hidden" class="form-control" name="Order[product_order_info]" maxlength="45"  aria-invalid="true">

<div class="row">
  <div class="noproduct"></div>
    <div id="items_all"></div>
</div>        
</div>

</div>

<!-- this is customer section-->

<div class="row outer-container shipping-address">
<div class="col-md-9 order-panel">
    <h3>Shipping Address</h3>

    <div class="row first-row">
    
    <div class="col-md-4">
    Email
    </div>
    <div class="col-md-8">
   
        <?= $form->field($model, 'email')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Mobile
    </div>
    <div class="col-md-8">

        <?= $form->field($model, 'mobile_no')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Phone
    </div>
    <div class="col-md-8">

        <?= $form->field($model, 'phone_no')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    District
    </div>
    <div class="col-md-8">
   
        <?= $form->field($model, 'district')->textInput()->label(false) ?>
   
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Province
    </div>
    <div class="col-md-8">
  
        <?= $form->field($model, 'province')->textInput()->label(false) ?>
    
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Postal Code
    </div>
    <div class="col-md-8">
   
        <?= $form->field($model, 'postal_code')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Address
    </div>
    <div class="col-md-8">
      
        
         <?= $form->field($model, 'address')->textInput()->label(false) ?>
   
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Country
    </div>
    <div class="col-md-8">
      
        
         <?= $form->field($model, 'country')->textInput()->label(false) ?>
   
    </div>
</div>

</div>
</div>


<!-- customer section ends here-->
<div class="help-block help-block-error vehcle_not_found" style="color: #a94442;"></div>


<div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
    $('#order-request_agent_name').on('change', function () {
        $.post("../stock-in/getunits?id=" + $('#order-product_id').val()+"&user_id="+$(this).val(), function (data) {
    $('#order-orde').val(data);
        });
    });
    $('#order-rquest_customer,#order-child_user').on('change', function () {
        $.post("../user/getuseraddress?id=" + $(this).val(), function (data) {
    
     var json = $.parseJSON(data);

     $('#order-email').val(json.email);
     $('#order-mobile_no').val(json.mobile_no);
     $('#order-phone_no').val(json.phone_no);
     $('#order-district').val(json.district);
     $('#order-province').val(json.province);
     $('#order-postal_code').val(json.postal_code);
     $('#order-address').val(json.address);
     $('#order-country').val(json.country);
     
     
        });
    });

   

    $('.save-button').click(function(e){
  if(db_items.clients == ''){
    $('.vehcle_not_found').html('Add Product Order Please');
    e.preventDefault();
    return;
  }else{
    $('#order-hidden').val(JSON.stringify({order_info: db_items.clients }));
 
  }
});


  
$("#items_all").jsGrid({
//height: "70%",
        width: "100%",
        filtering: true,
        editing: true,
        inserting: true,
        sorting: true,
//paging: true,
        autoload: true,
//pageSize: 15,
//pageButtonCount: 5,
        controller: db_items,
        fields: [
           // {name: "item_number", title: "Item Number", id: "item_number", width: "auto", type: "hidden"},
            {name: "unit", title: "Units", type: "text",  width: "auto"},
            {name: "price", title: "Price", type: "text",  width: "auto"},
            {name: "total_price", title: "Total Price", type: "text",  width: "auto"},
           //{ name: "Married", title: "Marié", type: "checkbox", sorting: false },
            {type: "control"}
        ]
    });
     $('.jsgrid-insert-mode-button').click();
     $('#order-entity_type').on('blur', function () {
          if($('#order-entity_type').val()){
            $(".noproduct").hide();
            var size = db_items.clients.length;
            if(size < '1'){
      db_items.clients.push({
                           unit: $('#order-entity_type').val(),
                           price: 760,
                           total_price: $('#order-entity_type').val() * 760,
                       });
                       console.log(db_items.clients);
            $("#items_all").jsGrid("loadData");
            }else{
                $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You can Only add one order</h5>");
              
            }
            // $("#items_all").refresh();
        }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>the value can not empty and must be less then stock amount</h5>");
                
        }
        });
        $('#add-butto_customer_before_login').on('click', function () {

        
            $(".noproduct").hide();
            var size = db_items.clients.length;
           if(size < '1'){
      db_items.clients.push({
                           unit: $('#order-entity_type').val(),
                           price: '780',
                           total_price: parseFloat($('#order-entity_type').val())  * '780' ,
                       });
                       console.log(db_items.clients);
            $("#items_all").jsGrid("loadData");
           }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You can Only add one order</h5>");
               
           }
      
        
    });
     $('#add-button').on('click', function () {

        $.post("../user-product-level/getunitsprice?id=" + $('#order-entity_type').val()+"&user_level="+$('#order-child_level').val()+"&product_id="+$('#order-product_id').val(), function (data) {
         
        var json = $.parseJSON(data);
        if(json.price){
            $(".noproduct").hide();
            var size = db_items.clients.length;
           if(size < '1'){
      db_items.clients.push({
                           unit: $('#order-entity_type').val(),
                           price: json.price,
                           total_price: parseFloat($('#order-entity_type').val())  * parseFloat(json.price) ,
                       });
                       console.log(db_items.clients);
            $("#items_all").jsGrid("loadData");
           }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You can Only add one order</h5>");
               
           }
        }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You cannot purchse Minimun then this "+json.units+"</h5>");
        }
        });
    });
    <?php if(!Yii::$app->user->isGuest){ ?>
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
        jQuery(".stock_field").hide();
        jQuery("#add-butto_customer").hide();
        jQuery("#add-button").show();
        jQuery("#order-email").hide();
    }
    else
    {
        jQuery(".request-setting").hide();
        jQuery(".order-setting").show();
        jQuery(".shipping-address").show();
        jQuery(".stock_field").show();
        jQuery("#add-butto_customer").show();
        jQuery("#add-button").hide();
    }

}
<?php }else{?>
});
<?php } ?>

</script>
