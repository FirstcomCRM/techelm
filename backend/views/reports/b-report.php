<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
use common\models\ServicejobComplaintMobile;
use common\models\ServicejobCmAsr;
use common\models\ServicejobCategories;
use common\models\ServicejobActionServiceRepair;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;

$main_ids = [];
$i = 1;
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
                      <?php if (!empty($dataProvider)): ?>
                        <?php foreach ($dataProvider as $key => $value): ?>
                          <?php $main_ids[] = $value['ids'] ?>
                        <?php endforeach; ?>
                      <?php else: ?>
                        NO RECORD FOUND
                      <?php endif; ?>
                    </div>
                    <?php $main_ids = array_unique($main_ids,SORT_LOCALE_STRING) ?>
                    <?php asort($main_ids) ?>
                    <?php $dataProvider = null; ?>


                      <?php foreach ($main_ids as $key => $value): ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h3 class="panel-title">Service Job</h3>
                          </div>
                          <div class="panel-body">
                            <?php $servicejob = Servicejob::find()->where(['id'=>$value])->one(); ?>
                            <div class="row">
                              <div class="col-md-4">
                                <strong>Service No:</strong>
                                <?= Html::tag('span', Html::encode($servicejob->service_no), ['title'=>'Site Address: '.$servicejob->remarks ,'data-toggle'=>'tooltip', 'data-placement'=>'right']) ?>
                              </div>
                              <div class="col-md-4">
                                <strong>Service Customer:</strong>
                                <?php echo Helper::retrieveCustomer($servicejob->customer_id); ?>
                              </div>
                              <div class="col-md-4">
                                <strong>Service Date:</strong>
                                <?php echo $servicejob->service_date; ?>
                              </div>
                            </div>
                            <hr>

                            <table class="table table-bordered">
                              <thead>
                                <th>No</th>
                                <th>Complaint</th>
                                <th>Action</th>
                              </thead>
                              <tbody>
                                <?php $complaints = ServicejobComplaintMobile::find()->where(['servicejob_id'=>$value])->all(); ?>
                                <?php foreach ($complaints as $key => $value): ?>

                                  <tr>
                                    <td style="width:10%"><?php echo $i ?></td>
                                    <td style="width:45%"><?php echo $value->complaint_name ?></td>
                                    <td style="width:45%">
                                      <?php $actions =  ServicejobCmAsr::find()->where(['servicejob_cm_cf_id'=>$value->id])->all()?>

                                        <ul>
                                          <?php foreach ($actions as $key => $value): ?>
                                            <li>
                                              <?php $repair_id = $value->servicejob_action_service_repair_id;
                                                $repair_name = ServicejobActionServiceRepair::find()->where(['id'=>$repair_id])->one();
                                                if (!empty($repair_name)) {
                                                  echo $repair_name->action;

                                                }else{
                                                  echo $repair_name = null;  echo $repair_id;
                                                }

                                              ?>
                                            </li>
                                          <?php endforeach; ?>
                                        </ul>

                                    </td>
                                  </tr>
                                  <?php $i += 1 ?>
                                <?php endforeach; ?>
                                <?php $i = 1; ?>
                              </tbody>
                            </table>

                          </div>
                        </div>
                      <?php endforeach; ?>


                  </div>
              </div>
          </div>
      </div>
   <?php endif; ?>




</div>
