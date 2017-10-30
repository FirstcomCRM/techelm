<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subcontractor */

$this->title = 'Update Subcontractor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sub-Contractor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subcontractor, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcontractor-update">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
