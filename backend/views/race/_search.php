<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Race;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\SearchRace */
/* @var $form yii\widgets\ActiveForm */
$race = Race::find()->orderBy(['Name'=>SORT_ASC])->all();
$grouprace = ArrayHelper::map($race,'Name','Name');
?>

<div class="race-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'race_id') ?>
    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'Name')->label(false)->widget(Select2::className(),[
                'data'=>$grouprace,
                'options'=>['placeholder'=>'Nationality'],
                'theme'=> Select2::THEME_BOOTSTRAP,
                'size'=> Select2::MEDIUM,
                'pluginOptions' => [
                  'allowClear' => true
                ],
              ]) ?>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('<i class="fa fa-undo" aria-hidden="true"></i> Reset', ['class' => 'btn btn-primary']) ?>
        </div>
      </div>
    </div>


    <?php // $form->field($model, 'active') ?>



    <?php ActiveForm::end(); ?>

</div>
