<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasksAction */

$this->title = 'Update Tasks Action: ' . $model->task_action;
$this->params['breadcrumbs'][] = ['label' => 'Projectjob Ipi Tasks Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_action, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projectjob-ipi-tasks-action-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
