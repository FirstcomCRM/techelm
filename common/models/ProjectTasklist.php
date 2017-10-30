<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_tasklist".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $task_id
 * @property string $project_condition
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class ProjectTasklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_tasklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'task_id', 'project_condition', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['project_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['task_id'], 'string', 'max' => 100],
            [['project_condition'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'task_id' => 'Task ID',
            'project_condition' => 'Project Condition',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
