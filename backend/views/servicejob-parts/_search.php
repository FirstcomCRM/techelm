<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\Service;
use common\models\ServicejobParts;
/* @var $this yii\web\View */
/* @var $model common\models\SearchServicejobParts */
/* @var $form yii\widgets\ActiveForm */

//$data = Service::find()->all();
$data = Service::find()->select(['id','service_name'])->all();
$service = Arrayhelper::map($data,'id','service_name');
asort($service);

$data = ServicejobParts::find()->select(['parts_name'])->all();
$parts = ArrayHelper::map($data,'parts_name','parts_name');
asort($parts);
//print_r($service);
?>

<div class="servicejob-parts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'servicejob_id')->label(false)->widget(Select2::className(),[
            'data'=>$service,
            'options'=>['placeholder'=>'Service Job'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'parts_name')->label(false)->widget(Select2::className(),[
            'data'=>$parts,
            'options'=>['placeholder'=>'Parts'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
        <?php $form->field($model, 'parts_name')->textInput(['placeholder'=>'Parts Name'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
