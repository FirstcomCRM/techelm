<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\ServicejobCategories;

/* @var $this yii\web\View */
/* @var $model common\models\SearchServicejobCategories */
/* @var $form yii\widgets\ActiveForm */

$data = ServicejobCategories::find()->all();
$serv = ArrayHelper::map($data,'category','category');
asort($serv);
?>

<div class="servicejob-categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'category')->label(false)->widget(Select2::className(),[
                'data'=>$serv,
                'options'=>['placeholder'=>'Select Category'],
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
            <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
