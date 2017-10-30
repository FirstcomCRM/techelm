<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasks */

$this->title = 'In-process Inspection Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Project Jobs', 'url' => ['project-job/index']];
$this->params['breadcrumbs'][] = ['label'=>'View', 'url'=> Yii::$app->request->referrer];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="projectjob-ipi-tasks-create">


    <?php echo $this->render('_form', [
        'model' => $model,
        'action'=>$action,
        'dummy'=>$dummy,
    //    'defaultTasks'=>1,
    //    'projectJobId'=>$projectJobId,
    ]) ?>



</div>
