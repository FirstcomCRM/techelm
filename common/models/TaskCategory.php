<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Tasks[] $tasks
 */
class TaskCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => 'Fill up required fields.'],
            [['description'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['name'], 'unique', 'message' => 'Task category already exist.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['task_category_id' => 'id']);
    }
}
