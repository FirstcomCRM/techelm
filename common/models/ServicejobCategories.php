<?php

namespace common\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "servicejob_categories".
 *
 * @property integer $id
 * @property string $category
 * @property string $date_created
 * @property integer $active
 */
class ServicejobCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'date_created'], 'required'],
            [['date_created'], 'safe'],
            [['active'], 'integer'],
            [['category'], 'string', 'max' => 255],
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
            'date_created' => 'Date Created',
            'active' => 'Active',
        ];
    }

    public static function dataCategories($id=null) {
        return ArrayHelper::map(ServicejobCategories::find()->all(), 'id', 'category');
    }
}
