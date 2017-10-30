<?php 
	namespace backend\controllers;

	use Yii;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;



	Class MasterController extends Controller{

		public function actionService($data = array(), $method = "GET", $url = "http://localhost/api/ci-rest-api-techelm/index.php/auth/user", $headers = array('Content-Type: application/x-www-form-urlencoded')) {	

			$ch = curl_init();
			$get_params = http_build_query($data);
			$data = array("data"=>$data);
			curl_setopt($ch, CURLOPT_URL, $url.'?'.$get_params);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			//curl_setopt($ch, CURLOPT_POST, count($data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$ret = json_decode(curl_exec($ch));	
			if(!curl_error($ch)) print_r($ret);
			curl_close($ch);
		}

	}







 ?>