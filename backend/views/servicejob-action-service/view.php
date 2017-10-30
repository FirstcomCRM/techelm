<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ServicejobCategories;
/* @var $this yii\web\View */
/* @var $model common\models\ServicejobActionServiceRepair */

$this->title = $model->action;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Action Service Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-action-service-repair-view">

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
            [
              'attribute'=>'servicejob_category_id',
              'value'=> function($model){
                $data = ServicejobCategories::find()->select('category')->where(['id'=>$model->servicejob_category_id])->one();
                return $data->category;
              }
            ],
            'action',
            'date_created',

        ],
    ]) ?>

</div>
