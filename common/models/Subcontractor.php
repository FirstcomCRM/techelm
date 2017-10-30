<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subcontractor".
 *
 * @property integer $id
 * @property string $subcontractor
 * @property string $remarks
 * @property string $date_created
 */
class Subcontractor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcontractor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subcontractor'], 'required'],
            [['subcontractor'], 'unique'],
            [['remarks'], 'string'],
            [['date_created'], 'safe'],
            [['subcontractor'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subcontractor' => 'Sub-Contractor',
            'remarks' => 'Remarks',
            'date_created' => 'Date Created',
        ];
    }
}
