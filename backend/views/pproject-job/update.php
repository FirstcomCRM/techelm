<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectJob */

$this->title = 'Update Project: ' . $model->project_ref;
$this->params['breadcrumbs'][] = ['label' => 'Project Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-job-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
        'model3' => $model3,
        'assignment' => $assignment
    ]) ?>

</div>
 	