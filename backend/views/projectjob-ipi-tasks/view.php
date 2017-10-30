<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ProjectJob;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasks */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Project Job Ipi Tasks', 'url' => ['project-job/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-ipi-tasks-view">

    <p class="text-right">
          <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'projectjob_id',
                'label' => 'Project Ref',
                'format' => 'raw',
                'value' => function($model){
                    return ProjectJob::find(['project_ref'])->where(['id'=> $model->projectjob_id])->one()['project_ref'];
                }
            ],
            'serial_no',
            'description',
            'corrective_actions',
            'target_completion_date',
            [
                'label' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createStatusFlag($model->status_flag);
                }
            ],
            'form_type',
            'status',
              //  'non_conformance',
            //  'projectjob_id',
          //  'date_updated',

                //  'id',
        ],
    ]) ?>

</div>
