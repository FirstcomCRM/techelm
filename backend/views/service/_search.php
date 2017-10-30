<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Service;
/* @var $this yii\web\View */
/* @var $model common\models\SearchService */
/* @var $form yii\widgets\ActiveForm */

$data = Service::find()->select('service_name')->all();
$serv = ArrayHelper::map($data,'service_name','service_name');
asort($serv);
$data = null;
?>

<div class="service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'service_name')->label(false)->widget(Select2::className(),[
            'data'=>$serv,
            'options'=>['placeholder'=>'Service Name'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
        <?php $form->field($model, 'service_name')->label(false)->textInput(['placeholder'=>'Service Name']) ?>
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
