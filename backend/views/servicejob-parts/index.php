<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Service;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejobParts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-parts-index">

  <div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">
      <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
  </div>


    <div class="panel panel-primary">
        <div class="panel-heading"><span><?= Html::encode($this->title) ?></span></div>
        <div class="panel-body">
          <p class="text-right">
              <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add Parts', ['create'], ['class' => 'btn btn-primary']) ?>
          </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
            //    'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                      'id',
                    /*  [
                      'attribute'=>'servicejob_id',
                      'label'=> 'Service Job',
                      'value'=>function ($model){

                          return Helper::retriveService($model->servicejob_id);

                      },
                    ],*/
                    'servicejob_id',
                    'parts_name:ntext',
                    'quantity:ntext',

                    [
                      'attribute'=>'unit_price',
                      'label'=> 'Unit Price',
                      'value'=> function($model){
                        return number_format($model->unit_price,2);
                      },
                    ],
                     [
                       'attribute'=>'total_price',
                       'label'=> 'Total Price',
                       'value'=> function($model){
                         return number_format($model->total_price,2);
                       },
                     ],

                    [
                      'attribute'=>'date_added',
                      'label'=> 'Date',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
