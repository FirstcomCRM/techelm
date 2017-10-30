<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobParts */

$this->title = 'Update Parts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parts_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-parts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
