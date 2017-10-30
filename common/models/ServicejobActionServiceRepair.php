<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_action_service_repair".
 *
 * @property integer $id
 * @property integer $servicejob_category_id
 * @property string $action
 * @property string $date_created
 * @property integer $active
 */
class ServicejobActionServiceRepair extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_action_service_repair';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_category_id', 'action',], 'required'],
            [['action'],'unique'],
            [['servicejob_category_id', 'active'], 'integer'],
            [['date_created'], 'safe'],
            [['action'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_category_id' => 'Servicejob Category ID',
            'action' => 'Action',
            'date_created' => 'Date Created',
            'active' => 'Active',
        ];
    }
}
