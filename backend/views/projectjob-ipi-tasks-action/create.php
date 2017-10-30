<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasksAction */

$this->title = 'Create Task Action';
$this->params['breadcrumbs'][] = ['label' => 'Projectjob Ipi Tasks Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-ipi-tasks-action-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
