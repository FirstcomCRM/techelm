<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\ServicejobReplacementCategory;
/* @var $this yii\web\View */
/* @var $model common\models\SearchServicejobPartReplacementRates */
/* @var $form yii\widgets\ActiveForm */

$data = ServicejobReplacementCategory::find()->orderBy(['category'=>SORT_ASC])->all();
$cat = ArrayHelper::map($data,'category','category');
$data = null;

?>

<div class="servicejob-part-replacement-rates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


        <?php echo $form->field($model,'category')->widget(Select2::className(),[
            'data'=>$cat,
            'options'=>['placeholder'=>'Select Category'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>

    <?= $form->field($model, 'parts_name') ?>

    <?php $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
