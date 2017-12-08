<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ReformSize;
use common\models\Customer;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobCmAsr;
use common\models\ServicejobCmCf;
use common\models\Equipments;
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
  body{
    font-size: 14px;
    font-family: "Tahoma", sans-serif;
  //  background-color: #888;
  }
  table{
    width:100%;
    border-collapse: collapse;
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

  .dummy{
    border:1px solid red;
  }

  .test{
    vertical-align: middle;
  }

  .breaker{
    page-break-inside: avoid;
  }

</style>

<div class="logo" >
  <img src="../web/logo/techelm_logo.png" alt="">
</div>
<div class="company">
  <?php echo $company->address.' '.$company->postal_code?><br>
  Tel: <?php echo $company->telephone ?><br>
  Fax: <?php echo $company->fax ?><br>
  Website: <?php echo $company->website ?><br>
</div>

<div class="" style="clear: both; margin: 0pt; padding: 0pt; ">

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
			  <td class="td-header-right"> <?php echo ' : '.$model->type_of_service ?>  </td>
			</tr>
			<tr>
			  <td class="td-header-left"><h4>Job Site </h4></td>
			  <td class="td-header-right"> <?php echo ' : '.$cust->job_site ?></td>
      <tr>
  		  <td class="td-header-left"><h4>Site Address </h4></td>
  			 <td class="td-header-right"> <?php echo ' : '.nl2br($model->remarks) ?></td>
  		</tr>
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
			  <td class="td-header-left"><h4>Remarks Before </h4></td>
			  <td class="td-header-right"> <?php echo nl2br($model->remarks_before) ?></td>
			</tr>
      <tr>
			  <td class="td-header-left"><h4>Remarks After </h4></td>
			  <td class="td-header-right"> <?php echo nl2br($model->remarks_after) ?></td>
			</tr>
		  </table>
    </div>

    <div class="page-break">

    </div>

    <div class="service-complaints">
      <h3 style="padding-left:3em;">COMPLAINT AND ACTION</h3>
      <table class="table-complaints" style="width:100%;" border="1">
          <thead>
            <tr>
              <th colspan="4">COMPLAINT AND ACTION LIST</th>
            </tr>
            <tr>
              <th class="td-complaint">Item</th>
              <th class="td-complaint">Category</th>
              <th class="td-complaint">Complaint</th>
              <th class="td-complaint">Action</th>
            </tr>
          </thead>
            <?php foreach ($modelComplaints as $key => $value): ?>
              <tr>
                <td class="td-complait-details" style="width:5%"><?php echo $i ?></td>
                <td class="td-complait-details" style="width:15%">
                  <?php echo Helper::retriveServiceJobCat($value->servicejob_category_id) ?>
                </td>
                <td class="td-complait-details-n" style="width:35%">
                  <ul>
                      <li><?php echo $value->complaint_name ?></li>
                  </ul>
                  <br>
                   Remark:
                  <p>&emsp;<?php echo $value->complaint_remark ?></p>
                </td>

                <td style="text-align:justified" class="td-complait-details" style="width:45%">
                  <?php $file = ServicejobCmCf::find()->where(['servicejob_complaint_mobile_id'=>$value->id])->all();?>
                    <?php foreach ($file as $k => $v): ?>
                      <?php $action = ServicejobCmAsr::find()->where(['servicejob_cm_cf_id'=>$v->id])->all();?>

                        <?php foreach ($action as $key => $value): ?>
                      <ul>
                        <?php  $data = ServicejobActionServiceRepair::find()->where(['id'=>$value->servicejob_action_service_repair_id])->one(); ?>
                        <li> <?php echo $data->action ?></li>
                      </ul>
                      <?php endforeach; ?>
                    <?php endforeach; ?>
                </td>


              </tr>
              <?php $i++ ?>
            <?php endforeach; ?>

      </table>
    </div>


  <!---  <div class="page-break">

  </div>--->

    <?php $i = 1 ?>

    <div class="service-parts breaker">
      <h3 style="padding-left:3em;">NEW PARTS REPLACEMENT </h3>
      <table class="table-parts" border="1">
        <tr>
          <th colspan="5">NEW PARTS REPLACEMENT LIST</th>
        </tr>
          <thead>
            <tr>
              <th >Item</th>
              <th >Part Name</th>
              <th >Quantity</th>
              <th >Unit Price</th>
              <th >Total Price</th>
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

    <?php $i = 1 ?>
    <br><br>
    <div class="service-image breaker">
      <h3 style="padding-left:3em;">IMAGE CAPTURED</h3>
      <table class="table-image" border="1">
        <tr>
          <th colspan="4"  >IMAGE CAPTURED LIST</th>
        </tr>
          <thead>
            <tr>
              <th >Item</th>
              <th >Taken</th>
              <th >Image Name</th>
              <th >Image Size</th>
            </tr>

          </thead>
            <?php foreach ($uploads as $key => $value): ?>
              <?php
                  $path = Yii::getAlias('@roots');
                  $path2 = Yii::getAlias('@api-main');
                  $path3 = $path.$path2.$value->file_path;

              ?>
                <?php if (file_exists($path3) ): ?>
                  <tr>
                    <td style="width:10%" class="td-audio"><?php echo $i ?></td>
                    <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                    <td style="width:50%" class="td-audio">
                    <?php
                       echo Html::a($value->upload_name,['servicejob/download-image','upload_name'=>$value->file_path]);
                     ?>
                    </td>
                    <td style="width:20%" class="td-audio"><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
                  </tr>
                <?php endif; ?>
              <?php $i++ ?>
            <?php endforeach; ?>

      </table>
    </div>
  <?php   echo $path3; ?>
    <?php $i = 1 ?>
    <br><br>
    <div class="service-audio breaker">
      <h3 style="padding-left:3em;">AUDIO MESSAGE</h3>
      <table class="table-audio" border="1">
        <tr>
          <th colspan="4" >AUDIO MESSAGE LIST</th>
        </tr>
          <thead>
            <tr>
              <th >Item</th>
              <th >Taken</th>
              <th >Audio Name</th>
              <th >Audio Size</th>
            </tr>
          </thead>
        <?php foreach ($recordings as $key => $value): ?>
          <?php
              $path = Yii::getAlias('@roots');
              $path2 = Yii::getAlias('@api-main');
              $path3 = $path.$path2.$value->file_path;

          ?>
            <?php if (file_exists($path3) ): ?>
              <tr>
                <td style="width:10%" class="td-audio"><?php echo $i; ?> </td>
                <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                <td style="width:50%" class="td-audio">
                  <?php echo Html::a($value->recording_name,['servicejob/download-audio','recording_name'=>$value->file_path]); ?>
                </td>
                <td style="width:20%" class="td-audio"><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
              </tr>
          <?php endif; ?>
          <?php $i++ ?>
        <?php endforeach; ?>
      </table>
    </div>


  <!---  <div class="page-break">

  </div>--->

    <br>
      <div class="service-acknowledge breaker">
        <table border="0">
          <thead>
            <tr>
              <th class="td-acknowledge">Customer Acknowledgement</th>
              <th>Techelm Technologies Pte Ltd </th>
            </tr>
          </thead>
            <tr>
                <td><br> <span style="verti">Signature &emsp;   :</span>
                  <?php if (!empty($model->signature_customer_name)): ?>
                      <img src="<?php echo $image_url ?>" alt="" style="width:150px;height:150px;vertical-align:middle">
                    <?php else: ?>
                      <?php echo '____________________________' ?>
                    <?php endif; ?>
                </td>
                <td><br>Signature &emsp;   :
                  <?php if (!empty($model->signature_name)): ?>
                    <!---
                    <img src="<?php// echo Yii::getAlias('@api-signature').'/'.$model->signature_name; ?>" alt=""  style="width:10%;height:auto">
                    --->
                    <img src="<?php echo Yii::getAlias('@api-signature').'/'.$model->signature_name; ?>" alt=""  style="width:150px;height:150px;vertical-align:middle">

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
                      <?php if ($model->signature_customer_name_date== '0000-00-00 00:00:00'): ?>
                        <?php echo $model->end_date_task; ?>
                      <?php else: ?>
                          <?php echo $model->signature_customer_name_date ?>
                      <?php endif; ?>
                    <?php else: ?>
                      <?php echo ' ' ?>
                    <?php endif; ?>
                </td>
                <td><br>Date &emsp; &emsp; &emsp; :
                  <?php if (!empty($model->signature_name)): ?>
                    <?php if ($model->signature_name_date == '0000-00-00 00:00:00'): ?>
                        <?php echo $model->end_date_task; ?>
                    <?php else: ?>
                        <?php echo $model->signature_name_date; ?>
                    <?php endif; ?>

                  <?php else: ?>
                    <?php echo ' '; ?>
                  <?php endif; ?>
                </td>
            </tr>

        </table>
      </div>

  </div>

</div>
