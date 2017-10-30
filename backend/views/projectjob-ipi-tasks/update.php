<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasks */

$this->title = 'Update Projectjob Ipi Tasks: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Project Job Ipi Tasks', 'url' => ['project-job/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['project-job/view', 'id' => $model->projectjob_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projectjob-ipi-tasks-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'action'=>$action,
        //'dummy'=>$dummy,
    ]) ?>

</div>
