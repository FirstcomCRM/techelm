<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_ipi_tasks_action".
 *
 * @property integer $id
 * @property string $task_action
 * @property string $description
 */
class ProjectjobIpiTasksAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_ipi_tasks_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_action'], 'required'],
            [['description'], 'string'],
            [['task_action'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_action' => 'Task Action',
            'description' => 'Description',
        ];
    }
}
