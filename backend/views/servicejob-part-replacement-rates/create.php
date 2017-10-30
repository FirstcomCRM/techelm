<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPartReplacementRates */

$this->title = 'Create Servicejob Part Replacement';
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Part Replacement Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-part-replacement-rates-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
