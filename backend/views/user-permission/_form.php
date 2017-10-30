<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UserGroup;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\UserPermission */
/* @var $form yii\widgets\ActiveForm */
use common\components\Helper;
use common\models\UserPermission;

$UserGroup = new UserGroup();
$UserGroupData = ArrayHelper::map($UserGroup->find()->all(), 'id', 'name');
$controllerList = $model->actions? json_decode($model->actions): Helper::getAllControllers();
$selectedController = isset($_GET['controller']) ? $_GET['controller'] : "";
$correspondingActions = Helper::getActions($selectedController);
?>

<div class="user-permission-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><span>User Permission</span></div>
        <div class="panel-body">
          <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-3 col-sm-12 col-lg-3">
                    <?= $form->field($model, 'controller')->dropDownList($controllerList, ['id'=> 'controller', 'value'=>$selectedController]) ?>  
                </div>
                <div class="col-md-3 col-sm-12 col-lg-3">
                    <?= $form->field($model, 'action')->checkboxList($correspondingActions) ?>
                </div>
                <div class="col-md-3 col-sm-12 col-lg-3">
                    <?= $form->field($model, 'user_group_id')->dropDownList($UserGroupData) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
  


<?php 
    $this->registerJsFile(
        '@web/js/userpermission/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>

