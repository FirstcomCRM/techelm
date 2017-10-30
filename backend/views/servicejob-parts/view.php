<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Service;
use yii\helpers\ArrayHelper;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $model common\models\ServicejobParts */

$this->title = $model->parts_name;
$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-parts-view">

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

    <div class="panel panel-primary">
        <div class="panel-heading"><span>Parts</span></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                  'id',
                  'servicejob_id',
                  /*  [
                      'attribute'=>'servicejob_id',
                      'label'=> 'Service Job',
                      'value'=>function ($model){
                          return Helper::retriveService($model->servicejob_id);
                        }
                    ],*/
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
                    'date_added',
                ],
            ]) ?>
        </div>
    </div>


</div>
