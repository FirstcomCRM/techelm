<?php

/* @var $this yii\web\View */
use common\models\ProjectjobPiss;
use common\models\Servicejob;
use common\components\Helper;
use common\models\ProjectJob;
use common\models\User;
use common\models\Customer;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$dataProject = ProjectjobPiss::find()->where(['active' => 1])->all();
// unsigned servicejob
$dataService = Servicejob::find()->limit(10)->orderBy(['id'=>SORT_DESC])->all();
$CountUser = User::find()->count();
$CountServiceJob = Servicejob::find()->where(['status'=> 1])->count();
$CountCustomers = Customer::find()->count();
$CountProjectjob = ProjectJob::find()->count();

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="site-index">

<div class=" row">

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountUser; ?> members." class="well top-block" href="?r=user">
            <i class="glyphicon glyphicon-user blue"></i>
            <div>User List</div>
            <!-- <div>507</div> -->
            <span class="notification"><?php echo $CountUser; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountCustomers; ?> customers" class="well top-block" href="?r=customer">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Customer List</div>
            <!-- <div>228</div> -->
            <span class="notification green"><?php echo $CountCustomers; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountProjectjob; ?> Project Jobs" class="well top-block" href="?r=project-job">
            <i class="glyphicon glyphicon-envelope red"></i>
            <div>Project Job</div>
            <!-- <div>25</div> -->
            <span class="notification red"><?php echo $CountProjectjob; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $CountServiceJob . " Unsigned Services"; ?>" class="well top-block" href="?r=servicejob%2Findex&SearchServicejob%5Bstatus%5D=1";>
            <i class="glyphicon glyphicon-star green"></i>
            <div>Unsigned Service</div>
            <span class="notification red"><?php echo $CountServiceJob; ?></span>
        </a>
    </div>

</div>


<div class="row">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-map"></i> Project List (Pre-Installation)</h2>
            </div>

            <div class="box-content row">
                <div class="col-lg-12 col-md-12">

                  <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                          'dataProvider' => $projectJob,
                          //'filterModel' => $searchModel,
                          'columns' => [
                              ['class' => 'yii\grid\SerialColumn'],

                              [
                                'attribute'=>'project_ref',
                                'format'=>'raw',
                                'value'=>function($model){
                                  return Html::a($model->project_ref,['project-job/view', 'id'=>$model->id]);
                                },
                              ],
                              [
                                'attribute'=>'customer_id',
                                'value'=>function($model){
                                  return Helper::retrieveCustomer($model->customer_id);
                                },
                              ],
                              'start_date',
                              [
                                'attribute'=>'status_flag',
                                'label'=>'Status',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return Helper::projectStatusFlag($model->status_flag);
                                },
                              ],
                          ],
                      ]); ?>
                  <?php Pjax::end(); ?>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-battery"></i> Service List</h2>

            </div>

            <div class="box-content row">
                <div class="col-lg-12 col-md-12">
                  <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                      <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                              [
                                'attribute'=>'service_no',
                                'format'=>'raw',
                                'value'=>function($model){
                                  return Html::a($model->service_no,['servicejob/view','id'=>$model->id],
                                    ['title'=>'Site Address: '.$model->remarks ,'data-toggle'=>'tooltip', 'data-placement'=>'right']
                                  );

                                },
                              ],
                              'service_date',
                              [
                                'attribute'=>'customer_id',
                                'value'=>function($model){
                                  return Helper::retrieveCustomer($model->customer_id);
                                },
                              ],
                              [
                                'attribute'=>'engineer_id',
                                'value'=>function($model){
                                  return Helper::retriveUserFull($model->engineer_id);
                                },
                              ],
                              'remarks:ntext',
                              [
                                'attribute'=>'status',
                                'format'=>'raw',
                                'value'=>function($model){
                                  return Helper::createStatusFlag($model->status);
                                },
                              ],
                            ],
                        ]); ?>
                    <?php Pjax::end(); ?>
                  </div>


                </div>

            </div>
        </div>
    </div>

</div>

</div>
