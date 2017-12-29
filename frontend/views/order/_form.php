<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\models\order;
use kartik\file\FileInput;


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
    Child Name
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
    User Level
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
    <div class="col-md-4">
        Customer Name
        </div>
        <div class="col-md-8">
            <?php
            echo $form->field($model, 'rquest_customer')->widget(Select2::classname(), [
              'theme' => Select2::THEME_BOOTSTRAP,
              'options' => ['placeholder' => 'Select a customer name ...'],
              'pluginOptions' => [
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
    <div class="col-md-2">
  Add Package
    </div>
    <div class="col-md-8">
        <?php
    $user_id = Yii::$app->user->getId();
 $Role =   Yii::$app->authManager->getRolesByUser($user_id);
 if(isset($Role['super_admin'])){
   
    echo $form->field($model, 'entity_type')->widget(Select2::classname(), [
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a Package  ...'],
        //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
    
        'theme' => Select2::THEME_BOOTSTRAP,
        'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../user-product-level/levelpakages',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-child_level").val();
                    var type_order = $("#order-type").val();
                    return {q:params.term,type:type,type_order:type_order}; }')
            ],
        ],

    ])->label(false);

 }else{
  
    echo $form->field($model, 'entity_type')->widget(Select2::classname(), [
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a Package  ...'],
        //'initValueText' => isset($model->customerUser->customer_name) ? $model->customerUser->company_name : "",
    
        'theme' => Select2::THEME_BOOTSTRAP,
        'pluginOptions' => [
            'allowClear' => true,
            //'autocomplete' => true,
            'ajax' => [
                'url' => '../user-product-level/levelpakages',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-request_user_level").val();
                    var type_order = $("#order-type").val();
                    return {q:params.term,type:type,type_order:type_order}; }')
            ],
        ],

    ])->label(false);

 }

 ?>
 

    </div>
    <div class="col-md-2">
        <button class=" btn btn-brand-primary add-button" id="add-button" type="button"><span class="loading-next-btn"></span>add item</button>
    </div>
</div>
<div id="itmes"></div>
<input type="hidden" id="order-hidden" class="form-control" name="Order[product_order_info]" maxlength="45"  aria-invalid="true">

<div class="row">
    <div class="table-responsive">
      <table class="table">
        <thead>
              <tr>
                <th>item number</th>
                <th>sokochan code</th>
                <th>item</th>
                <th>quantity</th>
                <th>Action</th>
              </tr>
            </thead>
      </table>
    </div>
    <div id="items_all"></div>
</div>        
</div>

</div>

<!-- this is customer section-->

<div class="help-block help-block-error vehcle_not_found" style="color: #a94442;"></div>


<div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
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
     $('#add-button').on('click', function () {

        $.post("../user-product-level/getunits?id=" + $('#order-entity_type').val(), function (data) {
          if(data){
        var json = $.parseJSON(data);
      db_items.clients.push({
                           unit: json.unit,
                           price: json.price,
                           total_price: parseFloat(json.unit)  * parseFloat(json.price) ,
                       });
                       console.log(db_items.clients);
            $("#items_all").jsGrid("loadData");
            $("#items_all").refresh();
        }else{
            $(".noinvoice").html("<h5 class='text-align:center'>There is no  vehicle or invoice has been created</h5>");
        }
        });
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
    }
    else
    {
        jQuery(".request-setting").hide();
        jQuery(".order-setting").show();
    }

}

</script>
