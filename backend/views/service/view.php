<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title = $model->service_name;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-view">

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
            'created_at',
      
        ],
    ]) ?>

</div>
