<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ServicejobCategories;
/* @var $this yii\web\View */
/* @var $model common\models\ServicejobComplaintFault */

$this->title = $model->complaint;
$this->params['breadcrumbs'][] = ['label' => 'Complaint', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-complaint-fault-view">

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
                'label'=>'Complaint Category',
                'value'=> $model->servicejob_category_id ? ServicejobCategories::dataCategories()[$model->servicejob_category_id] : '',
            ],
            'complaint',

        ],
    ]) ?>

</div>
