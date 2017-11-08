<?php
use common\components\Helper;
use common\models\ServiceJob;
use common\models\ServicejobCategories;
use common\models\ServicejobActionServiceRepair;

//echo '<pre>';
//print_r($dataProvider->getModels());
//echo '</pre>';

?>
<style>

/*execute override based from reports.css*/
.dataprovider-row{
   width:11%;
}
</style>

<?php if (!is_null($searchModel->status)): ?>

<?php endif; ?>

<div class="wrapper">
  <div class="pdf-wrapper">
    <div class="Filter-area">
      <?php if (!empty($searchModel->service_no)): ?>
        <p>Service No: <?php echo $searchModel->service_no ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->customer_id)): ?>
        <p>Customer Name: <?php echo Helper::retrieveCustomer($searchModel->customer_id)  ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->engineer_id)): ?>
        <p>Engineer: <?php echo Helper::retriveUserFull($searchModel->engineer_id) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->status)): ?>
        <p>Status: <?php echo Helper::retriveStatusFlag($searchModel->status) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->active)): ?>
        <p>State: <?php echo Helper::retriveActiveLabel($searchModel->active) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->service_date)): ?>
        <p>Service Date: <?php echo $searchModel->service_date ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->year)): ?>
        <p>Year: <?php echo $searchModel->year ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->complaint_cat)): ?>
        <p>Service Complaint:
          <?php
          $data = ServicejobCategories::find()->where(['id'=>$searchModel->complaint_cat])->one();
          if (!empty($data)) {
              echo $data->category;
          }else {
            echo $data = null;
          }

          ?>
        </p>
      <?php endif; ?>
      <?php if (!empty($searchModel->complaint)): ?>
        <p>Complaint: <?php echo $searchModel->complaint ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->action)): ?>
        <p>Repair Action:
          <?php
          $data = ServicejobActionServiceRepair::find()->where(['id'=>$searchModel->action])->one();
          if (!empty($data)) {
              echo $data->action;
          }else {
            echo $data = null;
          }

          ?>
        </p>
      <?php endif; ?>
    </div>

    <div class="filter-table">
      <table class="dataprovider-table">
        <thead>
          <tr>
            <th>Service No</th>
            <th>Customer</th>
            <th>Engineer</th>
            <th>Service Date</th>
            <th>Status</th>
            <th>Site Address</th>
            <th>Service Complaint</th>
            <th>Complaint</th>
            <th>Service Action</th>

          </tr>
        </thead>
      <tbody>
        <?php foreach ($dataProvider as $key => $value): ?>
          <tr>
            <td class="dataprovider-row"><?php echo $value['service_no'] ?></td>
            <td class="dataprovider-row">
              <?php echo Helper::retrieveCustomer($value['customer_id']) ?>
            </td>
            <td class="dataprovider-row">
              <?php echo Helper::retriveUserFull($value['engineer_id']) ?>
            </td>
            <td class="dataprovider-row"><?php echo $value['service_date'] ?></td>
            <td class="dataprovider-row">
              <?php echo Helper::retriveStatusFlag($value['status']) ?>
            </td>
            <td class="dataprovider-row">
              <?php echo $value['remarks'] ?>
            </td>
            <td class="dataprovider-row">
              <?php
                $data = ServicejobCategories::find()->where(['id'=>$value['servicejob_category_id']])->one();
                if (!empty($data)) {
                    echo $data->category;
                }else {
                  echo $data = null;
                }
            ?>
            </td>
            <td class="dataprovider-row"><?php echo $value['complaint_name'] ?></td>
          <!---  <td><?php //echo nl2br($value['complaint_remark']) ?></td>--->
            <td class="dataprovider-row">
              <?php
                $data = ServicejobActionServiceRepair::find()->where(['id'=>$value['servicejob_action_service_repair_id']])->one();
                if (!empty($data)) {
                    echo $data->action;
                }else {
                  echo $data = null;
                }
              // echo $value['servicejob_action_service_repair_id']
              ?>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>

      </table>
    </div>

  </div>
</div>
