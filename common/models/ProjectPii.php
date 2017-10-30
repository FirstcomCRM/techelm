<?php

namespace common\models;

use Yii;

use yii\db\Query;

/**
 * This is the model class for table "project_pii".
 *
 * @property integer $id
 * @property string $project_reference
 * @property string $cp_code
 * @property string $date_sitewalk
 * @property integer $attended_by
 * @property string $remarks
 * @property integer $project_condition
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class ProjectPii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_pii';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_reference', 'cp_code', 'date_sitewalk', 'attended_by', 'remarks', 'project_condition', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['date_sitewalk', 'created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['remarks'], 'string'],
            [['project_reference', 'cp_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_reference' => 'Project Reference',
            'cp_code' => 'Cp Code',
            'date_sitewalk' => 'Date Sitewalk',
            'attended_by' => 'Attended By',
            'remarks' => 'Remarks',
            'project_condition' => 'Project Condition',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /* get Last Id */
    public function getLastId()
    {
        $query = new Query();

        $result = $query->select(['Max(id) as ProjectID'])
                            ->from('project_pii')
                            ->where(['status' => 1])
                            ->one();

        if(count($result) > 0) {
            return $result['ProjectID'] + 1;

        }else{
            return 0;

        }

    }
}
