<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Equipments;
/* @var $this yii\web\View */
/* @var $model common\models\SearchEquipments */
/* @var $form yii\widgets\ActiveForm */

$data = Equipments::find()->select(['equipment_code'])->where(['active'=>1])->orderBy(['equipment_code'=>SORT_ASC])->all();
$equip = ArrayHelper::map($data,'equipment_code','equipment_code');
$data = null;
?>

<div class="equipments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'equipment_code')->label(false)->widget(Select2::className(),[
          'data'=>$equip,
          'options'=>['placeholder'=>'Equipment Code'],
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
