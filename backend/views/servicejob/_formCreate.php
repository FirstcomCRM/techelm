<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$ComplaintRowsCount = isset($rows_count) && $rows_count!=0 ? $rows_count : 1;
?>

<div class="servicejob-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Service Job</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'service_no')->dropDownList($service_no)->label('Service Category') ?>
                </div>
                <div class="col-md-2">
                   <?= $form->field($model, 'customer_id')->dropDownList($customer_no)->label('Customer') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'engineer_id')->dropDownList($engineer_id)->label('Team') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'equipment_type')->dropDownList($equipments) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'serial_no')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                     <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading"><span>Complaints</span></div>
        <div class="panel-body">
            <table id="complaints" class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Complaints</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $form->field($modelComplaints, 'servicejob_category_id[]')->dropDownList($service_categories, ['class'=> 'service_category form-control'])->label(false); ?></td>
                        <td><?= $form->field($modelComplaints, 'complaint_id[]')->dropDownList([''], ['class'=> 'service_complaints form-control'])->label(false) ?></td>
                        <td><?= $form->field($modelComplaints, 'active[]')->dropDownList([1=>'ACTIVE',0=>'INACTIVE'])->label(false) ?>
                        </td>
                        <td><a class="btn_remove" title="Delete" href=""><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>&nbsp;<button id="btnAddRow" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"> Add Row</i> </button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJsFile(
        '@web/js/servicejob/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>
