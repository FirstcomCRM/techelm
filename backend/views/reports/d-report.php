<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;

$quantity = 0;
$total = 0;
foreach ($dataProvider->getModels() as $key => $value) {
    $quantity += $value->quantity;
    $total += $value->total_price;
}

$total = number_format($total,2);
$quantity = number_format($quantity);
//die('t');
?>
<div class="reports-index">

<?php
//foreach ($dataProvider->getModels() as $key => $value) {
  //echo $value.'<br>';
//}
//echo '<pre>';
//print_r($dataProvider->getModels());
//echo '</pre>';
 ?>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search Serivce Job Parts</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('d_search', ['model' => $searchModel]); ?>
      </div>
    </div>
    <?php if ($x=='show'): ?>
      <div class="row dataprovider">
          <div class="col-md-12">
              <div class="panel panel-primary">
                  <div class="panel-heading"><span>Service Job Parts</span></div>
                  <div class="panel-body">
                    <div class="text-right">
                        <?php echo Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF',['pdf-d'],['class'=>'btn btn-primary', 'target'=>'_blank']) ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <?php
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'showFooter'=>true,
                            'columns'=>[
                              ['class' => 'yii\grid\SerialColumn'],
                              [
                                'label'=>'Service No',
                                'format'=>'raw',
                                'value'=>function ($model){
                                  $data = Servicejob::find()->where(['id'=>$model->servicejob_id])->one();
                                  if (!empty($data)) {
                                    return Html::tag('span', $data->service_no, ['title'=>'Site Address: '.$data->remarks, 'data-toggle'=>'tooltip','data-placement'=>'right']);
                                  }
                                  else{
                                    return $data = null;
                                  }
                                }
                              ],
                            //  'service.id',
                              'parts_name',
                              [
                                'attribute'=>'quantity',
                                'label'=> 'Quantity',
                                'footer'=>$quantity,
                              ],
                              'unit_price',
                            //  'total_price',
                              [
                                'attribute'=>'total_price',
                                'label'=> 'Total Price',
                                'footer'=>$total,
                              ],
                            ],
                        ])
                       ?>
                    </div>

                  </div>
              </div>
          </div>
      </div>
   <?php endif; ?>




</div>
