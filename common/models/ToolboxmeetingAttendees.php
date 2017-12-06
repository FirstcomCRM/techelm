<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "toolboxmeeting_attendees".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property integer $toolboxmeeting_id
 * @property string $employee_code
 * @property string $date_added
 * @property string $created_by
 * @property string $date_updated
 * @property integer $active
 */
class ToolboxmeetingAttendees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'toolboxmeeting_attendees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['projectjob_id', 'toolboxmeeting_id', 'employee_code', 'date_added', 'created_by'], 'required'],
            [['projectjob_id', 'toolboxmeeting_id', 'active'], 'integer'],
            [['date_added', 'date_updated'], 'safe'],
            [['employee_code', 'created_by'], 'string', 'max' => 100],
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
            'toolboxmeeting_id' => 'Toolboxmeeting ID',
            'employee_code' => 'Employee Code',
            'date_added' => 'Date Added',
            'created_by' => 'Created By',
            'date_updated' => 'Date Updated',
            'active' => 'Active',
        ];
    }
}
