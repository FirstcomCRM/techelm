<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobComplaintFault */

$this->title = 'Create Complaint';
$this->params['breadcrumbs'][] = ['label' => 'Complaint', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-complaint-fault-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
