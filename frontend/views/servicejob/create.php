<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Service;
use common\models\User;
use common\models\Customer;
use common\models\ServicejobPrices;
use common\models\ServicejobCategories;
use common\models\Equipments;

/* @var $this yii\web\View */
/* @var $model common\models\Servicejob */

$this->title = 'Creates Servicejob';
$this->params['breadcrumbs'][] = ['label' => 'Servicejobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$engineer_group_id = 2;
$role = 0
?>
<div class="servicejob-create">



    <?php /*$this->render('_formCreate', [
        'model' => $model,
        'modelComplaints' => $modelComplaints,
        'modelServicejobCmCf' => $modelServicejobCmCf,
        'service_no' => ArrayHelper::map(Service:: find()->where(['active'=> 1])->all(), 'id', 'service_name'),
		'customer_no' => ArrayHelper::map(Customer::find()->where(['active'=> 1])->all(), 'id', 'fullname'),
		'engineer_id' => ArrayHelper::map(User::find()->where(['user_group_id'=> $engineer_group_id])->all(), 'id', 'fullname'),
		'equipments' => ArrayHelper::map(Equipments::find()->all(), 'equipment_code', 'description'),
		'service_categories' => ArrayHelper::map(ServicejobCategories::find()->where(['active'=> 1])->all(), 'id', 'category'),
    ])*/ ?>
    <?php echo $this->render('_form', [
        'model' => $model,
        'modelComplaints' => $modelComplaints,
        'modelServicejobCmCf' => $modelServicejobCmCf,
        'service_no' => ArrayHelper::map(Service:: find()->where(['active'=> 1])->all(), 'id', 'service_name'),
        'customer_no' => ArrayHelper::map(Customer::find()->where(['active'=> 1])->all(), 'id', 'fullname'),
      //  'engineer_id' => ArrayHelper::map(User::find()->where(['user_group_id'=> $engineer_group_id])->all(), 'id', 'fullname'),
        'engineer_id' => ArrayHelper::map(User::find()->where(['role'=> 0])->all(), 'id', 'fullname'),
        'equipments' => ArrayHelper::map(Equipments::find()->all(), 'equipment_code', 'description'),
        'service_categories' => ArrayHelper::map(ServicejobCategories::find()->where(['active'=> 1])->all(), 'id', 'category'),
    ]) ?>


</div>
