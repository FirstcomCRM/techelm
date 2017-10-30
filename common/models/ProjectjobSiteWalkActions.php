<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_site_walk_actions".
 *
 * @property integer $id
 * @property string $action
 */
class ProjectjobSiteWalkActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_site_walk_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action'], 'required'],
            [['action'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
        ];
    }
}
