<?php

namespace frontend\modules\parent\models;

use Yii;

/**
 * This is the model class for table "open_dors".
 *
 * @property int $id
 * @property string $title
 * @property string $open_dors
 * @property string $time
 * @property int $user_id
 *
 * @property User $user
 */
class OpenDors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'open_dors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'open_dors', 'user_id'], 'required'],
            [['time'], 'safe'],
            [['user_id'], 'integer'],
            [['title', 'open_dors'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'open_dors' => 'Open Dors',
            'time' => 'Time',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
