<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\Company;

$engineers = null;
 ?>

 <style>
 h3{color:black}

 .logo{float:left;width:30%}
 .company{float:right;width:40%}
 </style>

<div class="container"><!--Start of container--->
  <br>
  <div class="row">
    <div class="col-md-6">
      <img src="../web/logo/techelm_logo.png" alt="">
    </div>
    <div class="col-md-6">
      <br>
      <?php echo $company->address.' '.$company->postal_code?><br>
      Tel: <?php echo $company->telephone ?><br>
      Fax: <?php echo $company->fax ?><br>
      Website: <?php echo $company->website ?><br>
    </div>
</div>
<br>


<div class="table-main">
  <h3>PROJECT JOB DETAILS <?php echo $model->project_ref ?></h3>
  <table class="table table-bordered">
    <tr>
      <th>Customer</th>
      <td>
        <?php echo Helper::retrieveCustomer($model->customer_id) ?>
      </td>
    </tr>
    <tr>
      <th>Start Date</th>
      <td><?php echo $model->start_date ?></td>
    </tr>
    <tr>
      <th>End Date</th>
      <td><?php echo $model->end_date ?></td>
    </tr>
    <tr>
      <th>Target Completion Date</th>
      <td><?php echo $model->target_completion_date ?></td>
    </tr>
    <tr>
      <th>Status</th>
      <td><?php echo Helper::projectStatusFlag($model->status_flag) ?></td>
    </tr>
  </table>
</div>

<br>
<div class="table-piss">
  <table class="table table-bordered">
    <tr>
      <th>Car Park Code</th>
      <td><?php echo $piss->car_park_code ?></td>
    </tr>
    <tr>
      <th>Property Officer</th>
      <td><?php  echo $piss->property_officer ?></td>
    </tr>
    <tr>
      <th>Tc Lew</th>
      <td><?php echo $piss->tc_lew ?></td>
    </tr>
    <tr>
      <th>Property Officer Tel No</th>
      <td><?php echo $piss->property_officer_telNo ?></td>
    </tr>
    <tr>
      <th>Property Officer Mobile No</th>
      <td><?php echo $piss->property_officer_mobileNo ?></td>
    </tr>
    <tr>
      <th>Property Officer Branch</th>
      <td><?php echo $piss->property_officer_branch ?></td>
    </tr>
    <tr>
      <th>Tc Lew Tel No</th>
      <td><?php echo $piss->tc_lew_telNo ?></td>
    </tr>
    <tr>
      <th>Tc Lew Mobile No</th>
      <td><?php echo $piss->tc_lew_mobileNo ?></td>
    </tr>
    <tr>
      <th>Tc Lew Email No</th>
      <td><?php echo $piss->tc_lew_email ?></td>
    </tr>
    <tr>
      <th>Remarks</th>
      <td><?php echo nl2br($piss->remarks); ?></td>
    </tr>
    <tr>
      <th>Date Site Walk</th>
      <td><?php echo $piss->date_site_walk ?></td>
    </tr>
  </table>
</div>

<br>
<div class="table-engineer">
  <table class="table table-bordered">
    <tr>
      <th>Engineers</th>
      <td>
        <?php foreach ($assign as $key => $value): ?>
        <?php
          $engineers .=  Helper::retriveUserFull($value->engineer_id).', ';

        ?>
        <?php endforeach; ?>
        <?php
        $engineers = rtrim($engineers,', ');
        echo $engineers;
         ?>
      </td>
    </tr>
    <tr>
      <th>SubContractor</th>
      <td><?php echo Helper::retrieveSubCon($ipi->sub_contractor) ?></td>
    </tr>
  </table>
</div>

<br>
<div class="table-ipi-tasks">
  <table class="table table-bordered">
    <thead>
      <th>Serial No</th>
      <th>Description</th>
      <th>Corrective Action</th>
      <th>Target Completion Date</th>
      <th>Form Type</th>
      <th>CAR NO</th>
    </thead>
    <tbody>
      <?php foreach ($ipiTask as $key => $value): ?>
        <tr>
          <td><?php echo $value->serial_no ?></td>
          <td><?php echo $value->description ?></td>
          <td><?php echo $value->corrective_actions ?></td>
          <td><?php echo $value->target_completion_date ?></td>
          <td><?php echo $value->form_type ?></td>
          <td><?php echo $value->car_no ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<br>
<div class="table-piss-tasks">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <th>Serial No</th>
        <th>Description</th>
        <th>Conformance</th>
        <th>Comments</th>
        <th>Drawing Before</th>
        <th>Drawing After</th>
      </thead>
      <tbody>
        <?php foreach ($pissTask as $key => $value): ?>
          <tr>
            <td><?php echo $value->serial_no ?></td>
            <td><?php echo $value->description ?></td>
            <td><?php echo $value->conformance ?></td>
            <td><?php echo $value->comments ?></td>
            <td><?php echo $value->drawing_before ?></td>
            <td><?php echo $value->drawing_after ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>


</div>

</div><!--End of container--->
<br><br><br><br>
