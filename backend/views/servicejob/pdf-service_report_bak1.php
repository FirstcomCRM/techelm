<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ReformSize;
use common\models\Customer;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobCmAsr;
use common\models\ServicejobCmCf;
use common\models\Equipments;

$i = 1;
$complaint_count =  count($modelComplaints);
$cust = Customer::find()->where(['id'=>$model->customer_id])->one();
$eq = Equipments::find()->where(['equipment_code'=>$model->equipment_type])->one();
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
			  <td class="td-header-left"><h4>Site Address </h4></td>
			  <td class="td-header-right"> <?php echo ' : '.$model->remarks ?></td>
			</tr>
			<tr>
			  <td class="td-header-left"><h4>Job Site </h4></td>
			  <td class="td-header-right"> <?php echo ' : '.$cust->job_site ?></td>
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
		  </table>
    </div>

    <div class="page-break">

    </div>

    <div class="service-complaints">
      <h3 style="padding-left:3em;">COMPLAINT AND ACTION</h3>
      <table class="table-complaints" border="1">
          <thead>
            <tr>
              <th colspan="6">COMPLAINT AND ACTION LIST</th>
            </tr>
            <tr>
              <th class="td-complaint">Item</th>
              <th class="td-complaint">Category</th>
              <th class="td-complaint">Complaint</th>
              <th class="td-complaint">Before Remarks</th>
              <th class="td-complaint">Action</th>
              <th class="td-complaint">After Remarks</th>
            </tr>
          </thead>
            <?php foreach ($modelComplaints as $key => $value): ?>
              <tr>
                <td class="td-complait-details" style="width:5%"><?php echo $i ?></td>
                <td class="td-complait-details" style="width:15%">
                  <?php echo Helper::retriveServiceJobCat($value->servicejob_category_id) ?>
                </td>
                <td class="td-complait-details-n" style="width:20%">

                  <ul>
                      <li><?php echo $value->complaint_name ?></li>
                  </ul>
                  <br>
                   Remark:
                  <p>&emsp;<?php echo $value->complaint_remark ?></p>
                </td>
                <?php if ($i == 1): ?>
                  <?php echo $complaint_count ?>
                  <td class="td-complait-details remove-border-bottom" style="width:15%;"   >
                    <?php echo nl2br($model->remarks_before) ?>
                  </td>
                <?php else: ?>
                  <td></td>
                <?php endif; ?>

                <td style="text-align:justified" class="td-complait-details" style="width:30%">
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
      <h3 style="padding-left:3em;">NEW PARTS REPLACEMENT </h3>
      <table class="table-parts" border="1">
        <tr>
          <th colspan="6">NEW PARTS REPLACEMENT LIST</th>
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
    <div class="service-image">
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
                  $path2 = Yii::getAlias('@api-image');
                  $path3 = $path.$path2.'/'.$value->upload_name;
              ?>
                <?php if (file_exists($path3) ): ?>
                  <tr>
                    <td style="width:10%" class="td-audio"><?php echo $i ?></td>
                    <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                    <td style="width:50%" class="td-audio">
                    <?php
                        echo Html::a($value->upload_name,['servicejob/download-image','upload_name'=>$value->upload_name]);
                     ?>
                    </td>
                    <td style="width:20%" class="td-audio"><?php echo ReformSize::formatSizeUnits($value->size) ?></td>
                  </tr>
                <?php endif; ?>
              <?php $i++ ?>
            <?php endforeach; ?>

      </table>
    </div>

    <?php $i = 1 ?>
    <br><br>
    <div class="service-audio">
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
              $path2 = Yii::getAlias('@api-audio');
              $path3 = $path.$path2.'/'.$value->recording_name;

          ?>
            <?php if (file_exists($path3) ): ?>
              <tr>
                <td style="width:10%" class="td-audio"><?php echo $i; ?> </td>
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


    <div class="page-break">

    </div>

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

    <br>
    <?php if ($model->status == 3): ?>
    <div class="service-acknowledge">
      <table border="0">
        <thead>
          <tr>
            <th class="td-acknowledge">Customer Signature</th>
            <th>Engineer Signature </th>
          </tr>

          <tr>
              <td style="text-align:center">
                <?php if (!empty($model->signature_name)): ?>
                  <img src="<?php echo Yii::getAlias('@api-signature').'/'.$model->signature_name; ?>" alt=""  style="width:10%;height:auto">
                  <br><br><br><br>
                <?php endif; ?>
              </td>

              <td style="text-align:center">
                <?php if (!empty($model->signature_customer_name)): ?>
                  <img src="<?php echo Yii::getAlias('@api-signature').'/'.$model->signature_customer_name; ?>" alt="" style="width:10%;height:auto">
                  <br><br><br><br>
                <?php endif; ?>
              </td>
          </tr>

        </thead>
      </table>
    </div>
    <?php endif; ?>


  </div>


</div>
