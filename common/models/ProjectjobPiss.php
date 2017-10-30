<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_piss".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property string $car_park_code
 * @property string $property_officer
 * @property string $tc_lew
 * @property string $property_officer_telNo
 * @property string $property_officer_mobileNo
 * @property string $property_officer_branch
 * @property string $tc_lew_telNo
 * @property string $tc_lew_mobileNo
 * @property string $tc_lew_email
 * @property string $remarks
 * @property string $date_site_walk
 */
class ProjectjobPiss extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_piss';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_park_code','start_date', 'property_officer', 'tc_lew', 'property_officer_telNo', 'property_officer_mobileNo', 'property_officer_branch', 'tc_lew_telNo', 'tc_lew_mobileNo', 'tc_lew_email', 'remarks'], 'required'],
            [['projectjob_id'], 'integer'],
            [['remarks'], 'string'],
            [['tc_lew_email'], 'email'],
            [['start_date'],'safe'],
            [['car_park_code', 'property_officer', 'tc_lew', 'property_officer_telNo', 'property_officer_mobileNo', 'property_officer_branch', 'tc_lew_telNo', 'tc_lew_mobileNo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectjob_id' => 'Projectjob ID',
            'car_park_code' => 'CP/Site Name',
            'property_officer' => 'Officer in Charge',
            'property_officer_telNo' => 'Officer in Charge Tel No',
            'property_officer_mobileNo' => 'Officer in Charge Mobile No',
            'property_officer_branch' => 'Branch/Site Address',
            'tc_lew' => 'Customer LEW',
            'tc_lew_telNo' => 'Customer LEW Tel No',
            'tc_lew_mobileNo' => 'Customer LEW Mobile No',
            'tc_lew_email' => 'Customer LEW Email',
            'remarks' => 'Remarks',
            'date_site_walk' => 'Date Site Walk',
            'start_date'=>'Start Date'
        ];
    }


    public function getTasks($id){
        return ProjectjobPissTasks::find()->where(['projectjob_id'=>$id])->all();
    }
}
