 <?php
use common\components\Helper;
use common\models\ServiceJob;
use common\models\ServicejobPartReplacementRates;
$quantity = 0;
$total = 0;

?>

<style>

 /*execute override based from reports.css*/
 .dataprovider-row{
    width:20%;
 }
</style>



 <div class="wrapper">
   <div class="pdf-wrapper">
     <div class="title">
       <h3 style="text-align:center">Service Report Parts Summary</h3>
     </div>
     <div class="Filter-area">
       <?php if (!empty($searchModel->service_no)): ?>
         <p>Service No: <?php echo $searchModel->service_no ?></p>
       <?php endif; ?>
       <?php if (!empty($searchModel->parts)): ?>
         <p>Parts Name: <?php echo $searchModel->parts ?></p>
       <?php endif; ?>
       <?php if (!empty($searchModel->customer_id)): ?>
         <p>Customer: <?php echo Helper::retrieveCustomer($searchModel->customer_id) ?></p>
       <?php endif; ?>
       <?php if (!empty($searchModel->engineer_id)): ?>
         <p>Engineer: <?php echo Helper::retriveUserFull($searchModel->engineer_id) ?></p>
       <?php endif; ?>
     </div>

     <div class="filter-table">
       <table class="dataprovider-table">
         <thead>
           <tr>
             <th>Service No</th>
             <th>Parts Name</th>
             <th>Quantity</th>
             <th>Unit Price</th>
             <th>Total Price</th>
           </tr>
         </thead>

         <?php foreach ($dataProvider as $key => $value): ?>
         <tr>
           <td class="dataprovider-row"><?php echo $value['service_no']?></td>
           <td class="dataprovider-row"><?php echo $value['parts_name'] ?></td>
           <td class="dataprovider-row"><?php echo number_format($value['quantity']) ?></td>
           <td class="dataprovider-row"><?php echo number_format($value['unit_price'],2) ?></td>
           <td class="dataprovider-row"><?php echo number_format($value['total_price'],2); ?></td>
         </tr>

         <?php
          $quantity += $value['quantity'];
          $total += $value['total_price'];
          ?>
         <?php endforeach; ?>

         <tfoot>
           <tr>
             <td class="dataprovider-row"><strong>Total</strong></td>
             <td class="dataprovider-row"></td>
             <td class="dataprovider-row"><strong><?php echo $quantity ?></strong> </td>
             <td class="dataprovider-row"></td>
             <td class="dataprovider-row"><strong><?php echo number_format($total,2); ?></strong> </td>
           </tr>
         </tfoot>
       </table>
     </div>

   </div>
 </div>
