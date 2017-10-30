<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Toolboxmeeting */

$this->title = 'Create Toolboxmeeting';
$this->params['breadcrumbs'][] = ['label' => 'Toolboxmeetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toolboxmeeting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
