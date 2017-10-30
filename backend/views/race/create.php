<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Race */

$this->title = 'Create Race';
$this->params['breadcrumbs'][] = ['label' => 'Race', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
