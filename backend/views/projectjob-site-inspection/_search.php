<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ProjectJob;
use common\models\Subcontractor;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteInspectionSearch */
/* @var $form yii\widgets\ActiveForm */
$field = [
  'EPS'=>'EPS',
  'PW'=>'PW',
];

$data = User::find()->where(['is_mobile_user'=>1])->orderBy(['fullname'=>SORT_ASC])->all();
$eng = ArrayHelper::map($data,'id','fullname');

$data = Subcontractor::find()->all();
$subcon = ArrayHelper::map($data,'id','subcontractor');

$data = ProjectJob::find()->where(['active'=>1])->all();
$proj_ref = ArrayHelper::map($data,'id','project_ref');

?>

<div class="projectjob-site-inspection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-4">
        <?php echo $form->field($model,'subcontractor')->dropDownList($subcon,['prompt'=>'Select Sub-Contractor'])->label(false) ?>

      </div>
      <div class="col-md-4">
        <?php echo $form->field($model,'inspected_by')->dropDownList($eng,['prompt'=>'Select Engineer'])->label(false) ?>

      </div>
      <div class="col-md-4">
      </div>
    </div>

    <?php $form->field($model, 'date_inspection') ?>
    <?php // echo $form->field($model, 'field_type') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
      <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
