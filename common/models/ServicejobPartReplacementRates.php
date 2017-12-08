<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_part_replacement_rates".
 *
 * @property integer $id
 * @property string $parts_name
 * @property string $unit_price
 * @property string $description
 */
class ServicejobPartReplacementRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_part_replacement_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parts_name', 'unit_price', 'description','category'], 'required'],
            [['parts_name', 'description'], 'string', 'max' => 255],
            [['unit_price'],'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category'=>'Category',
            'parts_name' => 'Parts Name',
            'unit_price' => 'Unit Price',
            'description' => 'Description',
        ];
    }
}
