<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\db\Query;
use kartik\file\FileInput;

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

<section class="box">
<header class="panel_header">
    <h1 class="title pull-left"><?= Html::encode($this->title) ?></h1>
    <div class="actions panel_actions pull-right">
        <i class="box_toggle fa fa-chevron-down"></i>
    </div>
</header>
<div class="content-body">
    <?php 
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
        $user_id = Yii::$app->user->getId();
        $Role =   Yii::$app->authManager->getRolesByUser($user_id);
    ?>
    
    <div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            First Name
        </div>
        <div class="col-md-8">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false)  ?>
  <?php  echo $form->field($model, 'product_id')->hiddenInput(['value'=> '1'])->label(false); ?>
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
<div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            Upload Profile 
        </div>
        <div class="col-md-8">
        <?=
                $form->field($model, 'profile')->widget(FileInput::classname(), [
                    
                    'pluginOptions' => [
                        'showUpload' => true,
                        'initialPreview' => [
                            $model->profile ? Html::img(Yii::$app->request->baseUrl . '../../uploads/' . $model->profile) : null, // checks the models to display the preview
                        ],
                        'overwriteInitial' => false,
                    ],
                ])->label(false);
                ?>
    </div>
    </div>
    <div class="col-md-6">
    
    </div>
</div>
<?php if(!$model->isNewRecord  && $Role['super_admin'] && $user_id != $model->id){
$user_level_name =(new Query())
->select('users_level.name,users_level.id')
->from('user')
->innerJoin('users_level', 'user.user_level_id = users_level.id')
->where(['=', 'user.id', $model->id])
->one();
$parent_user = \common\models\User::findOne(['id'=>$model->parent_id]);

    ?>
       <div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
        User Level
        </div>
        <div class="col-md-8">
<?php
echo $form->field($model, 'user_level_id')->widget(Select2::classname(), [
    'data' => common\models\UsersLevel::getalllevel(),
     'value' =>$user_level_name['id'],
    'initValueText' => $user_level_name['name'],
  
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
    <div class="col-md-6">
        <div class="col-md-4">
            Parent User
        </div>
        <div class="col-md-8">
        <?php

  echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
    'value' =>$model->parent_id,
    'initValueText' =>$parent_user->username,
    'theme' => Select2::THEME_BOOTSTRAP,
    'options' => ['placeholder' => 'Select a Parent User ...'],
    'pluginOptions' => [
      'allowClear' => true,
      //'autocomplete' => true,
      'ajax' => [
          'url' => '../parentuserupdate',
          'dataType' => 'json',
          'data' => new \yii\web\JsExpression('function(params) {
            //   if($("#user-company_user").is(":checked")){
            //       var company_user = 1;
            //   }else{
            //       var company_user = 0;
                  
            //   }
               var type = $("#user-user_level_id").val();
              return {
                  q:params.term,type:type}; 
              }')
      ],
  ],
  ])->label(false);
?>
    </div>
    </div>
</div> 
       
          </div>
    </div>
    <?php }?>
<?php if ($model->isNewRecord) {?>
<div class="row no-margin">
    <div class="col-md-6">
        <div class="col-md-4">
            Company User
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'company_user')->checkbox(['label' => null]) ?>
        </div>
    </div>
    <div class="col-md-6">
   
    </div>
</div> 
<?php

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
        'data' => new \yii\web\JsExpression('function(params) {
            if($("#user-company_user").is(":checked")){
                var company_user = 1;
            }else{
                var company_user = 0;
                
            }
             var type = $("#user-all_level").val();
            return {
                q:params.term,type:type,company_user: company_user}; 
            }')
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
        'data' => new \yii\web\JsExpression('function(params) { 
            if($("#user-company_user").is(":checked")){
                var company_user = 1;
            }else{
                var company_user = 0;
                
            }
            var type = $("#user-all_level").val();return {q:params.term,type:type,company_user: company_user}; }')
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
            Current Stock
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
    <?php
        if ($model->isNewRecord) {
            $model->status = '1';
        }
    ?>
        <div class="col-md-4">
            Status
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'status')->checkbox(['label' => null]) ?>
        </div>
    </div>

    </div> 
<div class="outer-container">
 <div class="col-md-12 order-panel">
    <h3>Order Items</h3>
    <div class=" col-md-12 first-row">
    <div class="col-md-4"><?php echo $form->field($model, 'quantity')->label('Quantity')->textInput(['maxlength' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'unit_price')->label('Unit Price')->textInput(['readonly' => true]); ?></div>
      <div class="col-md-4"><?php echo $form->field($model, 'total_price')->label('Total')->textInput(['readonly' => true]); ?></div>
      <div class="noproduct"></div>



</div>

       
</div>

</div>
    <?php  }?>
  
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
</section>
<script>
jQuery(document).ready(function() {
    $('#user-company_user').change(function(){ 
    if($('#user-company_user').is(':checked')){
        $("#user-all_level").select2('val', 'All');
        $("#user-parent_user").select2('val', 'All');
        $("#user-user_level_id").select2('val', 'All');
    }else{
        $("#user-all_level").select2('val', 'All');
        $("#user-parent_user").select2('val', 'All');
        $("#user-user_level_id").select2('val', 'All');
    }
   
});
$('#user-quantity').on('blur', function () {
    var product_id = '1';
        $.post("../user-product-level/getunitsprice?id=" + $('#user-quantity').val()+"&user_level="+$('#user-user_level_id').val()+"&product_id="+product_id, function (data) {
         
        var json = $.parseJSON(data);
        if(json.price){
            $(".noproduct").hide();
                       $('#user-unit_price').val(json.price);
                       $('#user-total_price').val(parseFloat($('#user-quantity').val())  * parseFloat(json.price));
       
        }else{
            $(".noproduct").show();
            $(".noproduct").html("<h5 style='text-align:center;color:red;'>You cannot purchase less than "+json.units+"</h5>");
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