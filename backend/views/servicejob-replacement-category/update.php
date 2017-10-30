<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobReplacementCategory */

$this->title = 'Update Service Job Replacement Category: ' . $model->category;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Replacement Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-replacement-category-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
