<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\models\order;

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
<?php $form = ActiveForm::begin(); ?>

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
    ?>
    </div>
</div>

<div class="row">
<div class="col-md-4">
    Agent Name
    </div>
    <div class="col-md-8">
        <?php
        echo $form->field($model, 'request_agent_name')->widget(Select2::classname(), [
          'theme' => Select2::THEME_BOOTSTRAP,
          'options' => ['placeholder' => 'Select a agent name ...'],
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
                    'url' => '../order/customer-level',
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) { var type = $("#order-all_level").val(); return {q:params.term,type:type}; }')
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
<div class="col-md-9 order_panel">
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
    Attach file
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'file[]')->fileInput(['multiple'=>'multiple'])->label(false) ?>
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
    Item
    </div>
    <div class="col-md-8">
    <?= $form->field($model, 'entity_type')->dropdownList([
        1 => 'bey dey',
       ]
   
 )->label(false) ?>
    </div>
    <div class="col-md-2">
        <button class=" btn btn-brand-primary add-button" id="add-button" type="button"><span class="loading-next-btn"></span>add item</button>
    </div>
</div>

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
</div>        
</div>

</div>

<!-- this is customer section-->
<div class="row">
<div class="col-md-9 order-panel">
    <h3>Order Detail</h3>

    <div class="row first-row">
    <div class="col-md-4">
    Order Ref/No
    </div>
    <div class="col-md-8">
     
        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Address
    </div>
    <div class="col-md-8">
   
        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Postal Code
    </div>
    <div class="col-md-8">
   
        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    District
    </div>
    <div class="col-md-8">
   
        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
   
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Province
    </div>
    <div class="col-md-8">
  
        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
    
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Mobile
    </div>
    <div class="col-md-8">

        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Phone
    </div>
    <div class="col-md-8">

        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
     
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    Email
    </div>
    <div class="col-md-8">
      
        <?= $form->field($model, 'user_id')->textInput()->label(false) ?>
   
    </div>
</div>

</div>
</div>
</div>

<div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
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
