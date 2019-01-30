<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property int $id
 * @property int $title
 *
 * @property Diary[] $diaries
 */
class Grade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiaries()
    {
        return $this->hasMany(Diary::className(), ['grade_id' => 'id']);
    }
}
