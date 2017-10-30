<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_site_inspection".
 *
 * @property integer $id
 * @property integer $project_ref_id
 * @property string $project_ref
 * @property string $subcontractor
 * @property string $date_inspection
 * @property string $work_completion_start_date
 * @property string $work_completion_end_date
 * @property integer $inspected_by
 * @property string $field_type
 * @property string $date_created
 */
class ProjectjobSiteInspection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_site_inspection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inspected_by', 'subcontractor','project_ref','status'], 'integer'],
            [['project_ref', 'date_inspection', 'work_completion_start_date', 'work_completion_end_date', 'inspected_by', 'field_type','project_site'], 'required'],
            [['date_inspection', 'work_completion_start_date', 'work_completion_end_date', 'date_created'], 'safe'],
            [['project_ref', 'field_type'], 'string', 'max' => 20],
            [['subcontractor'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_ref' => 'Project Reference',
            'subcontractor' => 'Sub-Contractor',
            'date_inspection' => 'Date Inspection',
            'work_completion_start_date' => 'Work Completion Start Date',
            'work_completion_end_date' => 'Work Completion End Date',
            'inspected_by' => 'Inspected By',
            'field_type' => 'Field Type',
            'date_created' => 'Date Created',
            'project_site'=>'Project Site',
            'status'=>'Status',
        ];
    }
}
