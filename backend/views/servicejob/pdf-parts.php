<?php

use common\components\Helper;
use common\models\Equipments;

$eq = Equipments::find()->where(['equipment_code'=>$model->equipment_type])->one();
 ?>
<style>


.table-serviceparts,
.table-servicejob,
.wrapper{
  font-size: 13px;
  font-family: Tahoma; sans-serif;
}
.logo{float:left;width:25%}
.company{float:right;width:40%}

.table-serviceparts,
.table-received,
.table-servicejob{
  width:100%;

}

.servicejob-info{width:33%;padding-top: 8px; }
.special{
  background-color: #222;
  padding: 10px;
  text-align: center;
  color:white
}


.table-serviceparts,
.table-received {
  border-collapse: collapse;
}

.serviceparts-info,
.serviceparts-total,
{
  border: 1px solid black;
}

.header{
  background-color: #222;
  color:white;
}

.serviceparts-info{
  width:25%;
  padding: 8px;
  text-align: center;
}

.serviceparts-foot{
  text-align: right;
  padding: 8px;
}
.serviceparts-total{
  text-align: center;
  padding: 8px;
}



.received-one{
  /*float:right;*/
  display: flex;
/*  width:50%;*/
  border: 2px solid black;
  margin-top: 50px;
  page-break-inside: avoid;
}

.received-head{
  border-bottom: 2px solid black;
  padding: 8px;
}



</style>

<div class="wrapper">

  <div class="pdf-wrapper">
    <div class="logo" >
      <img src="../web/logo/techelm_logo.png" alt="">
    </div>
    <div class="company">
      <?php echo $company->address.' '.$company->postal_code?><br>
      Tel: <?php echo $company->telephone ?><br>
      Email: <?php echo $company->email ?><br>

    </div>
    <div class="" style="clear: both; margin: 0pt; padding: 0pt; ">

    </div>
    <br>
    <div class="service-job">
      <table class="table-servicejob">
      <tr>
        <td class="servicejob-info">Customer: <?php echo Helper::retrieveCustomer($model->customer_id); ;?></td>
        <td class="servicejob-info">Service Date: <?php echo $model->service_date ?></td>
        <td class="servicejob-info special" rowspan="2"><?php echo $model->service_no ?></td>
      </tr>
      <tr>
        <td class="servicejob-info">Service: <?php echo Helper::retriveService($model->service_id) ?> </td>
        <td class="servicejob-info">Equipment Type: <?php echo $eq->description ?></td></td>
      </tr>
      <tr>
        <td class="servicejob-info"> Engineer: <?php echo Helper::retriveUserFull($model->engineer_id) ?></td>
        <td class="servicejob-info">Serial No: <?php echo $model->serial_no ?></td>
      </tr>
      <tr>
        <td class="servicejob-info">Site Address: <?php echo nl2br($model->remarks) ?></td>
      </tr>
      </table>
    </div>
    <br>

    <div class="servicejob-parts">
      <table class="table-serviceparts">
        <thead>
          <tr>
            <th class="serviceparts-info header">Parts Name</th>
            <th class="serviceparts-info header">Quantity</th>
            <th class="serviceparts-info header">Unit Price</th>
            <th class="serviceparts-info header">Total Price</th>
          </tr>
        </thead>


          <?php foreach ($modelParts as $i => $parts): ?>
            <tr>
              <td class="serviceparts-info"><?php echo $parts['parts_name']; ?></td>
              <td class="serviceparts-info"><?php echo $parts['quantity'] ?></td>
              <td class="serviceparts-info"><?php echo number_format($parts['unit_price'],2)  ?></td>
              <td class="serviceparts-info"><?php echo number_format($parts['total_price'],2) ?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td></td>
            <td></td>
            <td class="serviceparts-foot"> <strong>Total</strong></td>
            <td class="serviceparts-total"><?php echo number_format($partsTotal,2) ?></td>
          </tr>
      </table>
    </div>

    <br>

    <div class="received-one">
      <div class="received-head">
        <span>Received By</span>
      </div>
      <div class="received-body">
        <span><br><br><br><br><br><br></span>
      </div>
    </div>
  </div>
</div>
