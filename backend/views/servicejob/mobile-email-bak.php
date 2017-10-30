<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ReformSize;
use common\models\Customer;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobCmAsr;
use common\models\Equipments;
$i = 1;
$complaint_count =  count($modelComplaints);
$cust = Customer::find()->where(['id'=>$model->customer_id])->one();
$eq = Equipments::find()->where(['equipment_code'=>$model->equipment_type])->one();

?>

<style>


  h1,h2,h3,h4,h5,h6{
    color:black;
  }

  table{
  /*  width:100%; */
  /*  border-collapse: collapse;*/
    /*  border: 1px solid black;*/
  }

  .center-type{
    text-align:center;
  }


  .td-header-left,
  .td-header-right{
    padding:8px;
  }
  .td-header-left{width:30%}
  .td-header-right{width:70%}

  .td-compliant{
    width:16%;
  }

  .td-audio,
  .td-parts{
    padding:7px;
    text-align: center;
  }
  .td-parts-n{
    padding:7px;
  }
  .td-acknowledge{
    width:50%
  }

  .indent{
    padding: 7px;
  }

  .comp-remarks{
    margin-left: 20px;
    color:red;
  }

  .td-complait-details{
    padding:7px;
    text-align: center;
  }
  .td-complait-details-n{
    padding:7px;

  }

  .page-break{
    page-break-after: always;
  }

