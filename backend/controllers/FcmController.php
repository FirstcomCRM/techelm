<?php

namespace backend\controllers;
use common\components\Fcm;

class FcmController extends \yii\web\Controller
{
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionTest(){

      $message = 'Data Testing with user_id added to field';
      $fcm_id = 'dmDt-7Fk6R8:APA91bGQd2EWqotHhuMY8-0o1WpapWzFnVfV-UnxrnlKvEoeBOQsJA9wijgH721p1x2ns_9yk2e3h4X9oCKejl3IqMRHVSrXMLMIOZTq1ssbTasS9E0RRXLM1vsFVPnejkR-LNIwEUrq';
//not working not registered   $fcm_id ='dc2S2GK2irI:APA91bEeR-epYGLn4HC15mZHOFrMnLYW-Fr8FRJl8tveVs9Np9r4K_gijFJj5homJAlhfFE8a2ydHTmxS9fO8c1G_uLl9ttyMIF2faVsXOz0VxC2M-Z0hosC3EUkUJfAzlB919XfVjP6';
    //not working mismatched sender ID  $fcm_id = 'emEKUhLzjJo:APA91bHz3oZinv0996ZVYkmIvO77h-bZJ9tVwB61qfaA2qEKIFV2X2phhAxJ7sFfk60XWZNsf_TuYK9xaR6ouev2zB-1FlnK1MXQsGCsc-vk-eVbkeb7zHeo2L-cw9mdLcbydr4qNe-5';
      //$fcm_id = '';
      $img_url = '';
      $tag = '';
      $user_id = 1;

      Fcm::send_gcm_notify($fcm_id, $message, $img_url, $tag, $user_id);

      return $this->render('index');
      //die('test');
    }

}
