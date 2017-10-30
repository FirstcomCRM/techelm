<?php

namespace common\models;

use Yii;

use yii\db\Query;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property integer $task_category_id
 * @property string $tasks_code
 * @property string $tasks_name
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property TaskCategory $taskCategory
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_category_id', 'tasks_code', 'tasks_name', 'description'], 'required', 'message' => 'Fill up required fields.'],
            [['task_category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['tasks_code', 'tasks_name'], 'string', 'max' => 150],
            [['tasks_name'], 'unique', 'message' => 'Task already exist.'],
            [['task_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskCategory::className(), 'targetAttribute' => ['task_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_category_id' => 'Task Category ID',
            'tasks_code' => 'Tasks Code',
            'tasks_name' => 'Tasks Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskCategory()
    {
        return $this->hasOne(TaskCategory::className(), ['id' => 'task_category_id']);
    }

    /* get Last Id */
    public function getLastId()
    {
        $query = new Query();

        $result = $query->select(['Max(id) as TasksID'])
                            ->from('tasks')
                            ->where(['status' => 1])
                            ->one();

        if(count($result) > 0) {
            return $result['TasksID'] + 1;

        }else{
            return 0;

        }

    }

}
