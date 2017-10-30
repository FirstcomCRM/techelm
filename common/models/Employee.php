<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $fullname
 * @property integer $age
 * @property string $birthday
 * @property integer $status
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'age', 'birthday'], 'required'],
            [['age', 'status'], 'integer'],
            [['fullname', 'birthday'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'age' => 'Age',
            'birthday' => 'Birthday',
            'status' => 'Status',
        ];
    }
}
