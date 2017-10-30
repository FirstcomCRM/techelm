<?php

use common\components\Helper;

$engineers = null;
$s = 1;
 ?>

 <style>
   body{
     font-size: 14px;
     font-family: "Tahoma", sans-serif;
   }
   table{
     width:100%;
     border-collapse: collapse;
   }

  .logo{float:left;width:30%}
  .company{float:right;width:40%;font-size: 12px;text-align: right}
  .title{text-align: center}

 </style>

 <div class="logo" >
   <img src="../web/logo/techelm_logo.png" alt="">
 </div>
 <div class="company">
   <?php echo $company->company_name ?><br>
   <?php echo $company->address.' '.$company->postal_code?><br>
   Tel: <?php echo $company->telephone ?><br>
   Fax: <?php echo $company->fax ?><br>
   Website: <?php echo $company->website ?><br>
 </div>

 <div class="" style="clear: both; margin: 0pt; padding: 0pt; ">

 </div>

 <div class="table-main">
   <h3>PROJECT JOB DETAILS <?php echo $model->project_ref ?></h3>
   <table class="project-main" border=1>
     <tr>
       <td>Customer</td>
       <td><?php echo Helper::retrieveCustomer($model->customer_id)?></td>
     </tr>
     <tr>
       <td>Start Date</td>
       <td><?php echo $model->start_date ?></td>
     </tr>
     <tr>
       <td>End Date</td>
       <td><?php echo $model->end_date ?></td>
     </tr>
     <tr>
       <td>Target Completion Date</td>
       <td><?php echo $model->target_completion_date ?></td>
     </tr>
     <tr>
       <td>Status</td>
       <td><?php echo Helper::retriveStatusFlag($model->status_flag) ?></td>
     </tr>
   </table>
 </div>

 <br>
 <div class="table-piss">
   <table class="table table-bordered" border=1>
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
   <table class="table table-bordered" border=1>
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
   <table class="table table-bordered" border=1>
     <thead>
       <tr>
         <th>Serial No</th>
         <th>Description</th>
         <th>Corrective Action</th>
         <th>Target Completion Date</th>
         <th>Form Type</th>
         <th>CAR NO</th>
       </tr>
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
     <table class="table table-bordered" border=1>
       <thead>
         <tr>
           <th>Serial No</th>
           <th>Description</th>
           <th>Conformance</th>
           <th>Comments</th>
           <th>Drawing Before</th>
           <th>Drawing After</th>
         </tr>

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
