<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Helper;
use common\models\Service;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->fullname;
//$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#customer-profile" >Customer Profile</a></li>
      <li><a data-toggle="tab" href="#service-job">Service Job History</a></li>
      <li><a data-toggle="tab" href="#project-job">Project Job History</a></li>
    </ul>

    <div class="tab-content"> <!---start of tab-content for the nav-tabs--->
     <div class="tab-pane fade in active" id="customer-profile"><br><!---Start of customer profile tab--->
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

                'fullname',
                'person_in_charge',
                'job_site:ntext',
                'address:ntext',
                'email:email',
                'email_2:email',
                'contact_no',
                'phone_no',
                'fax',
                'race',
                [
                    'attribute'=>'status',
                    'label' => 'Status',
                    'format' => 'raw',
                    'value' => function($model){
                        return Helper::createActiveLabel($model->status);
                    }
                ],
            ],
        ]) ?>
      </div><!---end of customer profile tab--->
      <div class="tab-pane fade" id="service-job"><br> <!---Start of service job tab--->
        <div class="table-responsive"><!---start of table responsive for service job--->
          <div class="panel panel-primary"><!---start of panel--->
            <div class="panel-heading">
              <h3 class="panel-title">Serivce Job History</h3>
            </div>
            <div class="panel-body"><!---start of panel body--->
              <?php Pjax::begin(); ?>
              <?php echo GridView::widget([
                'dataProvider'=>  $dataProvider,
                'columns'=>[
                      ['class' => 'yii\grid\SerialColumn'],
                //    'id',
                    'service_no',
                    [
                      'attribute'=>'service_id',
                      'value'=>function($model){
                        return Helper::retriveService($model->service_id);

                      },
                    ],

                    [
                      'attribute'=>'engineer_id',
                      'value'=>function($model){
                        return Helper::retriveUserFull($model->engineer_id);
                      }
                    ],
                    'serial_no',
              //      'equipment_type',
                    [
                      'attribute'=>'status',
                      'format'=>'raw',
                      'value'=>function($model){
                          return Helper::createStatusFlag($model->status);
                      }
                    ],
                    [
                      'header'=>'Action',
                      'class'=>'yii\grid\ActionColumn',
                      'template'=>'{view}',
                      'buttons'=>[
                        'view'=>function($url,$model){
                          return Html::a('<i class="fa fa-eye" aria-hidden="true"></i> ',$url,['id'=>$model->id, 'title'=>Yii::t('app','View'), 'data-pjax'=>0]);
                        },

                      ],
                      'urlCreator'=>function($action,$model,$key,$index){
                        if($action==='view'){
                          $url='?r=servicejob%2Fc-view&id='.$model->id;
                          return $url;
                        }
                        if($action==='update'){
                          $url='?r=servicejob%2Fupdate&id='.$model->id;
                          return $url;
                        }

                      }
                    ],
                  ],
                ]) ?>
              <?php Pjax::end(); ?>
            </div><!---end of panel body--->
          </div><!---end of panel--->
        </div>  <!---end of table responsive for service job--->
      </div><!---end of service job tab--->

      <div class="tab-pane fade" id="project-job"><br> <!---Start of project job tab--->
        <div class="panel panel-primary"> <!---start of panel--->
          <div class="panel-heading">
            <h3 class="panel-title">Project Job History</h3>
          </div>
          <div class="panel-body table-responsive"><!---start of panel-body--->
            <?php Pjax::begin(); ?>
              <?php echo GridView::widget([
                  'dataProvider'=>$projectjob,
                  'columns'=>[
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'project_ref',
                    'start_date',
                    [
                        'attribute'=>'status_flag',
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($model){
                            return Helper::projectStatusFlag($model->status_flag);
                        }

                    ],
                    [
                        'attribute'=>'active',
                        'label' => 'Active',
                        'format' => 'raw',
                        'value' => function($model){
                            return Helper::createActiveLabel($model->active);
                        }
                    ],
                    [
                      'header'=>'Action',
                      'headerOptions'=>['width'=>100],
                      'class'=>'yii\grid\ActionColumn',
                      'template'=>'{view}{update}',
                      'buttons'=>[
                          'view'=>function($url,$model){
                            return Html::a('<i class="fa fa-eye" aria-hidden="true"></i> ',$url,['id'=>$model->id, 'title'=>Yii::t('app','View'), 'data-pjax'=>0]);
                          },
                          'update'=>function($url,$model){
                              return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ',$url,['id'=>$model->id, 'title'=>Yii::t('app','Update'), 'data-pjax'=>0]);
                          },
                      ],
                      'urlCreator'=>function($action,$model,$key,$index){
                        if($action==='view'){
                          $url ='?r=project-job%2Fview&id='.$model->id;
                          return $url;
                        }
                        if($action==='update'){
                          $url ='?r=project-job%2Fupdate&id='.$model->id;

                          return $url;
                        }
                      }
                    ],


                  ],
              ]) ?>
            <?php Pjax::end(); ?>
          </div><!---end of panel-body--->
        </div><!---end of panel--->
      </div><!---end of project job tab--->
    </div><!---end of tab-content for the nav-tabs--->







</div>
