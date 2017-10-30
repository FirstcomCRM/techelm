<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\Tasks;

$dataTask = Tasks::find()->where(['status' => 1])->all();
$projectjob_ids = ArrayHelper::map(ProjectJob::find()->where(['status' => 1])->all(),'id', 'project_ref');
/* @var $this yii\web\View */
/* @var $model common\models\ProjectPii */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-pii-form">

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="form-label-container">
            <span class="form-label"><li class="fa fa-edit"></li> Project Information.</span>
        </div>
        <br/>
    </div>

    <div class="row">
        
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="formLabel"><i class="fa fa-qrcode"></i> Project Reference</label>
                    <?= $form->field($model, 'project_reference')->textInput(['class' => 'inputForm form-control readonlyForm', 'value' => $projectreferenceCode, 'id' => 'projectreferenceCode', 'readonly' => 'readonly' ])->label(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <label class="formLabel"><i class="fa fa-user-circle-o"></i> Attended By</label>
                    <?= $form->field($model, 'attended_by')->textInput(['class' => 'inputForm form-control', 'placeholder' => 'Write attended person here.', 'id' => 'attendedBy' ])->label(false) ?>
                </div>
            </div>

        </div>
  
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="formLabel"><i class="fa fa-file"></i> CP Code</label>
                    <?= $form->field($model, 'cp_code')->textInput(['class' => 'inputForm form-control readonlyForm', 'value' => $cpCode, 'id' => 'cpCode', 'readonly' => 'readonly' ])->label(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <label class="formLabel"><i class="fa fa-calendar"></i> Date of Site-Walk </label>
                    <?= $form->field($model, 'date_sitewalk')->textInput(['class' => 'inputForm form-control readonlyForm', 'id' => 'date_call', 'data-date-format' => 'dd-mm-yyyy', 'readonly' => 'readonly', 'value' => date('d-m-Y') ])->label(false) ?>
                </div>

            </div>
        </div>

    </div>
    <hr/>

    <div class="row">    
        <div class="col-md-8 col-sm-8 col-xs-8">
            <label class="formLabel"><i class="fa fa-commenting-o"></i> Remarks</label>
            <?= $form->field($model, 'remarks')->textarea(['rows' => '4', 'class' => 'inputForm form-control', 'placeholder' => 'Write remarks here.', 'id' => 'projectRemarks' ])->label(false) ?>
        </div>
    </div>
    <hr/>
    <div class="row">    
        <div class="col-md-10 col-sm-10 col-xs-10">
        <label class="control-label" for="selectError1"><i class="fa fa-map-marker"></i> Taks List </label>

        <div class="controls">
            <select name="ProjectTasklist[task_id][]" id="selectError1" multiple class="form-control" data-rel="chosen">
              <?php foreach($dataTask as $tRow): ?>
                <option value="<?= $tRow['id'] ?>" ><?= $tRow['tasks_name'] ?></option>
              <?php endforeach; ?>
            </select>
        </div>
    </div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-12">
        <hr/>
            <?= Html::submitButton($model->isNewRecord ? '<li class=\'fa fa-save\'></li> Save Record' : '<li class=\'fa fa-save\'></li> Edit Record', ['class' => $model->isNewRecord ? 'formBtn btn btn-primary pull-right btn-sm' : 'form-btn btn btn-primary pull-right btn-sm']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

</div>
<br/>
