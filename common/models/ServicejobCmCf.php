<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_cm_cf".
 *
 * @property integer $id
 * @property integer $servicejob_complaint_mobile_id
 * @property integer $servicejob_complaint_fault_id
 * @property integer $active
 */
class ServicejobCmCf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_cm_cf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_complaint_mobile_id', 'servicejob_complaint_fault_id'], 'required'],
            [['remarks'], 'string'],
            [['servicejob_complaint_mobile_id', 'servicejob_complaint_fault_id', 'active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_complaint_mobile_id' => 'Servicejob Complaint Mobile ID',
            'servicejob_complaint_fault_id' => 'Servicejob Complaint Fault ID',
            'remarks'=>'Remarks',
            'active' => 'Active',
        ];
    }
}
