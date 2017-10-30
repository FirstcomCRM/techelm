<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $model common\models\Toolboxmeeting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Toolboxmeetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toolboxmeeting-view">

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
            'meeting_image',
            'meeting_details',
            'conducted_by',
            'designation',
            'signature',
            [
                'label' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createStatusFlag($model->status_flag_tm);
                }
            ]
        ],
    ]) ?>

</div>
