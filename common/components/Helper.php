<?php

namespace common\components;
use Yii;
use common\models\Service;
use common\models\ServicejobCategories;
use common\models\User;
use common\models\Customer;
use common\models\Equipments;
use common\models\ProjectjobIpiTasksAction;
use common\models\Subcontractor;
use common\models\Projectjob;
/*

	Developer: Ronald Allan Patawaran

	Date: 22/05/2017

*/

Class Helper{
	/*
		@return: html/label
		@params: integer
	*/

//edr: get status textname based on projectjob status code given by mobile team
//0= new
//1= Unsigned
//2= Pending
//3= completed
//4 = on-process
	public static function projectStatusFlag($code = 0){
		switch ($code){
			case 0:
				return '<span class="label label-default">New</span>';
				break;
			case 1:
				return  '<span class="label label-warning">Unsgined</span>';
				break;
			case 2:
				return '<span class="label label-warning">Pending</span>';
				break;
			case 3:
				return '<span class="label label-success">Completed</span>';
				break;
			case 4:
				return '<span class="label label-info">On process</span>';
				break;
			default:
				return '<span class="label label-default">New</span>';
				break;
		}
	}

//edr fetch the task action name from  ProjectjobIpiTasksAction. Currently commented
	public static function getDescription($id){
		$description = ProjectjobIpiTasksAction::find()->where(['id'=>$id])->one();
		if (!empty($description)) {
				return $description->task_action;
		}else {
				return $description = null;
		}
	}

	//edr fetch the subcontractor name.
	public static function retrieveSubCon($id){
		$subcon =Subcontractor::find()->where(['id'=>$id])->one();
		if (!empty($subcon)) {
			return $subcon->subcontractor;
		}else{
			return $subcon = null;
		}
	}

	//edr fetch the project reference in projectjob
	public static function retrieveProjectRef($id){
		$ref = Projectjob::find()->where(['id'=>$id])->one();
		if (!empty($ref)) {
			return $ref->project_ref;
		}else{
			return $ref =  null;
		}
	}

//edr fetch the text name of the service job from Service
	public static function retriveService($id){
		$service = Service::find()->where(['id'=>$id])->one();
		if (!empty($service)) {
			return $service->service_name;
		}else {
			return $service = null;
		}
	}

//edr fetch the text name of the service job category from ServiceJob Category
	public static function retriveServiceJobCat($id){
		$data = ServicejobCategories::find()->select('category')->where(['id'=>$id])->one();
		if (!empty($data)) {
			return $data->category;
		}else{
			return $data = null;
		}
	}

//edr fetch the fullname of the user from User table
	public static function retriveUserFull($id){
		$engineer = User::find()->where(['id'=>$id])->one();
		if (!empty($engineer)) {
			return $engineer->fullname;
		}else{
			return $engineer = null;
		}
	}

//edr fetch the fullname of the customer from the Customer Table
	public static function retrieveCustomer($id){
		$cust = Customer::find()->where(['id'=> $id])->one();
		if (!empty($cust)) {
			return $cust->fullname;
		}else {
			return $cust = null;
		}
	}

//edr fetch the status but without the html attributes/elements
	public static function retriveStatusFlag($code = 0){
		switch ($code) {
			case 0:
				return 'New';
				break;
			case 1:
				return 'Unsigned';
				break;
			case 2:
				return 'Pending';
				break;
			case 4:
				return 'In-Progress';
				break;
			case 3:
				return 'Completed';
				break;
			default:
				return 'New';
				break;
		}
	}

//edr fetch the active state without the html attributes/elements
	public static function retriveActiveLabel($active){
		switch ($active) {
			case 1:
				return 'Active';
				break;
			case 0:
				return 'Inactive';
				break;
			default:
				return 'Inactive';
				break;
		}

	}

	public static function createStatusFlag($code = 0){

		switch ($code) {
			case 0:
				return '<span class="label label-default">New</span>';
				break;
			case 1:
				return '<span class="label label-warning">Unsigned</span>';
				break;
			case 2:
				return '<span class="label label-danger">Pending</span>';
				break;
			case 4:
				return '<span class="label label-primary">In progress</span>';
				break;
			case 3:
				return '<span class="label label-success">Completed</span>';
				break;
			default:
				return '<span class="label label-default">New</span>';
				break;
		}

	}

	/*
		@params integer
		@return string
	*/

	public static function getStatusFlag($code = 0){
		switch ($code) {
			case 1:
				return 'New';
				break;
			case 2:
				return 'Unsigned';
				break;
			case 3:
				return 'Completed';
				break;
			case 4:
				return 'In Progress';
			default:
				return 'New';
				break;

		}

	}


	public static function createActiveLabel($active){
		switch ($active) {
			case 1:
				return '<span class="label label-success">Active</span>';
				break;
			default:
				return '<span class="label label-warning">Inactive</span>';
				break;
		}

	}


	public static function createImage($path = ""){
	 	$HOSTNAME = 'http://techelm2012.firstcomdemolinks.com/api/ci-rest-api-techelm/';
		if(!empty($path)){
			return '<a href="'.$HOSTNAME.$path.'" ><img style="width:50px;" src="'.$HOSTNAME.$path.'"></a>';
		}
	}

	public static function createLocalImage($path = ""){
		if(!empty($path)){
			return '<a href="'.$path.'" data-pjax=0><img style="width:50px;" src="'.$path.'"></a>';
		}
	}

	/*public static function createApiDrawing($path = ""){
		if (!empty($path)) {
			$path = Yii::getAlias('@api-main').$path;
			return '<a href="'.$path.'" data-pjax=0><img style="width:50px;" src="'.$path.'"></a>';
		}

	}*/


/*
	@param: none;
	@return array
*/

	public static function getAllControllers(){
        $controllerlist = array();
	        if ($handle = opendir('../controllers')) {
	            while (false !== ($file = readdir($handle))) {
	                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
	                    $controllerlist[$file] = $file;
	                }
	            }
	            closedir($handle);
	        }
	        asort($controllerlist);
	        return $controllerlist;
	}



	/*
		@param: contoller.php;
		@return arrays;
	*/

	public static function getActions($controller="SiteController.php"){

		if(empty($controller)){
			$controller = "SiteController.php";
		}
	            $handle = fopen('../controllers/' . $controller, "r");
	            $actions = array();
	            if ($handle) {
	                while (($line = fgets($handle)) !== false) {
	                    if (preg_match('/public function action(.*?)\(/', $line, $display)):
	                        if (strlen($display[1]) > 2):
	                            $addDash = preg_replace('/\B([A-Z])/', '-$1', $display[1]);
	                        	$actions[$addDash] = $addDash;
	                        endif;
	                    endif;
	                }
	            }
       	return $actions;
	}



	public static function formatActions($actions=array()){
		$result = array();
		foreach ($actions as $key => $value) {
			$result[$value] = $value;
		}
		return $result;
	}

	public static function populateDropdownlist($array = array()){
		$html = "";
		foreach ($array as $key => $value) {
			$html .= "<option value='". $key . "'>". $value . "</option>";
		}
		return $html;

	}
}

 ?>
