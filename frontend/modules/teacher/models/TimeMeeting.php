<?php

namespace frontend\modules\teacher\models;

use Yii;

/**
 * This is the model class for table "time_meeting".
 *
 * @property int $id
 * @property int $teacher_id
 * @property string $day
 * @property string $start_at
 * @property string $end_at
 *
 * @property User $teacher
 */
class TimeMeeting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_meeting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'day', 'start_at', 'end_at'], 'required'],
            [['teacher_id'], 'integer'],
            [['day'], 'string'],
            [['start_at', 'end_at'], 'safe'],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher_id' => 'Teacher ID',
            'day' => 'Day',
            'start_at' => 'Start At',
            'end_at' => 'End At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }
}
