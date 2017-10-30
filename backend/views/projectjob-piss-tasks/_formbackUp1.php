<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProjectJob;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobPissTasks */
/* @var $form yii\widgets\ActiveForm */
$ProjectJob = new ProjectJob();
$projectjob_id = ArrayHelper::map($ProjectJob->find()->where(['status_flag'=> !3])->all(), 'id', 'project_ref');
//echo $projectJobId;
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="projectjob-piss-tasks-form">
     <div class="row">
         <div class="col-md-2 pull-right">
             <?php $form->field($model, 'projectjob_id')->dropDownList($projectjob_id, ['required'=> '']); ?>
         </div>
     </div>
    <div class="panel panel-primary">
        <div class="panel-heading"><span>Create Task For Pre-installation</span></div>
        <div class="panel-body">
                 <table id="task" class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Serial no</th>
                            <th>Description</th>
                            <th>Drawing Before</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $form->field($model, 'serial_no[]')->textInput(['maxlength' => true, 'required'=> ''])->label(false) ?></td>
                            <td><?= $form->field($model, 'description[]')->textInput(['maxlength' => true, 'required'=> ''])->label(false) ?></td>
                            <td> <?= $form->field($model, 'drawing_before[]')->fileInput(['multiple' => false, 'accept' => 'image/jpg, image/jpeg, image/png'])->label(false) ?></td>
                            <td><?= $form->field($model, 'status[]')->dropDownList([0=>'New'], ['maxlength' => true, 'required'=> ''])->label(false) ?></td>
                            <td>
                                <button type="button"class="remove btn-xs btn-primary"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                     </tbody>
                 </table>

            <div class="form-group">
              <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?> &nbsp;
              <?= Html::submitButton('<i class="fa fa-plus" aria-hidden="true"></i>  Add Row', ['id'=> 'add_row','class' =>  'btn btn-primary']) ?>
            </div>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
    $this->registerJsFile(
        '@web/js/projectjob/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>
