<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\db\Query;
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.row{
    magin-left: 0px;
    magin-right: 0px;
    
}
</style>
<div class="user-form">
<div class="create-user">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            First Name
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false)  ?>
    </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-4">
            Last Name
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label(false)  ?>
    </div>
    </div>
</div>   
    <div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            Username
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly' => !$model->isNewRecord])->label(false)   ?>
    </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-4">
            Password
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'password')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
</div>    


  
    <div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            Email
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-4">
            Phone
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true])->label(false) ?>
</div>
    </div>
</div>   
    
     <div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            Address
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-4">
            City
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'city')->textInput()->label(false) ?>
    </div>
    </div>
</div> 
<?php
    $user_id = Yii::$app->user->getId();
    $Role =   Yii::$app->authManager->getRolesByUser($user_id);
    if(isset($Role['super_admin'])){ ?>
<div class="row no-margin">
    
    <div class="col-md-6">
        <div class="col-md-4">
            All Level
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
    <div class="col-md-6">
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
        'url' => '../user/parentuser',
        'dataType' => 'json',
        'data' => new \yii\web\JsExpression('function(params) { var type = $("#user-all_level").val();return {q:params.term,type:type}; }')
    ],
],
])->label(false);
         
            ?>
    </div>
</div>
</div>  
<?php } ?>
    <div class="row no-margin">
        <div class="col-md-6">
            <div class="col-md-4">
           Country
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'country')->textInput(['readonly' =>true,'value'=>'Thailand '])->label(false) ?>
</div>
    </div>
         <?php if($model->isNewRecord){?>
    <div class="col-md-6">
        <div class="col-md-4">
            User Level
        </div>
        <div class="col-md-8">
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
])->label(false);
         
            ?>


    <?php }else{?>
    <label>Use Level</label>
                <?php
echo $form->field($model, 'user_level_id')->widget(Select2::classname(), [
    'data' => common\models\UsersLevel::getlevel(),
    'theme' => Select2::THEME_BOOTSTRAP,
    'options' => ['placeholder' => 'Select a current user Level ...'],
    'pluginOptions' => [
      'allowClear' => true,
      //'autocomplete' => true,
  
  ],
  ])->label(false);

              ?>
          </div>
    </div>
    <?php  } ?>
    </div>
    <?php } ?>
    
</div>  
<div class="row no-margin">
    <div class="col-md-6">
    <div class="col-md-4">
            Stock In
        </div>
        <div class="col-md-8">
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
         <?php }?>
    </div>
    </div>
    <div class="col-md-6">
    <div class="col-md-4">
    <?php
        if ($model->isNewRecord) {
            $model->status = '1';
        }
        ?>
<?= $form->field($model, 'status')->checkbox() ?>
    </div>
</div>
    </div> 
<div class="outer-container">
 <div class="col-md-12 order-panel">
    <h3>Order Items</h3>
    <div class=" col-md-12 first-row">
    <div class="col-md-4"><?php echo $form->field($model, 'entity_type')->textInput(['maxlength' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'single_price')->textInput(['readonly' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'total_price')->textInput(['readonly' => true]); ?></div>
      <div class="noproduct"></div>



</div>

       
</div>

</div>

  
</div>  

<div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
    <div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success save-button']) ?>

    </div>
</div>
</div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
<script>
jQuery(document).ready(function() {
$('#user-entity_type').on('blur', function () {
    var product_id = '1';
        $.post("../user-product-level/getunitsprice?id=" + $('#user-entity_type').val()+"&user_level="+$('#user-user_level_id').val()+"&product_id="+product_id, function (data) {
         
        var json = $.parseJSON(data);
        if(json.price){
            $(".noproduct").hide();
                       $('#user-single_price').val(json.price);
                       $('#user-total_price').val(parseFloat($('#user-entity_type').val())  * parseFloat(json.price));
       
        }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You cannot purchse Minimun then this "+json.units+"</h5>");
        }
        });
    });
});

    $('#user-parent_user').on('change', function () {
     
        var product_id = '1';
        $.post("../stock-in/getunits?id="+product_id+"&user_id="+$(this).val(), function (data) {
    $('#order-orde').val(data);
        });
    });
  
</script>