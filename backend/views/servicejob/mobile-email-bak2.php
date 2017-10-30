<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ReformSize;
use common\models\Customer;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobCmAsr;
use common\models\Equipments;
use common\models\ServicejobCmCf;
use common\models\base30;
use common\models\ConvertPng;

$i = 1;
$complaint_count =  count($modelComplaints);
$cust = Customer::find()->where(['id'=>$model->customer_id])->one();
$eq = Equipments::find()->where(['equipment_code'=>$model->equipment_type])->one();

$image = substr($model->signature_customer_name, 0, 1);
if($image == '/'){
  $image_url = Yii::getAlias('@api-signature').'/'.$model->signature_customer_name;
}elseif($image=='i'){
  $base = new ConvertPng();
  $image_url = $base->base30_to_jpeg($model->signature_customer_name, 'signature.png');
}

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

  .service-acknowledge{
    margin-bottom: 30px;
  }
  .service-signature{
    margin-bottom: 50px;
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

        <table class="table-header"  cellspacing="10" cellpadding="10" style="width:800px;  border-collapse:collapse" >
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
            <td style="width:150px"><strong>Job Site</strong> </td>
            <td style="width:450px"> <?php echo ' : '.$cust->job_site ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>Site Address </strong></td>
            <td style="width:450px"> <?php echo ' : '.$model->remarks ?></td>
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
            <td style="width:150px"><strong>Before Remarks </strong></td>
            <td style="width:450px"> <?php echo nl2br($model->remarks_before) ?></td>
          </tr>
          <tr>
            <td style="width:150px"><strong>After Remarks </strong></td>
            <td style="width:450px"> <?php echo nl2br($model->remarks_after) ?></td>
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
                <th style="width:5%;text-align:center">Item</th>
                <th style="width:10%;text-align:center">Category</th>
                <th style="width:25%;text-align:center">Complaint</th>
                <th style="width:20%;text-align:center">Action</th>
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

                  <td>
                    <?php $file = ServicejobCmCf::find()->where(['servicejob_complaint_mobile_id'=>$value->id])->all();?>
                      <?php foreach ($file as $k => $v): ?>
                        <?php $action = ServicejobCmAsr::find()->where(['servicejob_cm_cf_id'=>$v->id])->all();?>
                        <ul>
                          <?php foreach ($action as $key => $value): ?>
                            <?php  $data = ServicejobActionServiceRepair::find()->where(['id'=>$value->servicejob_action_service_repair_id])->one(); ?>
                            <?php if (!empty($data)): ?>
                                <li style="text-align:left"> <?php echo $data->action ?></li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </ul>
                      <?php endforeach; ?>
                  </td>


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
                <th style="width:5%;text-align:center">Item</th>
                <th style="width:40%;text-align:center">Part Name</th>
                <th style="width:15%;text-align:center">Quantity</th>
                <th style="width:20%;text-align:center">Unit Price</th>
                <th style="width:20%;text-align:center">Total Price</th>
              </tr>
            </thead>
              <?php foreach ($modelParts as $key => $value): ?>
                <tr>
                  <td style="width:5%;text-align:center" ><?php echo $i ?></td>
                  <td style="width:40%" ><?php echo $value->parts_name ?></td>
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
                <th  style="width:5%;text-align:center">Item</th>
                <th  style="width:25%;text-align:center">Taken</th>
                <th  style="width:50%;text-align:center">Image Name</th>
                <th  style="width:20%;text-align:center">Image Size</th>
              </tr>
            </thead>
              <?php foreach ($uploads as $key => $value): ?>
                <?php
                    $path = Yii::getAlias('@roots');
                    $path2 = Yii::getAlias('@api-image');
                    $path3 = $path.$path2.'/'.$value->upload_name;
                ?>
                <?php if (file_exists($path3) ): ?>
                  <tr>
                    <td style="width:5%;text-align:center"><?php echo $i ?></td>
                    <td style="width:25%;text-align:center" ><?php echo $value->taken ?></td>
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
                <th  style="width:5%;text-align:center">Item</th>
                <th  style="width:25%;text-align:center">Taken</th>
                <th  style="width:50%;text-align:center">Audio Name</th>
                <th  style="width:20%;text-align:center">Audio Size</th>
              </tr>
            </thead>
          <?php foreach ($recordings as $key => $value): ?>
            <?php
                $path = Yii::getAlias('@roots');
                $path2 = Yii::getAlias('@api-audio');
                $path3 = $path.$path2.'/'.$value->recording_name;

            ?>
            <?php if (file_exists($path3) ): ?>
              <tr>
                <td style="width:5%;text-align:center" ><?php echo $i ?></td>
                <td style="width:25%;text-align:center" ><?php echo $value->taken ?></td>
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
    <div class="service-acknowledge">
      <table border="0" width="800">
        <thead>
          <tr>
            <th class="td-acknowledge">Customer Acknowledgement</th>
            <th>Techelm Technologies Pte Ltd </th>
          </tr>

          <tr>
              <td><br>Signature &emsp;   :
                <?php if (!empty($model->signature_customer_name)): ?>
                  <img src="<?php echo $image_url ?>" alt="" style="width:125px;height:125px;vertical-align:middle">
                <?php else: ?>
                  <?php echo '____________________________' ?>
                <?php endif; ?>
              </td>
              <td><br>Signature &emsp;   :
                <?php if (!empty($model->signature_name)): ?>
                  <!---
                  <img src="<?php//echo Yii::getAlias('@api-signature').'/'.$model->signature_name; ?>" alt=""  style="width:20%;height:auto;text-align:center">
                  --->
                  <img src="<?php echo Yii::getAlias('@api-signature').'/'.$model->signature_name; ?>" alt=""  style="width:125px;height:125px;vertical-align:middle">

                <?php else: ?>
                  <?php echo '____________________________' ?>
                <?php endif; ?>
              </td>
          </tr>
          <tr>
                <td><br>Name &emsp; &emsp; &nbsp;  :
                  <?php if (!empty($model->customer_name_2)): ?>
                    <?php echo $model->customer_name_2//echo Helper::retrieveCustomer($model->customer_id) ?>
                  <?php else: ?>
                    <?php echo '____________________________' ?>
                  <?php endif; ?>
                </td>
                <td><br>Name &emsp; &emsp; &nbsp;  :
                  <?php if (!empty($model->engineer_name_2)): ?>
                    <?php echo $model->engineer_name_2 //Helper::retriveUserFull($model->engineer_id)?>
                  <?php else: ?>
                      <?php echo '____________________________' ?>
                  <?php endif; ?>
                </td>
          </tr>
          <tr>
              <td><br>Date &emsp; &emsp; &emsp;  :
                  <?php if (!empty($model->signature_customer_name) ): ?>
                    <?php echo date('Y-m-d') ?>
                  <?php else: ?>
                    <?php echo '____________________________' ?>
                  <?php endif; ?>
              </td>
              <td><br>Date &emsp; &emsp; &emsp; :
                <?php if (!empty($model->signature_name)): ?>
                    <?php echo date('Y-m-d'); ?>
                <?php else: ?>
                  <?php echo '____________________________'; ?>
                <?php endif; ?>
              </td>
          </tr>
        </thead>
      </table>
    </div>






  </div>
