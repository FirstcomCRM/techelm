<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobPissTasks */

$this->title = 'Update Pre-installation Task: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pre-installation Tasks', 'url' => ['project-job/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['project-job/view', 'id' => $model->projectjob_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projectjob-piss-tasks-update">

    <?= $this->render('update_form', [
        'model' => $model,
    ]) ?>

</div>
