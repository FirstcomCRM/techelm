<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_replacement_category".
 *
 * @property integer $id
 * @property string $category
 * @property string $description
 */
class ServicejobReplacementCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_part_replacement_category';
        //return 'servicejob_replacement_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'unique'],
            [['description'], 'string'],
            [['category'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'description' => 'Description',
        ];
    }
}
