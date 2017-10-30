<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_piss_tasks".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property string $serial_no
 * @property string $description
 * @property string $conformance
 * @property string $comments
 * @property string $status
 * @property string $drawing_before
 * @property string $drawing_after
 * @property string $date_updated
 */
class ProjectjobPissTasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_piss_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['projectjob_id'], 'integer'],
            [['date_updated','created_by','date_created'], 'safe'],
            [['serial_no', 'description', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectjob_id' => 'Project Job',
            'serial_no' => 'Serial No',
            'description' => 'Description',
            'conformance' => 'Conformance',
            'comments' => 'Comments',
            'status' => 'Status',
            'drawing_before' => 'Drawing Before',
            'drawing_after' => 'Drawing After',
            'date_updated' => 'Date Updated',
        ];
    }
}
