<?php
use common\components\Helper;
use common\models\ProjectjobIpiTasksAction;

if ($model->field_type == 'PW') {
  $subs = '(Permanent Works)';
}else{
  $subs = '(EPS Works)';
}

$i = 1;

$tasks = ProjectjobIpiTasksAction::find()->all();

?>


<style>
  body{
    color:black;
    font-family: "Tahoma", sans-serif;
  }
  table{
    width:100%;
    border-collapse: collapse;
  }

  .logo{float:left;width:30%}
  .company{float:right;width:40%;font-size: 12px;text-align: right}
  .title{text-align: center}

  .header-left,
  .header-right,
  .ipi-task-data,
  .correct-data,{
    padding: 5px;
  }

  .header-left{
    width:40%;
  }
  .header-right{
    width: 60%;
  }

  .breaker{
    page-break-inside: avoid;
  }

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

 <h3 class="title">Site In-process Inspection <br><?php echo $subs ?></h3>

<br>

<table class="header" border=1>
  <tr>
    <td class="header-left">Project Ref</td>
    <td class="header-right">
      <?php echo Helper::retrieveCustomer($model->project_ref);  ?>
    </td>
  </tr>
  <tr>
    <td class="header-left">Project Site</td>
    <td class="header-right"><?php echo nl2br($model->project_site) ?></td>
  </tr>
  <tr>
    <td class="header-left">Sub-Contractor</td>
    <td class="header-right">
      <?php echo Helper::retrieveSubCon($model->subcontractor); ?>
    </td>
  </tr>
  <tr>
    <td class="header-left">Date of Inspection</td>
    <td class="header-right"><?php echo $model->date_inspection ?></td>
  </tr>
  <tr>
    <td class="header-left">Work completion date as per Wi</td>
    <td class="header-right"><?php echo $model->work_completion_start_date ?></td>
  </tr>
  <tr>
    <td class="header-left">Inspection Conducted by</td>
    <td class="header-right">
      <?php echo Helper::retriveUserFull($model->inspected_by); ?>
    </td>
  </tr>
  <tr>
    <td class="header-left">Signature</td>
    <td class="header-right">This is signature???? ss<br></td>
  </tr>
</table>

<br>

<table class="ipi-tasks" border=1>
<thead>
  <tr>
    <th style="width:5%">S/N</th>
    <th style="width:20%">Description</th>
    <th style="width:5%">Yes</th>
    <th style="width:5%">No</th>
    <th style="width:5%">NA</th>
    <th style="width:20%">Nonconformance</th>
    <th style="width:20%">To Issue CAR? <br>State required Corrective Action</th>
    <th style="width:20%">Target completion date</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($tasks as $key => $value): ?>
    <tr>
      <td style="width:5%;text-align:center;" class="ipi-task-data"><?php echo $i ?></td>
      <td style="width:20%" class="ipi-task-data"><?php echo $value->task_action ?></td>
      <td style="width:5%;text-align:center;" class="ipi-task-data"></td>

      <td style="width:5%;text-align:center;"></td>
      <td style="width:5%;text-align:center;" class="ipi-task-data"></td>
      <td style="width:20%" class="ipi-task-data"></td>
      <td style="width:20%" class="ipi-task-data"></td>
      <td style="width:20% text-align:center;" class="ipi-task-data"></td>
    </tr>
    <?php $i+=1; ?>
  <?php endforeach; ?>

</tbody>
</table>

<br>
<?php $i = 1; ?>

<div class="ipi-corrective-container breaker">
  <h3 style="text-decoration:underline">Verification and Disposition of Corrective actions/Rework by sub-contractor</h3>
  <table class="ipi-corrective" border=1>
    <thead>
      <tr>
        <th style="width:5%">S/N</th>
        <th style="width:10%">CAR No.</th>
        <th style="width:20%">Description of Corrective actions/rework</th>
        <th style="width:15%">Target completion date</th>
        <th style="width:15%">Completion date</th>
        <th style="width:20%">Remark</th>
        <th style="width:15%">Disposition</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

    </tbody>

  </table>
</div>

<br>
<div class="subcon">
  <table class="subcon-table" border=1>

  <tr>
    <td class="correct-data" style="width:75%">
    SubContractor:

    </td>
    <td class="correct-data">Date:</td>
  </tr>
  <tr>
    <td class="correct-data" style="width:75%">
    Verification and Disposition by:<br>
    </td>
    <td class="correct-data">Date:<br><br></td>
    <br>
  </tr>
      </table>
</div>
