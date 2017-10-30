<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
use common\models\ProjectJob;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchToolboxmeeting */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meetings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toolboxmeeting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'projectjob_id',
            [
                'label' => 'Project Ref',
                'format' => 'raw',
                'value' => function($model){
                    return ProjectJob::find(['project_ref'])->where(['id'=> $model->projectjob_id])->one()['project_ref'];
                }
            ],
            [
                'label' => 'Meeting Image',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createImage($model->meeting_image);
                }
            ],
            'meeting_details',
            'conducted_by',
            // 'designation',
            // 'month',
            // 'signature',
            // 'status_flag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
