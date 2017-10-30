<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectjobSiteInspectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site In-process Inspection';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-site-inspection-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>


    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">List</h3>
      </div>
      <div class="panel-body">
        <p class="text-right">
            <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
              //  'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],


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

                     [
                       'attribute'=>'inspected_by',
                       'value'=>function($model){
                         return Helper::retriveUserFull($model->inspected_by);
                       },
                     ],
                     'field_type',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
      </div>
    </div>
</div>
