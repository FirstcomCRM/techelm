<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobCategories */

$this->title = 'Update Servicejob Categories: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-categories-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
