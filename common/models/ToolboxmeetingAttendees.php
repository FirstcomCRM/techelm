<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "toolboxmeeting_attendees".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property string $employee_code
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
            [['id', 'projectjob_id', 'employee_code'], 'required'],
            [['id', 'projectjob_id'], 'integer'],
            [['employee_code'], 'string', 'max' => 255],
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
            'employee_code' => 'Employee Code',
        ];
    }
}
