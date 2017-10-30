<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\Url;
use Yii;
class Upload extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $uploadedPath;
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
//=1
    public function upload($projectjobid = 1)
    {        //var_dump($this->validate());die();
        if ($this->validate()) {
        	if(!file_exists('projectjob/drawings/preinstallationtask'. $projectjobid)){
            	mkdir('projectjob/drawings/preinstallationtask'. $projectjobid);
            	$this->_DoUpload($projectjobid);
        	}else{
        		$this->_DoUpload($projectjobid);
        	}
            return true;
        } else {          //  var_dump($this->error() );
            return false;
        }
    }


    private function _DoUpload($projectjobid){
        $name = Yii::$app->getSecurity()->generateRandomString();
    	if($this->imageFile->saveAs('projectjob/drawings/preinstallationtask'. $projectjobid . '/' . $name . '.' . $this->imageFile->extension)){
        	$this->uploadedPath = 'projectjob/drawings/preinstallationtask'. $projectjobid . '/' . $name . '.' . $this->imageFile->extension;
    	}
    }
}






 ?>
