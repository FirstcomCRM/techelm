<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "toolbox_actions".
 *
 * @property integer $id
 * @property string $details
 */
class ToolboxActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'toolbox_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details'], 'required'],
            [['details'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'details' => 'Details',
        ];
    }
}
