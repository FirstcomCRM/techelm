<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipments".
 *
 * @property integer $id
 * @property string $equipment_code
 * @property string $description
 * @property integer $active
 */
class Equipments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['active'], 'integer'],
            [['equipment_code', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipment_code' => 'Equipment Code',
            'description' => 'Description',
            'active' => 'Active',
        ];
    }
}
