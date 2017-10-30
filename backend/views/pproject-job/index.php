<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectJob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Jobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            'project_ref',
            'customer_id',
            'start_date',
            'end_date',
            [
                'label' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createStatusFlag($model->status_flag);
                }   

            ],
            [
                'label' => 'Active',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createActiveLabel($model->active);
                }   

            ],
            // [
            //     'label'=> 'Action',
            //     'format'=> 'raw',
            //     'value'=> function($model){
            //         return '<a href="?r=projectjob-ipi%2Fcreate&project_job='.$model->id.'">IPIS</a>&nbsp;<a href="?r=projectjob-piss%2Fcreate&project_job='.$model->id.'">PISS</a>';
            //     }
            // ],
            // 'target_completion_date',
            // 'first_inspector',
            // 'second_inspector',
            // 'third_inspector',
            // 'status_flag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


