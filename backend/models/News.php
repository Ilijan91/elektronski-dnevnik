<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $image
 * @property string $created_at
 * @property int $roll_id
 *
 * @property Roll $roll
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body',], 'required'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
            [['roll_id'], 'integer'],
            [['title'], 'string', 'max' => 256],
            [['image'], 'string', 'max' => 100],
            [['roll_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roll::className(), 'targetAttribute' => ['roll_id' => 'id']],
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
            'body' => 'Body',
            'image' => 'Image',
            'created_at' => 'Created At',
            'roll_id' => 'Roll ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoll()
    {
        return $this->hasOne(Roll::className(), ['id' => 'roll_id']);
    }
}
