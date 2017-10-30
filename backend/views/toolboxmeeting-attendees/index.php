<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ProjectJob;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchToolboxmeetingAttendees */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Toolboxmeeting Attendees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toolboxmeeting-attendees-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading"><span><?= Html::encode($this->title) ?></span></div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    'id',
                    // 'projectjob_id',
                    [
                        'label' => 'Project Ref',
                        'format' => 'raw',
                        'value' => function($model){
                            return ProjectJob::find(['project_ref'])->where(['id'=> $model->projectjob_id])->one()['project_ref'];
                        }
                    ],
                    'employee_code',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
