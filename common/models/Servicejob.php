<?php

namespace common\models;

use Yii;
use common\models\ServicejobCategories;

/**
 * This is the model class for table "servicejob".
 *
 * @property integer $id
 * @property string $service_no
 * @property integer $customer_id
 * @property integer $service_id
 * @property integer $engineer_id
 * @property string $remarks
 * @property string $remarks_before
 * @property string $remarks_after
 * @property string $equipment_type
 * @property string $serial_no
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property string $signature_name
 * @property string $start_date_task
 * @property string $end_date_task
 * @property string $date_created
 * @property integer $active
 */
class Servicejob extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'service_id', 'engineer_id', 'remarks', 'equipment_type', 'serial_no'], 'required'],
            [['service_no'], 'unique','targetClass'=>Servicejob::className(),'message'=>'Service No already exist'],
            [['customer_id', 'service_id', 'engineer_id', 'status', 'active'], 'integer'],
            [['remarks', 'remarks_before', 'remarks_after','signature_web','signature_customer_name'], 'string'],
            [['start_date', 'end_date', 'start_date_task', 'end_date_task', 'date_created','service_date'], 'safe'],
        //    [['service_no'], 'string', 'max' => 20],
            [['customer_name_2','engineer_name_2'],'string'],
            [['equipment_type', 'serial_no', 'signature_name'], 'string', 'max' => 50],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_no' => 'Service No',
            'customer_id' => 'Customer',
            'service_id' => 'Service',
            'engineer_id' => 'Team',
            'remarks' => 'Site Address',
            'remarks_before' => 'Remarks Before',
            'remarks_after' => 'Remarks After',
            'equipment_type' => 'Equipment Type',
            'serial_no' => 'Equipment Serial No',
            'start_date' => 'Start Date',
            'service_date'=>'Service Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'signature_name' => 'Signature Name',
            'signature_web' =>'Signature Web',
            'start_date_task' => 'Start Date Task',
            'end_date_task' => 'End Date Task',
            'date_created' => 'Date Created',
            'active' => 'Active',
            'signature_customer_name'=>'Signature Customer Name',
            'customer_name_2'=>'Verification Name',
            'engineer_name_2'=> 'Second Engineer Name',
        ];
    }

    public static function getServiceJob(){
        $query = "SELECT service_no as title, complaint as description, start_date as start, status as status_flag FROM ". Servicejob::tableName();
        return Yii::$app->db->createCommand($query)->queryAll();
    }
    /* whte */
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'engineer_id']);
    }
    public function getService(){
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
    public function getCustomer(){
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    /* whte */

    //edr not used on standby
    public function getServiceCat(){
    //  return $this->hasOne(ServicejobComplaintMobile::className(), ['servicejob_id' => 'id'])->with(['service-name']);
    return $this->hasMany(ServicejobComplaintMobile::className(), ['servicejob_id' => 'id']);
    }

    public function getServiceName(){
      return $this->hasOne(ServicejobCategories::className(), ['id' => 'servicejob_category_id']) ;
    }

    public function getSerivceNo(){
      return $this->hasOne(Servicejob_parts::className(), ['servicejob_id' => 'id']) ;
    }


    public static function getSubCatList($cat_id){
      $list = ServicejobComplaintFault::find()->where(['servicejob_category_id'=>$cat_id])->select(['id','complaint'])->asArray()->all();
    /*  foreach ($list as $i => $part) {
        $out[] = ['id' => $part['id'], 'name' => $part['complaint']];
      }*/
      return $list;
    }

}
