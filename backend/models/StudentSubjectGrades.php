<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student_subject_grades".
 *
 * @property int $student_subject_id
 * @property int $grade_id
 *
 * @property StudentSubjects $studentSubject
 * @property Grade $grade
 */
class StudentSubjectGrades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_subject_grades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_subject_id', 'grade_id'], 'required'],
            [['student_subject_id', 'grade_id'], 'integer'],
            [['student_subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentSubjects::className(), 'targetAttribute' => ['student_subject_id' => 'id']],
            [['grade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grade::className(), 'targetAttribute' => ['grade_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_subject_id' => 'Student Subject ID',
            'grade_id' => 'Grade ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentSubject()
    {
        return $this->hasOne(StudentSubjects::className(), ['id' => 'student_subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrade()
    {
        return $this->hasOne(Grade::className(), ['id' => 'grade_id']);
    }
}
