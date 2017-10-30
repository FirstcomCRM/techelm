<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ProjectJob;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectjobIpiTasks */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'In-process Inspection Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-ipi-tasks-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
          <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>




    <div class="panel panel-primary">
        <div class="panel-heading"><span>Inspection Tasks</span></div>
        <div class="panel-body">
          <p class="text-right">
              <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => ' btn btn-primary']) ?>
          </p>
              <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'projectjob_id',
                        'label' => 'Project Ref',
                        'format' => 'raw',
                        'value' => function($model){
                            return ProjectJob::find(['project_ref'])->where(['id'=> $model->projectjob_id])->one()['project_ref'];
                        }
                    ],
                    'serial_no',
                    'target_completion_date',
                    'corrective_actions',
                    'description',
                    'form_type',
                    [
                        'attribute'=>'status_flag',
                        'label' => 'Condition',
                        'format' => 'raw',
                        'value' => function($model){
                            return Helper::createStatusFlag($model->status_flag);
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
                      'id',
                      /*  [
                            'attribute'=>'status',
                            'label' => 'Status',
                            'format' => 'raw',
                            'value' => function($model){
                                return '<span class="label label-default">'.$model->status.'</span>';
                            }
                        ],*/
                    // 'non_conformance',
                    // 'corrective_actions',
                    // 'target_completion_date',
                    // 'status_flag',
                    // 'date_updated',


                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
