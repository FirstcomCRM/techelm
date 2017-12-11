<?php
use common\components\Helper;
use common\models\ServiceJob;
use common\models\ServicejobCategories;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobComplaintMobile;
use common\models\ServicejobCmAsr;
$main_ids = [];
$i = 1;

if (!empty($dataProvider)) {
  foreach ($dataProvider as $key => $value) {
    $main_ids[] = $value['ids'];
  }
}

$main_ids = array_unique($main_ids);
asort($main_ids);
//echo '<pre>';
//print_r($main_ids);
//echo '</pre>';
$dataProvider = null;
?>


<style>
  table{
    width:100%;
    border-collapse: collapse;
    font-size: 16px;
  }
  th,
  td{
    padding: 8px;
  }
  .breaker{
    page-break-inside: avoid;
  }

</style>
<?php foreach ($main_ids as $key => $value): ?>
  <div class="breaker">
      <div class="title">
        <h3 style="text-align:center">Service Report Complain Summary</h3>
      </div>
      <?php $servicejob = Servicejob::find()->where(['id'=>$value])->one(); ?>
      <table class="header" border=0>
        <thead>
          <tr>
            <th>Service No</th>
            <td> <?php echo $servicejob->service_no; ?></td>
            <th>Service Customer</th>
            <td> <?php echo Helper::retrieveCustomer($servicejob->customer_id); ?></td>
            <th>Service Date</th>
            <td><?php echo $servicejob->service_date; ?></td>
          </tr>
          <tr>
            <th>Site Address</th>
            <td><?php echo nl2br($servicejob->remarks)  ?></td>
          </tr>
        </thead>
      </table>
    <br>
      <table class="complaints" border=1>
      <thead>
        <tr>
          <th style="text-align:center">No</th>
          <th style="text-align:center">Complaint</th>
          <th style="text-align:center">Action</th>
        </tr>
        <tbody>
            <?php $complaints = ServicejobComplaintMobile::find()->where(['servicejob_id'=>$value])->all(); ?>
            <?php foreach ($complaints as $key => $value): ?>
              <tr>
                <td style="width:10%; text-align:center"><?php echo $i ?></td>
                <td style="width:45%"><?php echo $value->complaint_name ?></td>
                <td style="width:45%">
                  <?php $actions =  ServicejobCmAsr::find()->where(['servicejob_cm_cf_id'=>$value->id])->all()?>
                  <ul>
                      <?php foreach ($actions as $key => $value): ?>
                        <li>
                          <?php $repair_id = $value->servicejob_action_service_repair_id;
                            $repair_name = ServicejobActionServiceRepair::find()->where(['id'=>$repair_id])->one();
                            if (!empty($repair_name)) {
                              echo $repair_name->action;

                            }else{
                              echo $repair_name = null;  echo $repair_id;
                            }
                          ?>
                        </li>
                      <?php endforeach; ?>
                  </ul>
                </td>
                <?php $i+=1; ?>
              </tr>

            <?php endforeach; ?>
        </tbody>
      </thead>
      </table>
      <hr>
      <?php $i = 1 ?>

  </div>
  <?php endforeach; ?>
