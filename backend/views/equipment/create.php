<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Equipments */

$this->title = 'Create Equipment';
$this->params['breadcrumbs'][] = ['label' => 'Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
