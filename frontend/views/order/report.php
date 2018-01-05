<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\models\order;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
?>
<div class="row site-index main-container">
<style>
.show
{
    display:none;
}
</style>
    <?php
    $form = ActiveForm::begin(['id' => 'form-order-report','enableClientValidation' => true, 'enableAjaxValidation' => false,'options' => ['enctype' => 'multipart/form-data'],
                'action' => ['order/ajaxreport'],
                    ]
    );
     ?>
   		
   		<div class="filter">
           <h1>Order Report</h1>
		<div class="row">
			<div class="col-md-6">
				<div class="col-md-4">
					From Date
				</div>
				<div class="col-md-8">
					<?php
					echo DatePicker::widget([
                    'name' => 'from_date',
                    'id' => 'form-date',
				    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'value' => date('Y-m-d'),
				    'pluginOptions' => [
				        'autoclose'=>true,
				        'format' => 'yyyy-M-dd'
				    ]
			          ]);
					?>
				</div>
			</div>

			  <div class="col-md-6">
				<div class="col-md-4">
					To Date
				</div>
				<div class="col-md-8">
					<?php
					echo DatePicker::widget([
                    'name' => 'to_date',
                    'id' => 'to_date',
				    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'value' => date('Y-m-d', strtotime('-7 days')),
				    'pluginOptions' => [
				        'autoclose'=>true,
				        'format' => 'dd-M-yyyy'
				    ]
			          ]);
					?>
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 20px;">
			<div class="col-md-6">
        <div class="col-md-4">
        Order Type
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'order_type')->dropdownList([
        	'' => 'select ...',
             'Order' => 'Order',
             'Request' => 'Request',
             'transfer' => 'Transfer',
             'transfer_back' => 'Transfer Back'
           ]

          
     )->label(false)
     ?>
        </div>
        </div>

        <div class="col-md-6">
        	<div class="col-md-3">
             <button type="submit" class="btn btn-success submit_button">Get Report</button>
           </div>
        </div>
     </div>
 </div>
</div>
     <?php ActiveForm::end(); ?>

     <div class="row view-report">
     	
     </div>
     <script>

$("body").delegate("#form-order-report .submit_button", "click", function (e) {
    e.preventDefault();
var from_date =    $('#form-date').val();
var to_date =   $('#form-date').val();
// var type =    $('#').val();

    $.ajax({
        type: "POST",
    
        data:  {'from_date':from_date, 'to_date':to_date },
       // data: "id="+id+"status+"+status,
        url: "<?php echo Yii::$app->getUrlManager()->createUrl('order/ajaxreport'); ?>",
        success: function (test) {
            $('.filter').hide(1000);
            $('.view-report').html(test);
            $('.view-report').show(1000);
        },
        error: function (exception) {
            alert(exception);
        }
    });

});

</script> 
    
  <!-- <script>
  $('#form-order-report .submit_button').on('click', function(e) {
 

  
    var form = $(this);
    var formData = form.serialize();
    dataType:"json",
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            alert(data);
        	// $('.filter').hide();
        	$('.view-report').html(data);
            
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});
</script> -->