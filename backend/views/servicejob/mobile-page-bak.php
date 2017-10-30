<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ReformSize;
use common\models\Customer;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobCmAsr;
use common\models\Equipments;
use common\models\ServicejobCmCf;

$i = 1;
$complaint_count =  count($modelComplaints);
$cust = Customer::find()->where(['id'=>$model->customer_id])->one();
$eq = Equipments::find()->where(['equipment_code'=>$model->equipment_type])->one();

?>

<style>
  body{
    font-size: 16px;
    font-family: "Tahoma", sans-serif;
  }

  h1,h2,h3,h4,h5,h6{
    color:black;
  }

  table{
    width:100%;
    border-collapse: collapse;
    /*  border: 1px solid black;*/
  }

  .center-type{
    text-align:center;
  }

  .logo{float:left;width:30%}
  .company{float:right;width:40%}
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


  #yii-debug-toolbar{
    display: none;
  }

  .remove-border-bottom{
    border-bottom: none !important;

  }


</style>


<div class="container">
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
  <div class="wrapper">
    <div class="pdf-wrapper">

      <div class="service-header">
        <h3>SERVICE JOB DETAILS <?php echo $model->service_no ?></h3>
        <br>
        <table class="table-header">
          <tr>
            <td class="td-header-left"><h4>Service Job ID </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->id ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Service No </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->service_no ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Engineer </h4></td>
            <td class="td-header-right"> <?php echo ' : '.Helper::retriveUserFull($model->engineer_id) ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Equipment Type </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$eq->description ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Type of Service </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->type_of_service ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Site Address </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->remarks ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Job Site </h4></td>
            <td class="td-header-right"> <?php echo ' : ' ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Model/Serial No </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->serial_no ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Customer </h4></td>
            <td class="td-header-right"> <?php echo ' : '.Helper::retrieveCustomer($model->customer_id) ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Customer Address </h4></td>
            <td class="td-header-right">
              <?php echo ' : '.$cust->address ?>
            </td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Telephone </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$cust->phone_no ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Fax </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$cust->fax ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Start Date </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->start_date_task ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>End Date </h4></td>
            <td class="td-header-right"> <?php echo ' : '.$model->end_date_task ?></td>
          </tr>
          <tr>
            <td style="width:150px"><h4>Link</h4> </td>
            <td style="width:450px">
              <?php echo ' : '.Html::a('View Web Page',['servicejob/view','id'=>$model->id],['target'=>'_blank'] ); ?>
            </td>
          </tr>
        </table>
      </div>

      <div class="page-break">

      </div>
      <hr>

      <div class="service-complaints">
        <h3 class="center-type">COMPLAINT AND ACTION</h3>
        <table class="table-complaints table table-bordered" border="1">

            <thead>
              <tr>
                <th colspan="6" class="center-type">COMPLAINT AND ACTION LIST</th>
              </tr>
              <tr>
                <th class="td-complaint center-type">Item</th>
                <th class="td-complaint center-type">Category</th>
                <th class="td-complaint center-type">Complaint</th>
                <th class="td-complaint center-type">Before Remarks</th>
                <th class="td-complaint center-type">Action</th>
                <th class="td-complaint center-type">After Remarks</th>
              </tr>
            </thead>
              <?php foreach ($modelComplaints as $key => $value): ?>
                <tr>
                  <td class="td-complait-details" ><?php echo $i ?></td>
                  <td class="td-complait-details" >
                    <?php echo Helper::retriveServiceJobCat($value->servicejob_category_id) ?>
                  </td>
                  <td class="td-complait-details-n" >
                    <ul>
                      <p>
                        <li><?php echo $value->complaint_name ?></li>
                      </p>
                    </ul>
                    <br>
                     Remark:
                    <p>&emsp;<?php echo $value->complaint_remark ?></p>
                  </td>
                  <?php if ($i == 1): ?>
                    <td class="td-complait-details" style="width:15%">
                      <?php echo nl2br($model->remarks_before) ?>
                    </td>
                  <?php else: ?>
                    <td></td>
                  <?php endif; ?>

                  <td style="text-align:justified" class="td-complait-details" >
                    <?php $action = ServicejobCmAsr::find()->where(['servicejob_cm_cf_id'=>$value->id])->all();?>
                      <?php echo $value->id ?>
                      <?php foreach ($action as $k => $v): ?>
                        <?php  $data = ServicejobActionServiceRepair::find()->where(['id'=>$v->servicejob_action_service_repair_id])->one(); ?>

                        <ul>
                          <li style="text-align:left">  <?php echo $data->action ?></li>
                        </ul>
                      <?php endforeach; ?>
                  </td>
                  <?php if ($i == 1): ?>
                    <td class="td-complait-details" style="width:15%">
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
      <hr>
      <div class="service-parts">
        <h3 class="center-type">NEW PARTS REPLACEMENT </h3>
        <table class="table-parts table table-bordered" border="1">

            <thead>
              <tr>
                <th colspan="6" class="center-type">NEW PARTS REPLACEMENT LIST</th>
              </tr>
              <tr>
                <th class="center-type">Item</th>
                <th class="center-type">Part Name</th>
                <th class="center-type">Quantity</th>
                <th class="center-type">Unit Price</th>
                <th class="center-type">Total Price</th>
              </tr>
            </thead>
              <?php foreach ($modelParts as $key => $value): ?>
                <tr>
                  <td style="width:10%" class="td-parts" ><?php echo $i ?></td>
                  <td style="width:35%" class="td-parts-n"><?php echo $value->parts_name ?></td>
                  <td style="width:15%" class="td-parts"><?php echo $value->quantity ?></td>
                  <td style="width:20%" class="td-parts"><?php echo $value->unit_price ?></td>
                  <td style="width:20%" class="td-parts"><?php echo $value->total_price ?></td>
                </tr>
                <?php $i++ ?>
              <?php endforeach; ?>
        </table>
      </div>

      <hr>
      <?php $i = 1 ?>

      <div class="service-image">
        <h3 class="center-type">IMAGE CAPTURED</h3>
        <table class="table-image table table-bordered" border="1">

            <thead>
              <tr>
                <th colspan="4"  class="center-type">IMAGE CAPTURED LIST</th>
              </tr>
              <tr>
                <th  class="center-type">Item</th>
                <th  class="center-type">Taken</th>
                <th  class="center-type">Image Name</th>
                <th  class="center-type">Image Size</th>
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
                    <td style="width:10%" class="td-audio"><?php echo $i ?></td>
                    <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                    <td style="width:50%" class="td-audio">
                      <?php echo Html::a($value->upload_name,['servicejob/download-image','upload_name'=>$value->upload_name]); ?>
                    </td>
                    <td style="width:20%" class="td-audio"><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
                  </tr>
                <?php endif; ?>
                <?php $i++ ?>
              <?php endforeach; ?>

        </table>
      </div>

      <hr>
      <?php $i = 1 ?>

      <div class="service-audio">
        <h3 class="center-type">AUDIO MESSAGE</h3>
        <table class="table-audio table table-bordered" border="1">
            <thead>
              <tr>
                <th colspan="4" class="center-type">AUDIO MESSAGE LIST</th>
              </tr>
              <tr>
                <th  class="center-type">Item</th>
                <th  class="center-type">Taken</th>
                <th  class="center-type">Audio Name</th>
                <th  class="center-type">Audio Size</th>
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
                <td style="width:10%" class="td-audio"><?php echo $i ?></td>
                <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                <td style="width:50%" class="td-audio">
                  <?php echo Html::a($value->recording_name,['servicejob/download-audio','recording_name'=>$value->recording_name]); ?>
                </td>
                <td style="width:20%" class="td-audio"><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
              </tr>
            <?php endif; ?>
            <?php $i++ ?>
          <?php endforeach; ?>
        </table>
      </div>

      <br>
      <hr>
      <br>

      <div class="service-acknowledge">
        <table border="0">
          <thead>
            <tr>
              <th class="td-acknowledge">Customer Acknowledgement</th>
              <th>Techelm Technologies Pte Ltd </th>
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


  </div>
</div>
