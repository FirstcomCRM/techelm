<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\swiftmailer\Mailer;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Servicejob;
use common\models\Customer;

class CronTestController extends Controller{

  private $from = "no-reply@firstcom.sg";
  public function actionNotify(){
    $fp=fopen("console/controllers/testfile.txt", "w");
    fwrite($fp,'test');
    fclose($fp);

    $messagejob = "";
    $customer = Customer::find()->orderBy(['id'=>SORT_DESC])->all();
    foreach ($customer as $i => $cust) {
      $customer_name = $cust->person_in_charge;
      $customer_email = $cust->email;
      $customer_id = $cust->id;
      $message = '<p>'.$customer_name.', You have unsigned service jobs that requires your attention.</p>';
      $servicejob = Servicejob::find()->where(['status'=>1, 'customer_id'=>$cust->id])->all();

      if (!empty($servicejob)) {
        $messagejob.='<ul>';
        foreach ($servicejob as $s => $job) {
              $messagejob.='<li>'.$job->service_no.'</li>';
        }
        $messagejob.='</ul>';
        $message.=$messagejob;
        $message .='<br>';
        $message .=  Html::a('LINK',['customer/view','id'=>  $customer_id]);
      //  echo $message; die();

      //  $message .= '<a href="http://localhost/system/frontend/web">LINK</a>';
        Yii::$app->mailer->compose()
                    ->setFrom($this->from)
                    ->setTo($customer_email)
                    ->setSubject('Unsigned Service Jobs')
                  //  ->setTextBody($messagejob)
                    ->setHtmlBody($message)
                    ->send();
                //    echo $messagejob.'-'.$customer_email."\n";
      }
      $messagejob = '';
      $customer_name = '';
      $customer_email = '';
      $message='';
      echo "runningtest \n";
    }


  }

  public function actionTest(){
    $fp=fopen("console/controllers/testfile.txt", "w");
    fwrite($fp,'test');
    fclose($fp);
    echo 'file created';
  }

}
 ?>
