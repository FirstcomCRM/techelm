<?php
use yii\helpers\Html;
use common\models\ServicejobCategories;
use common\models\Customer;
use common\models\Service;
use common\models\User;
 ?>

 <style>
.print-wrapper{
  font-family:Tahoma,sans-serif;
  font-size: 13px;
}

.servicejob-line,
.servicejob-head{
  border-collapse: collapse;
  width:100%;
}

.label,
.label-echo{
  width:25%;
  padding:5px;
}

.label{
  font-weight: bold;
}

.line{
  padding:8px;;
  width:33%;
}

.site-address{
  border: 1px solid black;

}

 </style>

<div class="print-wrapper">
  <div class="servicejob-wrapper">
    <h4 style="float:right">Service Job: <?php echo $model->service_no ?></h4>
    <table class="servicejob-head" border='1'>
    <tr>
      <td class="label">Service</td>
      <td class="label-echo">
        <?php
        $service = Service::find()->where(['id'=>$model->service_id ])->one();
        echo $service->service_name ?>
      </td>
      <td class="label">Start Date</td>
      <td class="label-echo"><?php echo substr($model->start_date,0,10) ?></td>
    </tr>
    <tr>
      <td class="label">Customer</td>
      <td class="label-echo">
        <?php
        $cust = Customer::find()->where(['id'=>$model->customer_id])->one();
        echo $cust->fullname ?>
      </td>
      <td class="label">Engineer Name</td>
      <td class="label-echo">
        <?php
        $engineer = User::find()->where(['id'=>$model->engineer_id])->one();
        echo $engineer->fullname ?>
      </td>
    </tr>
    <tr>
      <td class="label">Serial No</td>
      <td class="label-echo"><?php echo $model->serial_no ?></td>
      <td class="label">Equipment Type</td>
      <td class="label-echo"><?php echo $model->equipment_type ?></td>
    </tr>
    </table>

    <h4>Complaints</h4>
    <table class="servicejob-line" border="1">
      <thead>
        <tr>
          <td class="label">Complaint Category</td>
          <td class="label"> Complaint</td>
          <td class="label">Remark</td>
        </tr>
      </thead>
        <?php foreach ($modelComplaints as $i => $line): ?>
          <tr>
            <td class="line">
              <?php $cat = ServicejobCategories::find()->where(['id'=>$line->servicejob_category_id])->one();
              echo $cat->category;
              ?>
            </td>
            <td class="line"><?php echo $line->complaint_name ?></td>
            <td class="line"><?php echo nl2br($line->complaint_remark)  ?></td>
          </tr>
        <?php endforeach; ?>
    </table>
  </div>
  <br>
  <h4 class="site-echo">Site Address</h4>
  <span><?php echo nl2br($model->remarks)?></span>
  
</div>
