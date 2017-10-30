<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_complaint_mobile".
 *
 * @property integer $id
 * @property integer $servicejob_id
 * @property integer $servicejob_category_id
 * @property string $date_created
 * @property integer $active
 */
class ServicejobComplaintMobile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_complaint_mobile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_category_id', 'complaint_id'], 'required'],
    //        [['servicejob_category_id', 'complaint_id'],'unique','targetAttribute' => ['servicejob_category_id', 'complaint_id']],
        //    [['complaint_remark'],'unique'],
            [['complaint_remark'], 'string'],
            [['servicejob_id', 'servicejob_category_id', 'active', 'complaint_id'], 'integer'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_id' => 'Servicejob ID',
            'servicejob_category_id' => 'Servicejob Category ID',
            'complaint_id'=> 'Complaint ID',
            'complaint_name'=> 'Complaint Name',
            'complaint_remark'=> 'Remark',
            'date_created' => 'Date Created',
            'active' => 'Active',
        ];
    }
}
