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
}elseif ($image =='i'){
  $base = new ConvertPng();
  $image_url = $base->base30_to_jpeg($model->signature_customer_name, 'signature.png');
}

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

  .customer-sig{
    width:25%;
    height: auto;
  }

  .service-acknowledge{
    margin-bottom: 30px;
  }
  .service-signature{
    margin-bottom: 50px;
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
            <td class="td-header-left"><h4>Job Site </h4></td>
            <td style="width:450px"> <?php echo ' : '.$cust->job_site ?></td>
          </tr>
          <tr>
            <td class="td-header-left"><h4>Site Address </h4></td>
            <td class="td-header-right"> <?php echo nl2br($model->remarks) ?></td>
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
    			  <td class="td-header-left"><h4>Remarks Before </h4></td>
    			  <td class="td-header-right"> <?php echo nl2br($model->remarks_after) ?></td>
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
                <th class="td-complaint center-type">Action</th>
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
                    <p>&emsp;<?php echo nl2br($value->complaint_remark) ?></p>
                  </td>

                  <td style="text-align:justified" class="td-complait-details" >
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

              </tr>
            </thead>
              <?php foreach ($modelParts as $key => $value): ?>
                <tr>
                  <td style="width:10%" class="td-parts" ><?php echo $i ?></td>
                  <td style="width:55%" class="td-parts-n"><?php echo $value->parts_name ?></td>
                  <td style="width:15%" class="td-parts"><?php echo $value->quantity ?></td>

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
                 //$path2 = Yii::getAlias('@api-image');
                 //$path3 = $path.$path2.'/'.$value->upload_name;
                 $path2 = Yii::getAlias('@api-main');
                 $path3 = $path.$path2.$value->file_path;

                ?>
                <?php if (file_exists($path3) ): ?>
                  <tr>
                    <td style="width:10%" class="td-audio"><?php echo $i ?></td>
                    <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                    <td style="width:50%" class="td-audio">
                       <!---return Html::a(Html::img($model->user->filename, ['alt'=>'yii']), [ 'view3', 'id' => $model->id]);
                        --->
                         <?php $image = Yii::getAlias('@api-main').'/'.$value->file_path; ?>
                        <a href="<?php echo $image ?>"><?php echo $value->upload_name ?></a>

                      <?php  Html::a($value->upload_name,['servicejob/download-image','upload_name'=>$value->upload_name]); ?>
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
                //$path2 = Yii::getAlias('@api-audio');
                //$path3 = $path.$path2.'/'.$value->recording_name;
                $path2 = Yii::getAlias('@api-main');
                $path3 = $path.$path2.$value->file_path;
            ?>
            <?php if (file_exists($path3) ): ?>
              <tr>
                <td style="width:10%" class="td-audio"><?php echo $i ?></td>
                <td style="width:20%" class="td-audio"><?php echo $value->taken ?></td>
                <td style="width:50%" class="td-audio">
                  <?php $record = Yii::getAlias('@api-audio').$value->file_path; ?>>
                  <a href="<?php echo $record?>"> <?php echo $value->recording_name?></a>
                  <?php //echo $value->recording_name?>
                  <?php //echo Html::a($value->recording_name,['servicejob/download-audio','recording_name'=>$value->recording_name]); ?>
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
                <td><br>Signature &emsp;   :
                  <?php if (!empty($model->signature_customer_name)): ?>
                      <img src="<?php echo $image_url ?>" alt="" style="width:150px;height:150px;vertical-align:middle">
                    <?php else: ?>
                      <?php echo '____________________________' ?>
                    <?php endif; ?>
                </td>
                <td><br>Signature &emsp;   :
                  <?php if (!empty($model->signature_name)): ?>
                    <img src="<?php echo Yii::getAlias('@api-signature').'/'.$model->signature_name; ?>" alt=""  style="width:20%;height:auto;">
                  <?php else: ?>
                    <?php echo '____________________________' ?>
                  <?php endif; ?>
                </td>
            </tr>
            <tr>
              <td><br>Name &emsp; &emsp; &nbsp;  :
                <?php if (!empty($model->customer_name_2)): ?>

                  <?php echo $model->customer_name_2;?>
                <?php else: ?>
                  <?php echo '____________________________' ?>
                <?php endif; ?>
              </td>
              <td><br>Name &emsp; &emsp; &nbsp;  :
                <?php if (!empty($model->engineer_name_2)): ?>
                  <?php echo $model->engineer_name_2; ?>
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


  </div>
</div>
