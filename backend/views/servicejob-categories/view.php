<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobCategories */

$this->title = $model->category;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-categories-view">

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
      //      'id',
            'category',
            'date_created',
          //  'active',
        ],
    ]) ?>

</div>
