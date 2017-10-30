<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPrices */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-prices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'servicejob_id',
            'replacement_parts',
            'quantity',
            'unit_price',
        ],
    ]) ?>

</div>
