<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "diary".
 *
 * @property int $id
 * @property int $grade
 * @property int $final_grade
 * @property int $student_id
 * @property int $subject_id
 *
 * @property Subject $subject
 * @property Student $student
 */
class Diary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade', 'final_grade', 'student_id', 'subject_id'], 'required'],
            [['grade', 'final_grade', 'student_id', 'subject_id'], 'integer'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade' => 'Grade',
            'final_grade' => 'Final Grade',
            'student_id' => 'Student ID',
            'subject_id' => 'Subject ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
