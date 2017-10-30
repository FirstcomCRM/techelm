<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ProjectJob;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectjobPissTasks */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pre-installation Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-piss-tasks-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
        <p class="text-right">
            <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            //    'projectjob_id',
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
                [
                    'attribute'=>'status',
                    'label' => 'Active',
                    'format' => 'raw',
                    'value' => function($model){
                        return Helper::createActiveLabel($model->active);
                    }
                ],
                [
                    'label' => 'Drawing Before',
                    'format' => 'raw',
                    'value' => function($model){
                        return Helper::createLocalImage($model->drawing_before);
                    }
                ],
                [
                    'label' => 'Drawing After',
                    'format' => 'raw',
                    'value' => function($model){
                        return Helper::createImage($model->drawing_after);
                    }
                ],
                  ['class' => 'yii\grid\ActionColumn'],
                    //  'conformance',
            //      'id',
                // 'projectjob_id',

                // 'comments',
                // 'status',
                // 'drawing_before',
                //'drawing_after',
                // 'date_updated',


            ],
        ]); ?>
      </div>
    </div>

</div>
