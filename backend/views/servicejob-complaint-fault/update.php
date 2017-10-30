<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobComplaintFault */

$this->title = 'Update Complaint: ' . $model->complaint;
$this->params['breadcrumbs'][] = ['label' => 'Complaint', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->complaint, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-complaint-fault-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
