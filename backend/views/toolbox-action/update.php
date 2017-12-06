<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ToolboxActions */

$this->title = 'Update Toolbox Actions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Toolbox Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="toolbox-actions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
