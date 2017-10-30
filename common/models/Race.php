<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "race".
 *
 * @property integer $race_id
 * @property integer $Name
 * @property integer $active
 */
class Race extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'active'], 'required'],
            [['active'], 'integer'],
            [['Name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'race_id' => 'Race ID',
            'Name' => 'Name',
            'active' => 'Active',
        ];
    }
}
