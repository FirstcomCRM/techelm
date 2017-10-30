<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
  </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel panel-heading"><span>Services</span></div>
                <div class="panel-body">
                  <p class="text-right">
                      <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Create', ['create'], ['class' => 'btn btn-primary']) ?>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'service_name',
                            'description:ntext',
                            [
                              'attribute'=>'default_unit_price',
                              'value' => function($model){
                                  return number_format($model->default_unit_price,2);
                              },
                            ],
                            [
                                'label' => 'Status',
                                'format' => 'raw',
                                'value' => function($model){
                                    $isActive = $model->active == 1 ? "Active": "Inactive";
                                    $class = $model->active == 1 ? "label label-success": "label label-warning";
                                    return '<span class="'.$class.'">'.$isActive.'</span>';
                                }

                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>
