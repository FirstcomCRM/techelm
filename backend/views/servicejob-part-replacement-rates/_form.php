<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\ServicejobReplacementCategory;
/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPartReplacementRates */
/* @var $form yii\widgets\ActiveForm */

$data = ServicejobReplacementCategory::find()->orderBy(['category'=>SORT_ASC])->all();
$cat = ArrayHelper::map($data,'category','category');
$data = null;
?>

<div class="servicejob-part-replacement-rates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model,'category')->widget(Select2::className(),[
        'data'=>$cat,
        'options'=>['placeholder'=>'Select Category'],
        'theme'=> Select2::THEME_BOOTSTRAP,
        'size'=> Select2::MEDIUM,
        'pluginOptions' => [
          'allowClear' => true
        ],
      ]) ?>

    <?= $form->field($model, 'parts_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
