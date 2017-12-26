<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_piss_tasks_drawing".
 *
 * @property integer $id
 * @property integer $projectjob_piss_tasks_id
 * @property integer $projectjob_id
 * @property string $drawing_before
 * @property string $drawing_after
 * @property integer $is_from_mobile_uploads
 * @property integer $created_by
 * @property string $date_created
 * @property integer $active
 */
class ProjectjobPissTasksDrawing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_piss_tasks_drawing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['projectjob_piss_tasks_id', 'projectjob_id', 'drawing_before', 'drawing_after', 'created_by'], 'required'],
            [['projectjob_piss_tasks_id', 'projectjob_id', 'is_from_mobile_uploads', 'created_by', 'active'], 'integer'],
            [['date_created'], 'safe'],
            [['drawing_before', 'drawing_after'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectjob_piss_tasks_id' => 'Projectjob Piss Tasks ID',
            'projectjob_id' => 'Projectjob ID',
            'drawing_before' => 'Drawing Before',
            'drawing_after' => 'Drawing After',
            'is_from_mobile_uploads' => 'Is From Mobile Uploads',
            'created_by' => 'Created By',
            'date_created' => 'Date Created',
            'active' => 'Active',
        ];
    }
}