</style>

  <br>
  <div style="width:800px">
    <div class="logo" >
      <img src="../web/logo/techelm_logo.png" alt="" style="float:left">
    </div>
    <div style="float:right">
      <br>
      <?php echo $company->address.' '.$company->postal_code?><br>
      Tel: <?php echo $company->telephone ?><br>
      Fax: <?php echo $company->fax ?><br>
      Website: <?php echo $company->website ?><br>
    </div>
  </div>


    <div class="" style="clear: both; margin: 0pt; padding: 0pt; ">

    </div>

  <div class="wrapper">
    <div class="pdf-wrapper">

      <div class="service-header">
        <h3>SERVICE JOB DETAILS <?php echo $model->service_no ?></h3>

        <table class="table-header"  cellspacing="10" cellpadding="10" style="width:600px;  border-collapse:collapse">
          <tr>
            <td style="width:150px"> <strong>Service Job ID</strong> </td>
            <td style="width:450px"> <?php echo ' : '.$model->id ?></td>
          </tr>
          <tr>
            <td style="width:150px"> <strong>Service No</strong> </td>
            <td style="width:450px"> <?php echo ' : '.$model->service_no ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Engineer</strong> </td>
            <td style="width:450px"> <?php echo ' : '.Helper::retriveUserFull($model->engineer_id) ?></td>
          </tr>
          <tr>
            <td style="width:150px"> <strong>Equipment Type</strong> </td>
            <td style="width:450px"> <?php echo ' : '.$eq->description ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Type of Service</strong> </td>
            <td style="width:450px"> <?php echo ' : '.$model->type_of_service ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Site Address </strong></td>
            <td style="width:450px"> <?php echo ' : '.$model->remarks ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Job Site</strong> </td>
            <td style="width:450px"> <?php echo ' : '.$cust->job_site ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Model/Serial No </strong></td>
            <td style="width:450px"> <?php echo ' : '.$model->serial_no ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Customer </strong></td>
            <td style="width:450px"> <?php echo ' : '.Helper::retrieveCustomer($model->customer_id) ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Customer Address </strong></td>
            <td style="width:450px">
              <?php echo ' : '.$cust->address ?>
            </td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Telephone </strong></td>
            <td style="width:450px"> <?php echo ' : '.$cust->phone_no ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Fax </strong></td>
            <td style="width:450px"> <?php echo ' : '.$cust->fax ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Start Date </strong></td>
            <td style="width:450px"> <?php echo ' : '.$model->start_date_task ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>End Date </strong></td>
            <td style="width:450px"> <?php echo ' : '.$model->end_date_task ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Link </strong></td>
            <td style="width:450px">
              <?php echo ' : '.Html::a('View Web Page',['servicejob/view','id'=>$model->id],['target'=>'_blank'] ); ?>
            </td>
          </tr>
        </table>
      </div>

      <div class="page-break">

      </div>


      <div class="service-complaints">
        <h3>COMPLAINT AND ACTION</h3>
        <table class="table-complaints" cellpadding="10" style="width:800px;border-collapse:collapse;" border="1">
            <thead>
              <tr>
                <th colspan="6" style="text-align:center">COMPLAINT AND ACTION LIST</th>
              </tr>
              <tr>
                <th style="width:10%;text-align:center">Item</th>
                <th style="width:10%;text-align:center">Category</th>
                <th style="width:20%;text-align:center">Complaint</th>
                <th style="width:20%;text-align:center">Before Remarks</th>
                <th style="width:20%;text-align:center">Action</th>
                <th style="width:20%;text-align:center">After Remarks</th>
              </tr>
            </thead>
              <?php foreach ($modelComplaints as $key => $value): ?>
                <tr>
                  <td style="text-align:center" ><?php echo $i ?></td>
                  <td style="text-align:center" >
                    <?php echo Helper::retriveServiceJobCat($value->servicejob_category_id) ?>
                  </td>
                  <td>
                    <ul>
                      <li><?php echo $value->complaint_name ?></li><br>
                      Remarks:
                      <p><?php echo $value->complaint_remark ?></p>
                    </ul>
                  </td>

                  <?php if ($i == 1): ?>
                    <td class="td-complait-details remove-border-bottom" style="width:15%;" >
                      <?php echo nl2br($model->remarks_before) ?>
                    </td>
                  <?php else: ?>
                    <td></td>
                  <?php endif; ?>

                  <td>
                    <?php $action = ServicejobCmAsr::find()->where(['servicejob_cm_cf_id'=>$value->id])->all();?>
                      <?php foreach ($action as $k => $v): ?>
                        <?php  $data = ServicejobActionServiceRepair::find()->where(['id'=>$v->servicejob_action_service_repair_id])->one(); ?>
                        <ul>
                          <li style="text-align:left">  <?php echo $data->action ?></li>
                        </ul>
                        <?php endforeach; ?>
                  </td>

                  <?php if ($i == 1): ?>
                    <td class="td-complait-details" style="width:15%" >
                      <?php echo nl2br($model->remarks_after) ?>
                    </td>
                  <?php else: ?>
                    <td></td>
                  <?php endif; ?>
                </tr>
                <?php $i++ ?>
              <?php endforeach; ?>

        </table>
      </div>

      <div class="page-break">

      </div>
      <?php $i = 1 ?>

      <div class="service-parts">
        <h3>NEW PARTS REPLACEMENT </h3>
        <table class="table-parts" cellpadding="10"  style="width:800px;border-collapse:collapse;" border="1">
            <thead>
              <tr>
                <th colspan="6" style="text-align:center">NEW PARTS REPLACEMENT LIST</th>
              </tr>
              <tr>
                <th style="text-align:center">Item</th>
                <th style="text-align:center">Part Name</th>
                <th style="text-align:center">Quantity</th>
                <th style="text-align:center">Unit Price</th>
                <th style="text-align:center">Total Price</th>
              </tr>
            </thead>
              <?php foreach ($modelParts as $key => $value): ?>
                <tr>
                  <td style="width:10%;text-align:center" ><?php echo $i ?></td>
                  <td style="width:35%" ><?php echo $value->parts_name ?></td>
                  <td style="width:15%;text-align:center" ><?php echo $value->quantity ?></td>
                  <td style="width:20%;text-align:center" ><?php echo $value->unit_price ?></td>
                  <td style="width:20%;text-align:center" ><?php echo $value->total_price ?></td>
                </tr>
                <?php $i++ ?>
              <?php endforeach; ?>
        </table>
      </div>


      <?php $i = 1 ?>

      <div class="service-image">
        <h3>IMAGE CAPTURED</h3>
        <table class="table-image" cellpadding="10" style="width:800px;border-collapse:collapse;" border="1">

            <thead>
              <tr>
                <th colspan="4"  style="text-align:center">IMAGE CAPTURED LIST</th>
              </tr>
              <tr>
                <th  style="text-align:center">Item</th>
                <th  style="text-align:center">Taken</th>
                <th  style="text-align:center">Image Name</th>
                <th  style="text-align:center">Image Size</th>
              </tr>
            </thead>
              <?php foreach ($uploads as $key => $value): ?>
                <?php
                    $path = Yii::getAlias('@roots');
                    $path2 = Yii::getAlias('@api-image');
                    $path3 = $path.$path2.'/'.$value->upload_name;

                    $old_path2 = Yii::getAlias('@api-image-old');
                    $old_path3 = $path.$old_path2.'/'.$value->upload_name;
                ?>
                <?php if (file_exists($path3) || file_exists($old_path3)): ?>
                  <tr>
                    <td style="width:10%;text-align:center"><?php echo $i ?></td>
                    <td style="width:20%;text-align:center" ><?php echo $value->taken ?></td>
                    <td style="width:50%;text-align:center" >
                      <?php echo Html::a($value->upload_name,['servicejob/download-image','upload_name'=>$value->upload_name]); ?>
                    </td>
                    <td style="width:20%;text-align:center" class="td-audio"><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
                  </tr>
                <?php endif; ?>
                <?php $i++ ?>
              <?php endforeach; ?>

        </table>
      </div>


      <?php $i = 1 ?>

      <div class="service-audio">
        <h3 >AUDIO MESSAGE</h3>
        <table class="table-audio" cellpadding="10" style="width:800px;border-collapse:collapse;" border="1">
            <thead>
              <tr>
                <th colspan="4" style="text-align:center">AUDIO MESSAGE LIST</th>
              </tr>
              <tr>
                <th  style="text-align:center">Item</th>
                <th  style="text-align:center">Taken</th>
                <th  style="text-align:center">Audio Name</th>
                <th  style="text-align:center">Audio Size</th>
              </tr>
            </thead>
          <?php foreach ($recordings as $key => $value): ?>
            <?php
                $path = Yii::getAlias('@roots');
                $path2 = Yii::getAlias('@api-audio');
                $path3 = $path.$path2.'/'.$value->recording_name;

                $old_path2 = Yii::getAlias('@api-audio-old');
                $old_path3 = $path.$old_path2.'/'.$value->recording_name;
            ?>
            <?php if (file_exists($path3) || file_exists($old_path3)): ?>
              <tr>
                <td style="width:10%;text-align:center" ><?php echo $i ?></td>
                <td style="width:20%;text-align:center" ><?php echo $value->taken ?></td>
                <td style="width:50%;text-align:center" >
                  <?php echo Html::a($value->recording_name,['servicejob/download-audio','recording_name'=>$value->recording_name]); ?>
                </td>
                <td style="width:20%;text-align:center"  ><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
              </tr>
            <?php endif; ?>
            <?php $i++ ?>
          <?php endforeach; ?>
        </table>
      </div>

      <br>

    </div>
    <br>
    <div class="service-acknowledge">
      <table border="0" style="width:800px">
        <thead>
          <tr>
            <th style="width:50%">Customer Acknowledgement</th>
            <th style="width:50%">Techelm Technologies Pte Ltd </th>
          </tr>

          <tr>
              <td><br>Signature &emsp;   : ____________________________</td>
              <td><br>Signature &emsp;   : _____________________________</td>
          </tr>
          <tr>
              <td><br>Name &emsp; &emsp; &nbsp;  : ____________________________</td>
              <td><br>Name &emsp; &emsp; &nbsp;  : _____________________________</td>
          </tr>
          <tr>
              <td><br>Date &emsp; &emsp; &emsp;  : ____________________________</td>
              <td><br>Date &emsp; &emsp; &emsp; : _____________________________</td>
          </tr>
        </thead>
      </table>
    </div>


  </div>
