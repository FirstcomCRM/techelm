<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_ipi_tasks".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property integer $serial_no
 * @property string $description
 * @property string $status
 * @property string $non_conformance
 * @property string $corrective_actions
 * @property string $target_completion_date
 * @property integer $status_flag
 * @property string $date_updated
 * @property string $form_type
 */
class ProjectjobIpiTasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_ipi_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serial_no', 'description', 'target_completion_date'], 'required'],
            [['serial_no', 'status_flag'], 'integer'],
            [['target_completion_date', 'date_updated'], 'safe'],
            [['description', 'status', 'non_conformance', 'corrective_actions'], 'string', 'max' => 255],
            [['form_type'], 'string', 'max' => 5],
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
            'serial_no' => 'Serial No',
            'description' => 'Description',
            'status' => 'Status',
            'non_conformance' => 'Non Conformance',
            'corrective_actions' => 'Corrective Actions',
            'target_completion_date' => 'Target Completion Date',
            'status_flag' => 'Status Flag',
            'date_updated' => 'Date Updated',
            'form_type' => 'Form Type',
        ];
    }
}
