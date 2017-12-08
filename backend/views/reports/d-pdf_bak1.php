 <?php
use common\components\Helper;
use common\models\ServiceJob;
use common\models\ServicejobPartReplacementRates;
$quantity = 0;
$total = 0;
foreach ($dataProvider->getModels() as $key => $value) {
    $quantity += $value->quantity;
   $total += $value->total_price;
}

$total = number_format($total,2);
$quantity = number_format($quantity);

//echo '<pre>';
//print_r($dataProvider->getModels() );
//print_r($dataProvider->query->asArray()->all() );
//echo '</pre>';

//$dataProvider->query->asArray()->all();
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
         <?php foreach ($dataProvider->getModels() as $key => $value): ?>
         <tr>
           <td class="dataprovider-row">
             <?php

              $data = Servicejob::find()->where(['id'=>$value->servicejob_id])->one();
              if (!empty($data)) {
                echo $data->service_no;

              }
              else{
                echo $data = null;
              }
            ?>
           </td>
           <td class="dataprovider-row"><?php echo $value->parts_name ?></td>
           <td class="dataprovider-row"><?php echo number_format($value->quantity) ?></td>

           <td class="dataprovider-row"><?php echo number_format($value->unit_price,2) ?></td>
           <td class="dataprovider-row"><?php echo number_format($value->total_price,2); ?></td>
         </tr>
         <?php endforeach; ?>
         <tfoot>
           <tr>
             <td class="dataprovider-row"><strong>Total</strong></td>
             <td class="dataprovider-row"></td>
             <td class="dataprovider-row"><strong><?php echo $quantity ?></strong> </td>
             <td class="dataprovider-row"></td>
             <td class="dataprovider-row"><strong><?php echo $total ?></strong> </td>
           </tr>
         </tfoot>
       </table>
     </div>

   </div>
 </div>
