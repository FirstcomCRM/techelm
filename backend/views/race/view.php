<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $model common\models\Race */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Race', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-view">

    <p class="text-right">
        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['update', 'id' => $model->race_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', ['delete', 'id' => $model->race_id], [
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
          //  'race_id',
            'Name',
          //  'active',
            [
              'label'=> 'Status',
              'format'=> 'raw',
              'value' => function($model){
                  return Helper::createActiveLabel($model->active);
              }
            ]
        ],
    ]) ?>

</div>
