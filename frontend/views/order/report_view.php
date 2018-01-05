<?php

?>
<div class="row main-container report_div">    
       <div class="row report-view">
       <h2>Inventry Report</h2>
       <p><button id="back" class="btn btn-success">Back</button>
       <table class="table table-bordered">
         <thead>
           <tr>
             <th>Name</th>
             <th>Date</th>
             <th>In hand</th>
             <th>Quantity</th>
             <th>Type</th>
             <th>Product</th>
           </tr>
         </thead>
         <tbody>
         <?php
         $stock_total = 0;
         if(isset($stock_in_hand))
         $stock_total = $stock_in_hand ;
         { ?>
         <tr>
             <td></td>
             <td></td>
             <td><?php echo $stock_in_hand; ?></td>
             <td></td>
             <td></td>             
           </tr>
         <?php }?>
         <?php 
    foreach ($inventoryArr as $value) {
      if($value->type == 'Stock In'){
        $stock_total =   $stock_total + $value->quantity;
      }else{
        $stock_total =    $stock_total - $value->quantity;  
      }
        ?>
    
           <tr>
             <td><?php echo $value->user ?></td>
             <td><?php echo $value->date ?></td>
             <td><?php echo $stock_total  ?></td>
             <td><?php echo $value->quantity  ?></td>
             <td><?php echo $value->type ?></td>
             <td><?php echo $value->product ?></td>             
           </tr>
           <?php }?>
         </tbody>

       </table>
     </div>
    
    <script>
    $( "#back" ).click(function() {
  
    $('.filter').show(1000);
 
    $('.view-report').hide(1000);
});
    </script>