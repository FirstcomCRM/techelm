<?php

use common\components\Helper;
use common\models\Equipments;


 ?>
 <style>
 
 /*.row {
margin: 10px 0px 0px 0px !important;
padding: 0px !important;
}*/
 </style>

<div class="wrapper">
  <div class="pdf-wrapper">

    <div class="title">
      <h2 style="text-align:center">Service Report Summary</h2>
    </div>

    <div class="Filter-area">
      <?php if (!empty($searchModel->service_no)): ?>
        <p>Service No: <?php echo $searchModel->service_no ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->status)): ?>
        <p>Staus: <?php echo Helper::retriveStatusFlag($searchModel->status) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->year)): ?>
        <p>Year: <?php echo $searchModel->year ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->customer_id)): ?>
        <p>Customer: <?php echo Helper::retrieveCustomer($searchModel->customer_id) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->active)): ?>
        <p>State: <?php echo Helper::retriveActiveLabel($searchModel->active) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->service_id)): ?>
        <p>Service: <?php echo Helper::retriveService($searchModel->service_id) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->service_date)): ?>
        <p>Service Date: <?php echo $searchModel->service_date ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->engineer_id)): ?>
        <p>Engineer: <?php echo Helper::retriveUserFull($searchModel->engineer_id) ?></p>
      <?php endif; ?>
      <?php if (!empty($searchModel->remarks)): ?>
        <p>Site Address: <?php echo nl2br($searchModel->remarks) ?></p>
      <?php endif; ?>
    </div>

    <div class="filter-table">
      <table class="dataprovider-table">
        <thead>
          <tr>
            <th>Service No</th>
            <th>Customer</th>
            <th>Service</th>
            <th>Engineer</th>
            <th>Service Date</th>
            <th>Site Address</th>
            <th>Equipment Type</th>
            <th>Serial No</th>
            <th>Status</th>
            <th>Site Address</th>
          </tr>
        </thead>
        <?php foreach ($dataProvider->getModels() as $key => $value): ?>
        <tr>
          <td class="dataprovider-row"><?php echo $value->service_no ?></td>
          <td class="dataprovider-row"><?php echo Helper::retrieveCustomer($value->customer_id) ?></td>
          <td class="dataprovider-row"><?php echo Helper::retriveService($value->service_id) ?></td>
          <td class="dataprovider-row"><?php echo Helper::retriveUserFull($value->engineer_id) ?></td>
          <td class="dataprovider-row"><?php echo $value->service_date ?></td>
          <td class="dataprovider-row"><?php echo nl2br($value->remarks) ?></td>
          <td class="dataprovider-row">
            <?php $eq = Equipments::find()->where(['equipment_code'=> $value->equipment_type])->one();
              echo $eq->description;
            ?>
          </td>
          <td class="dataprovider-row"><?php echo $value->serial_no ?></td>
          <td class="dataprovider-row"><?php echo Helper::retriveStatusFlag($value->status) ?></td>
            <td class="dataprovider-row"><?php echo $value->remarks ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>

  </div>
</div>
