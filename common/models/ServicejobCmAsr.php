<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_cm_asr".
 *
 * @property integer $id
 * @property integer $servicejob_action_service_repair_id
 * @property integer $servicejob_complaint_mobile_id
 * @property integer $servicejob_cm_cf_id
 * @property string $servicejob_action_details
 * @property string $date_added
 * @property integer $active
 */
class ServicejobCmAsr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_cm_asr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_action_service_repair_id', 'servicejob_complaint_mobile_id', 'servicejob_cm_cf_id', 'servicejob_action_details', 'date_added'], 'required'],
            [['servicejob_action_service_repair_id', 'servicejob_complaint_mobile_id', 'servicejob_cm_cf_id', 'active'], 'integer'],
            [['date_added'], 'safe'],
            [['servicejob_action_details'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_action_service_repair_id' => 'Servicejob Action Service Repair ID',
            'servicejob_complaint_mobile_id' => 'Servicejob Complaint Mobile ID',
            'servicejob_cm_cf_id' => 'Servicejob Cm Cf ID',
            'servicejob_action_details' => 'Servicejob Action Details',
            'date_added' => 'Date Added',
            'active' => 'Active',
        ];
    }
}
