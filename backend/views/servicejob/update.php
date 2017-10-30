<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Service;
use common\models\User;
use common\models\Customer;
use common\models\ServicejobPrices;
use common\models\ServicejobCategories;
use common\models\Equipments;
use common\models\ServicejobComplaintMobile;
/* @var $this yii\web\View */
/* @var $model common\models\Servicejob */

$this->title = 'Update Servicejob: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$engineer_group_id = 2;
$complaintRowsCount = ServicejobComplaintMobile::find()->where(['active'=> 1, 'servicejob_id'=> $model->id])->count();
$serviceJobMobileData = ServicejobComplaintMobile::find()->where(['active'=> 1, 'servicejob_id'=> $model->id])->all();
?>
<div class="servicejob-update">


    <?php /*$this->render('_formUpdate', [
        'model' => $model,
        'modelComplaints' => $modelComplaints,
        'serviceJobMobileData' => $serviceJobMobileData,
        'service_no' => ArrayHelper::map(Service:: find()->where(['active'=> 1])->all(), 'id', 'service_name'),
		'customer_no' => ArrayHelper::map(Customer::find()->where(['active'=> 1])->all(), 'id', 'fullname'),
		'engineer_id' => ArrayHelper::map(User::find()->where(['user_group_id'=> $engineer_group_id])->all(), 'id', 'fullname'),
		'equipments' => ArrayHelper::map(Equipments::find()->all(), 'equipment_code', 'description'),
		'service_categories' => ArrayHelper::map(ServicejobCategories::find()->where(['active'=> 1])->all(), 'id', 'category'),
		'rows_count' => $complaintRowsCount
    ])*/ ?>

    <?= $this->render('_form', [
        'model' => $model,
        'modelComplaints' => $modelComplaints,
        'serviceJobMobileData' => $serviceJobMobileData,
        'service_no' => ArrayHelper::map(Service:: find()->where(['active'=> 1])->all(), 'id', 'service_name'),
        'customer_no' => ArrayHelper::map(Customer::find()->where(['active'=> 1])->all(), 'id', 'fullname'),
        //'engineer_id' => ArrayHelper::map(User::find()->where(['user_group_id'=> $engineer_group_id])->all(), 'id', 'fullname'),
    //    'engineer_id' => ArrayHelper::map(User::find()->all(), 'id', 'fullname'),
      'engineer_id' => ArrayHelper::map(User::find()->where(['is_mobile_user'=> 1])->all(), 'id', 'fullname'),
        'equipments' => ArrayHelper::map(Equipments::find()->where(['active'=>1])->all(), 'equipment_code', 'description'),
        'service_categories' => ArrayHelper::map(ServicejobCategories::find()->where(['active'=> 1])->all(), 'id', 'category'),
        'rows_count' => $complaintRowsCount,
        'modelParts'=>$modelParts,
    ]) ?>

</div>
