<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projectjob Ipis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-ipi-view">

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
            'projectjob_id',
            'sub_contractor',
            'disposition_by',
            'sub_c_signature:ntext',
            'dispo_by_siganture:ntext',
            'sub_c_date',
            'dispo_by_date',
            'date_inspected',
            'form_type',
        ],
    ]) ?>

</div>
