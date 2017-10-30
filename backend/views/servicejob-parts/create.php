<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobParts */

$this->title = 'Add Parts';
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-parts-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
