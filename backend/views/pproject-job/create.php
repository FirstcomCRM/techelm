<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectJob */

$this->title = 'Create Project Job';
$this->params['breadcrumbs'][] = ['label' => 'Project Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-job-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
        'model3' => $model3,
        'assignment' => $assignment
    ]) ?>

</div>
