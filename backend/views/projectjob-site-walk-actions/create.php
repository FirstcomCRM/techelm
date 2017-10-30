<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteWalkActions */

$this->title = 'Create Projectjob Site Walk Actions';
$this->params['breadcrumbs'][] = ['label' => 'Projectjob Site Walk Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-site-walk-actions-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
