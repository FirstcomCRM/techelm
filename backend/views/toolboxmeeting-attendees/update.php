<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ToolboxmeetingAttendees */

$this->title = 'Update Toolboxmeeting Attendees: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Toolboxmeeting Attendees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="toolboxmeeting-attendees-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
