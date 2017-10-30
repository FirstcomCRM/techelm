<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\ProjectJob;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasks */
/* @var $form yii\widgets\ActiveForm */
$ProjectJob = new ProjectJob();
$ProjectJobData = ArrayHelper::map($ProjectJob->find()->all(), 'id', 'project_ref');


$task_action =  ArrayHelper::map($action, 'id', 'task_action');
asort($task_action);


?>

<div class="projectjob-ipi-tasks-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-2 pull-right">
            <?php $form->field($model, 'projectjob_id')->dropDownlist($ProjectJobData) ?>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"><span>Create Tasks For Inspection</span></div>
        <div class="panel-body">
            <table id="tasks_inspection" class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Serial No</th>
                        <th>Corrective Actions</th>
                        <th>Target Completion</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>

                            <tr>
                              <td>
                                <?php echo $form->field($model,'description')->label(false)->widget(Select2::className(),[
                                  'data'=>$task_action,
                                  'options'=>['placeholder'=>'Select '],
                                  'theme'=> Select2::THEME_BOOTSTRAP,
                                  'size'=> Select2::MEDIUM,
                                  'pluginOptions' => [
                                    'allowClear' => true
                                  ],
                                ]) ?>
                              </td>
                                <td><?= $form->field($model, 'serial_no')->textInput(['required'=>''])->label(false) ?></td>
                                <td><?= $form->field($model, 'corrective_actions')->textInput(['required'=>'','maxlength' => true])->label(false) ?></td>
                                <td><?= $form->field($model, 'target_completion_date')->textInput(['required'=>'','readonly'=> true, 'class'=> 'form-control datepicker'])->label(false) ?></td>
                                <td><?= $form->field($model, 'status_flag')->dropDownlist([0=>'New'])->label(false) ?></td>

                            </tr>


                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJsFile(
        '@web/js/inspectionTasks/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>
