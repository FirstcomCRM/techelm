<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
use common\models\ServicejobCategories;
use common\models\ServicejobActionServiceRepair;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;


//echo '<pre>';
//print_r($dataProvider);
//echo '</pre>';
//foreach ($dataProvider as $key => $value) {
//  echo $value['service_no'].'-'.$value['customer_id'].'<br>';
//}
//die('t');
?>
<div class="reports-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search Serivce Job Details</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('b-search', ['model' => $searchModel]); ?>
      </div>
    </div>
    <?php if ($x=='show'): ?>
      <div class="row dataprovider">
          <div class="col-md-12">
              <div class="panel panel-primary">
                  <div class="panel-heading"><span>Service Job Details</span></div>
                  <div class="panel-body">
                    <div class="text-right">
                        <?php echo Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF',['pdf-b'],['class'=>'btn btn-primary', 'target'=>'_blank']) ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <th>Service No</th>
                          <th>Customer</th>
                          <th>Engineer</th>
                          <th>Service Date</th>
                          <th>Status</th>
                          <th>State</th>
                          <th>Service Complaint</th>
                          <th>Complaint</th>
                        <!---  <th>Complaint Remark</th>--->
                          <th>Service Action</th>
                        </thead>
                        <tbody>
                        <?php if (!empty($dataProvider)): ?>
                          <?php foreach ($dataProvider as $key => $value): ?>
                            <tr>
                              <td><?php echo $value['service_no'] ?>                
                              </td>
                              <td>
                                <?php echo Helper::retrieveCustomer($value['customer_id']) ?>
                              </td>
                              <td>
                                <?php echo Helper::retriveUserFull($value['engineer_id']) ?>
                              </td>
                              <td><?php echo $value['service_date'] ?></td>
                              <td>
                                <?php echo Helper::retriveStatusFlag($value['status']) ?>
                              </td>
                              <td>
                                <?php echo Helper::retriveActiveLabel($value['active']) ?>
                              </td>
                              <td>
                                <?php
                                  $data = ServicejobCategories::find()->where(['id'=>$value['servicejob_category_id']])->one();
                                  if (!empty($data)) {
                                      echo $data->category;
                                  }else {
                                    echo $data = null;
                                  }
                              ?>
                              </td>
                              <td><?php echo $value['complaint_name'] ?></td>
                            <!---  <td><?php //echo nl2br($value['complaint_remark']) ?></td>--->
                              <td>
                                <?php
                                  $data = ServicejobActionServiceRepair::find()->where(['id'=>$value['servicejob_action_service_repair_id']])->one();
                                  if (!empty($data)) {
                                      echo $data->action;
                                  }else {
                                    echo $data = null;
                                  }
                                // echo $value['servicejob_action_service_repair_id']
                                ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>

                        <?php else: ?>
                          <tr>
                              <td><span>No Records Found.</span></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                        <?php endif; ?>

                        </tbody>

                      </table>
                    </div>

                  </div>
              </div>
          </div>
      </div>
   <?php endif; ?>




</div>
