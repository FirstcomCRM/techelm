<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_ipi_corrective_actions".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property string $serial_no
 * @property string $car_no
 * @property string $description
 * @property string $target_remedy_date
 * @property string $completion_date
 * @property string $remarks
 * @property string $disposition
 * @property integer $status_flag
 * @property string $date_updated
 * @property string $form_type
 */
class ProjectjobIpiCorrectiveActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_ipi_corrective_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id', 'serial_no', 'car_no', 'description', 'target_remedy_date', 'completion_date', 'remarks', 'disposition', 'status_flag', 'date_updated', 'form_type'], 'required'],
            [['id', 'projectjob_id', 'status_flag'], 'integer'],
            [['target_remedy_date', 'completion_date', 'date_updated'], 'safe'],
            [['serial_no', 'car_no', 'description', 'remarks', 'disposition'], 'string', 'max' => 255],
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
            'car_no' => 'Car No',
            'description' => 'Description',
            'target_remedy_date' => 'Target Remedy Date',
            'completion_date' => 'Completion Date',
            'remarks' => 'Remarks',
            'disposition' => 'Disposition',
            'status_flag' => 'Status Flag',
            'date_updated' => 'Date Updated',
            'form_type' => 'Form Type',
        ];
    }
}
