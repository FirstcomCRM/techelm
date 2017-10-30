<?php

namespace common\models;

use Yii;

use yii\db\Query;

/**
 * This is the model class for table "parts".
 *
 * @property integer $id
 * @property integer $parts_category_id
 * @property string $parts_code
 * @property string $parts_name
 * @property string $description
 * @property integer $quantity
 * @property string $unit_of_measure
 * @property double $price
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property PartsCategory $partsCategory
 */
class Parts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parts_category_id', 'parts_code', 'parts_name', 'description', 'quantity', 'unit_of_measure', 'price'], 'required', 'message' => 'Fill up required fields.'],
            [['parts_category_id', 'quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['parts_code', 'parts_name'], 'string', 'max' => 150],
            [['unit_of_measure'], 'string', 'max' => 100],
            [['parts_name'], 'unique', 'message' => 'Parts already exist.'],
            [['parts_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartsCategory::className(), 'targetAttribute' => ['parts_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parts_category_id' => 'Parts Category ID',
            'parts_code' => 'Parts Code',
            'parts_name' => 'Parts Name',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'unit_of_measure' => 'Unit Of Measure',
            'price' => 'Price',
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
    public function getPartsCategory()
    {
        return $this->hasOne(PartsCategory::className(), ['id' => 'parts_category_id']);
    }

    /* get Last Id */
    public function getLastId()
    {
        $query = new Query();

        $result = $query->select(['Max(id) as PartsID'])
                            ->from('parts')
                            ->where(['status' => 1])
                            ->one();

        if(count($result) > 0) {
            return $result['PartsID'] + 1;

        }else{
            return 0;

        }

    }
}
