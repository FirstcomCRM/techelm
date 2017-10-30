<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobPiss */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projectjob Pisses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-piss-view">

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
            'car_park_code',
            'property_officer',
            'tc_lew',
            'property_officer_telNo',
            'property_officer_mobileNo',
            'property_officer_branch',
            'tc_lew_telNo',
            'tc_lew_mobileNo',
            'tc_lew_email:email',
            'remarks:ntext',
            'date_site_walk',
        ],
    ]) ?>

</div>
