<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectJob */

$this->title = 'Update Project: ' . $model->project_ref;
$this->params['breadcrumbs'][] = ['label' => 'Project Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_ref, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-job-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
        'model3' => $model3,
        'assignment' => $assignment
    ]) ?>

</div>
