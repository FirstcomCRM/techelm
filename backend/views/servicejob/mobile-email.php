<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ReformSize;
use common\models\Customer;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobCmAsr;
use common\models\Equipments;
use common\models\ServicejobCmCf;
use common\models\base30;
use common\models\ConvertPng;

$cust = Customer::find()->where(['id'=>$model->customer_id])->one();
$i = 1;
?>

<p>
Hi <?php echo $cust->person_in_charge ?>,
</p>

<p>
Please find attached file.
</p>
<?php echo Html::a('Link', ['servicejob/c-view','id'=>$model->id]) ?>

<p>Thank you.</p>
