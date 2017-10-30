<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteInspection */

$this->title = 'Site In-process Inspection';
$this->params['breadcrumbs'][] = ['label' => 'Site In-process Inspection', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-site-inspection-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
