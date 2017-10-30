<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ToolboxmeetingAttendees */

$this->title = 'Create Toolboxmeeting Attendees';
$this->params['breadcrumbs'][] = ['label' => 'Toolboxmeeting Attendees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toolboxmeeting-attendees-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
