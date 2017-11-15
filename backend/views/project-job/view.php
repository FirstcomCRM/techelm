<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Helper;
use common\models\User;
use common\models\Customer;
use common\models\Subcontractor;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectJob */
$this->title = $model->project_ref;
$this->params['breadcrumbs'][] = ['label' => 'Project Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($ProjectJobIpiTask);
?>
<div class="project-job-view">

    <p class="text-right">
        <?php if ($model->locked_to_user != 0): ?>
          <?= Html::a('<i class="fa fa-unlock-alt" aria-hidden="true"></i> Unlock Job', ['unlock','id'=>$model->id], ['class' => 'btn btn-warning']) ?>
        <?php endif; ?>
        <?php Html::a('<i class="fa fa-unlock-alt" aria-hidden="true"></i> Mobile Email', ['mobile-email','id'=>$model->id], ['class' => 'btn btn-warning']) ?>

        <?php Html::a('<i class="fa fa-mobile" aria-hidden="true"></i> PDF FILE', ['projectjob-pdf','id'=>$model->id], ['class' => 'btn btn-warning']) ?>
        <?php Html::a('<i class="fa fa-mobile" aria-hidden="true"></i> Mobile Page', ['mobile-page','id'=>$model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fa fa-mobile" aria-hidden="true"></i> Site Walk PDF', ['site-walk','id'=>$model->id], ['class' => 'btn btn-success']) ?>
        <?php Html::a('<i class="fa fa-archive" aria-hidden="true"></i> Add Pre-installation Task', ['projectjob-piss-tasks/create','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-book" aria-hidden="true"></i> Add Inspection Task', ['projectjob-ipi-tasks/create', 'id'=>$model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Job', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete Job', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Project Job</span>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'project_ref',

                    [
                      'attribute'=>'customer_id',
                      'label'=>'Customer',
                      'value'=>function ($model){
                        $customer = Customer::find()->select('fullname')->where(['id'=>$model->customer_id])->one();
                        return $customer->fullname;
                      },
                    ],
                    'start_date',
                    [
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($model){
                            return Helper::projectStatusFlag($model->status_flag);
                        },
                    ],
                    [
                      'attribute'=>'locked_to_user',
                      'value'=>function($model){
                        $user = User::find()->where(['id'=>$model->locked_to_user])->one();
                        if (!empty($user) || $user != 0) {
                          return $user->fullname;
                        }else{
                          return 'N/A';
                        }
                      },
                    ],

                ],
            ]) ?>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Pre Installation</span>
        </div>
        <div class="panel-body">
            <?php echo GridView::widget([
            //    'dataProvider'=> $PissJoinTask,
              'dataProvider'=>$piss,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    // 'projectjob_id',
                    'car_park_code',
                    'property_officer',
                    'tc_lew',
                    'tc_lew_mobileNo'
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Site Inspection</span>
        </div>
        <div class="panel-body">
            <?php echo GridView::widget([
                'dataProvider'=> $ProjectJobIpiData,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    // 'projectjob_id',
                    // 'sub_contractor',
                    [
                        'label' => 'Sub-Contractor',
                        'format' => 'raw',
                        'value' => function($model){
                            //return User::find()->select('fullname')->where(['id' => $model->sub_contractor])->one()['fullname'];
                            $subcon = Subcontractor::find()->where(['id'=>$model->sub_contractor])->one();
                            if (!empty($subcon)) {
                                return $subcon->subcontractor;
                            }else{
                              return $subcon = null;
                            }
                        },
                    ],

                    'form_type'
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"><span>Engineers</span></div>
        <div class="panel-body">
            <?php echo GridView::widget([
                'dataProvider'=> $engineers,
                'columns' => [
              //  'id',
                    [
                        'label' => 'Full Name',
                        'format'=> 'raw',
                        'value' => function($model){
                            return User::find()->select(['fullname'])->where(['id'=> $model->engineer_id])->one()['fullname'];
                        }
                    ],
                    [
                        'label' => 'Email',
                        'format'=> 'raw',
                        'value' => function($model){
                            return User::find()->select(['email'])->where(['id'=> $model->engineer_id])->one()['email'];
                        }
                    ],
                    //'date_created'
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">In Process Inspection Tasks</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <?php Pjax::begin(); ?>
          <?php
              echo GridView::widget([
                'dataProvider'=>$ProjectJobIpiTask,
                'columns'=>[
                  ['class' => 'yii\grid\SerialColumn'],
                //  'id',
                //  'projectjob_id',
                  'serial_no',
                  'target_completion_date',
                  'description',
              //    [
              //      'attribute'=>'description',
              //      'value'=>function($model){
              //        return Helper::getDescription($model->description);
              //      }
                //  ],
                  'corrective_actions',
                  'form_type',
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
                      'header'=>'Actions',
                      'class'=>'yii\grid\ActionColumn',
                      'template'=>'{view} {update} {delete}',
                      'buttons'=>[
                        'view'=>function($url,$model){
                          return Html::a(' <i class="fa fa-eye fa-lg" aria-hidden="true"></i>', $url, ['id' => $model->id, 'title' => Yii::t('app', 'View'),'data-pjax'=>0,
                          ]);
                        },
                        'update'=>function($url,$model){
                          return Html::a(' <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$url,['id'=>$model->id, 'title'=>Yii::t('app','Update'),'data-pjax'=>0,
                          ]);
                        },
                        'delete'=>function($url,$model){
                          return Html::a(' <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>',$url,['onclick' => 'return deleteConfirmation()', 'id'=>$model->id,'title'=>Yii::t('app','Delete'),
                          'data-pjax'=>0,
                          ]);
                        },
                      ],
                      'urlCreator'=> function($action,$model,$key,$index){
                        if ($action ==='view'){
                          $url = '?r=projectjob-ipi-tasks%2Fview&id='.$model->id;
                          return $url;
                        }
                        if ($action==='update') {
                          $url = '?r=projectjob-ipi-tasks%2Fupdate&id='.$model->id;
                          return $url;
                        }
                        if ($action ==='delete'){
                          $url = '?r=projectjob-ipi-tasks%2Fdelete&id='.$model->id;
                          return $url;
                        }
                      }

                  ],
                ],
              ]);
          ?>
          <?php Pjax::end(); ?>
        </div>

      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Pre-installation tasks</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <?php Pjax::begin(); ?>
          <?php echo GridView::widget([
              'dataProvider'=>$ProjectJobPissTask,
              'columns'=>[
                  ['class' => 'yii\grid\SerialColumn'],
                'serial_no',
                'description',

                [
                  'label'=>'Drawing Before',
                  'format'=>'raw',
                  'value' => function($model){
                    if (!empty($model->drawing_before)) {
                      $path = Yii::getAlias('@api-signature').$model->drawing_before;
                      return '<a href="'.$path.'" data-pjax=0><img style="width:50px;" src="'.$path.'"></a>';
                  }
                  },
                ],
              //  'drawing_after',
                [
                  'label'=>'Drawing After',
                  'format'=>'raw',
                  'value' => function($model){
                    //  return Helper::createLocalImage($model->drawing_after);
                    // return Helper::createApiDrawing($model->drawing_after);
                    if (!empty($model->drawing_after)) {
                        $path = Yii::getAlias('@api-signature').$model->drawing_after;
                      	return '<a href="'.$path.'" data-pjax=0><img style="width:50px;" src="'.$path.'"></a>';
                    }
                  },
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
                  'attribute'=>'status',
                  'format'=>'raw',
                  'value' => function($model){
                      return Helper::projectStatusFlag($model->status);
                  }
                ],
                'date_updated',
                [
                  'header'=>'Actions',
                  'class'=>'yii\grid\ActionColumn',
                  'template'=>'{view} {update} {delete}',
                  'buttons'=>[
                    'view'=>function($url,$model){
                      return Html::a(' <i class="fa fa-eye fa-lg" aria-hidden="true"></i>',$url,['id'=>$model->id, 'title'=>Yii::t('app','View'),'data-pjax'=>0
                      ]);
                    },
                    'update'=>function($url,$model){
                      return Html::a(' <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$url,['id'=>$model->id,'title'=>Yii::t('app','Update'),'data-pjax'=>0
                      ]);
                    },
                    'delete'=>function($url, $model){
                      return Html::a(' <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>',$url,['id'=>$model->id, 'onclick'=>'return deleteConfirmation()' ,'title'=>Yii::t('app','Delete'),
                      'data-pjax'=>0
                      ]);
                    },
                    //insert button code
                  ],
                  'urlCreator'=>function($action,$model,$key,$index){
                    if ($action ==='view') {
                      $url = '?r=projectjob-piss-tasks%2Fview&id='.$model->id;
                      return $url;
                    }
                    if ($action==='update') {
                      $url ='?r=projectjob-piss-tasks%2Fupdate&id='.$model->id;
                      return $url;
                    }
                    if ($action ==='delete') {
                      $url = '?r=projectjob-piss-tasks%2Fdelete&id='.$model->id;
                      return $url;
                    }
                  },
                ],
              ],
          ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>

    </div>
</div>
