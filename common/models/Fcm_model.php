<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class Fcm_model extends \yii\base\Model
{
  public static function send_gcm_notify($reg_id, $message, $img_url, $tag, $user_id){
      // define("GOOGLE_API_KEY", "AIzaSyBsGSPuDKtN5KNmxK1zSqonaMMHUmAfeFQ"); // SAMPLER
      // define("GOOGLE_API_KEY", "AIzaSyBQVDMDpU99em5ZTQ6zbSbg4KtL8VKULIs"); // Firebase Cludn Messaging TEST
      define("GOOGLE_API_KEY", "AIzaSyAxewEiK97rX2fGNZ-USeIxWujL68uA78Y"); // Techelm Mobile
      define("GOOGLE_GCM_URL", "https://fcm.googleapis.com/fcm/send");


      $data = array(
        'title'=>'Android Learning',
        'message'=>$message,
        'image'=>$img_url,
        'tag'=>$tag,
        'user_id'=>$user_id,
      );

      $fields = array(
          'to'  						=> $reg_id ,
          'priority'					=> "high",
          //'data'						=> array("title" => "Android Learning", "message" => $message, "image"=> $img_url, "tag" => $tag)
          'data'						=> $data,
      );



      $headers = array(
          GOOGLE_GCM_URL,
          'Content-Type: application/json',
          'Authorization: key=' . GOOGLE_API_KEY
      );

      echo "<br>";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, GOOGLE_GCM_URL);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

      $result = curl_exec($ch);
      if ($result === FALSE) {
          die('Problem occurred: ' . curl_error($ch));
      }

      curl_close($ch);
      echo $result;
      return $result;

  }
}
