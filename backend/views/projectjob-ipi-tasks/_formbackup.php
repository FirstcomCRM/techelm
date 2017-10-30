<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ProjectJob;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpiTasks */
/* @var $form yii\widgets\ActiveForm */
$ProjectJob = new ProjectJob();
$ProjectJobData = ArrayHelper::map($ProjectJob->find()->all(), 'id', 'project_ref');
?>

<div class="projectjob-ipi-tasks-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-2 pull-right">
            <?= $form->field($model, 'projectjob_id')->dropDownlist($ProjectJobData) ?>
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
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($defaultTasks)){
                            foreach ($defaultTasks as $key => $task) {
                    ?>
                            <tr>
                                <td><?= $form->field($model, 'description[]')->textInput(['required'=>'', 'value'=> $task,'maxlength' => true])->label(false) ?></td>
                                <td><?= $form->field($model, 'serial_no[]')->textInput(['required'=>''])->label(false) ?></td>
                                <td><?= $form->field($model, 'corrective_actions[]')->textInput(['required'=>'','maxlength' => true])->label(false) ?></td>
                                <td><?= $form->field($model, 'target_completion_date[]')->textInput(['required'=>'','readonly'=> true, 'class'=> 'form-control datepicker'])->label(false) ?></td>
                                <td><?= $form->field($model, 'status_flag[]')->dropDownlist([0=>'New'])->label(false) ?></td>
                                <td>
                                    <button class="remove btn-xs btn-primary">Remove</button>
                                </td>
                            </tr>
                    <?php
                            }
                        }else{
                    ?>
                            <tr>
                                <td><?= $form->field($model, 'description')->textInput(['required'=>'','maxlength' => true])->label(false) ?></td>
                                <td><?= $form->field($model, 'serial_no')->textInput(['required'=>''])->label(false) ?></td>
                                <td><?= $form->field($model, 'corrective_actions')->textInput(['required'=>'','maxlength' => true])->label(false) ?></td>
                                <td><?= $form->field($model, 'target_completion_date')->textInput(['required'=>'','readonly'=> true, 'class'=> 'form-control datepicker'])->label(false) ?></td>
                                <td><?= $form->field($model, 'status_flag')->dropDownlist([0=>'New'])->label(false) ?></td>
                                <td>
                                    <button class="remove btn-xs btn-primary">Remove</button>
                                </td>
                            </tr>
                    <?php
                        }
                     ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?> &nbsp; <button id="add_row" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Row</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJsFile(
        '@web/js/inspectionTasks/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>
