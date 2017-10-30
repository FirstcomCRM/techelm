<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteInspection */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Site In-process Inspection', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-site-inspection-view">

    <p class="text-right">
        <?= Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Site Inspection PDF', ['inspection-pdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

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
              'attribute'=>'project_ref',
              'value'=>function($model){
                return Helper::retrieveCustomer($model->project_ref);
              },
            ],
            [
              'attribute'=>'subcontractor',
              'value'=>function($model){
                return Helper::retrieveSubCon($model->subcontractor);
              },
            ],
            'date_inspection',
            'work_completion_start_date',
            'work_completion_end_date',
            [
              'attribute'=>'inspected_by',
              'value'=>function($model){
                return Helper::retriveUserFull($model->inspected_by);
              },
            ],
            'field_type',
            'project_site:ntext',
            'date_created',
        ],
    ]) ?>

</div>
