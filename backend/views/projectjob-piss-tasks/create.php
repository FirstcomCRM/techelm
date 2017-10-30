<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobPissTasks */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Pre-installation Tasks', 'url' => ['project-job/index']];
$this->params['breadcrumbs'][] = ['label'=>'View', 'url'=> Yii::$app->request->referrer];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-piss-tasks-create">



    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
