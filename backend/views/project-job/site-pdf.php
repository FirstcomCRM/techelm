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

  .header-label{
    font-weight: bold;
    width:25%;
  }
  .header-data{
    width: 20%;
  }
  .header-data,
  .header-label{
    padding:8px;
  }

  .header-details,
  .data-details{
    padding: 5px;
  }

  .remarks{
    border: 1px solid black;
  }
  .remark-title{
    padding: 10px;
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
<h3 class="title">Site Walk Check List</h3>

<table class="header" border=1>
<tr>
  <td class="header-label">Project Ref./Site</td>
  <td class="header-data"><?php echo $model->project_ref ?></td>
  <td class="header-label">Date of Site Walk</td>
  <td class="header-data"><?php echo $model->start_date ?></td>
</tr>
<tr>
  <td class="header-label">CP Code</td>
  <td colspan="3" class="header-data"><?php echo $piss->car_park_code ?></td>
</tr>
<tr>
  <td class="header-label">Attended By</td>
  <td colspan="3" class="header-data">
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
</table>

<br>

<table class="details" border=1>
  <thead>
    <tr>
      <th class="header-details">S/No</th>
      <th class="header-details">Description</th>
      <th class="header-details">Yes</th>
      <th class="header-details">No</th>
      <th class="header-details">NA</th>
      <th class="header-details">Comments</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pissTask as $key => $value): ?>

      <tr>
        <td style="width:10%;text-align:center" class="data-details"><?php echo $s ?></td>
        <td style="width:40%" class="data-details"><?php echo $value->description; ?></td>
        <td style="width:10%" class="data-details">
          <?php if ($value->conformance == 'YES'): ?>
            <?php //echo 'Y'; ?>
            &#10004;
          <?php endif; ?>
        </td>
        <td style="width:10%" class="data-details">
          <?php if ($value->conformance == 'NO'): ?>
            <?php //echo 'N'; ?>
            &#10004;
          <?php endif; ?>
        </td>
        <td style="width:10%" class="data-details">
          <?php if ($value->conformance == 'N/A'): ?>
            <?php //echo 'NA'; ?>
            &#10004;
          <?php endif; ?>
        </td style="width:20%" class="data-details">
        <td><?php echo nl2br($value->comments); ?></td>
      </tr>
      <?php $s += 1 ?>
    <?php endforeach; ?>
  </tbody>
</table>

<br>

<div class="div-property breaker">
  <table class="property" border=1>
    <tr>
      <td style="width:20%" class="data-details">Property Officer</td>
      <td style="width:30%" class="data-details"><?php echo $piss->property_officer ?></td>
      <td style="width:20%" class="data-details">Tel</td>
      <td style="width:30%" class="data-details"><?php echo $piss->property_officer_telNo ?></td>
    </tr>
    <tr>
      <td style="width:20%" class="data-details">Branch</td>
      <td style="width:30%" class="data-details"><?php echo $piss->property_officer_branch ?></td>
      <td style="width:20%" class="data-details">Mobile</td>
      <td style="width:30%" class="data-details"><?php echo $piss->property_officer_mobileNo ?></td>
    </tr>
  </table>
</div>

<br>

<div class="div-tc-lew breaker">
  <table class="tc-lew" border=1>
    <tr>
      <td style="width:20%" class="data-details">TC LEW</td>
      <td style="width:30%" class="data-details"><?php echo $piss->tc_lew ?></td>
      <td style="width:20%" class="data-details">Tel</td>
      <td style="width:30%" class="data-details"><?php echo $piss->tc_lew_telNo ?></td>
    </tr>
    <tr>
      <td style="width:20%" class="data-details">Email</td>
      <td style="width:30%" class="data-details"><?php echo $piss->tc_lew_email ?></td>
      <td style="width:20%" class="data-details">Mobile</td>
      <td style="width:30%" class="data-details"><?php echo $piss->tc_lew_mobileNo ?></td>
    </tr>
  </table>
</div>

<br>

<div class="div-remarks breaker">
  <div class="" style="padding-left:10px; padding-top:10px">
    Remarks:
  </div>
  <p style="padding-left:10px;"><?php echo $piss->remarks ?></p>
    <br><br><br>
</div>
