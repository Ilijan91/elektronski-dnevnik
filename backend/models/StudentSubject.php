<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student_subject".
 *
 * @property int $id
 * @property int $student_id
 * @property int $subject_id
 * @property int $grade
 * @property int $final_grade
 * @property string $date
 *
 * @property Student $student
 * @property Subject $subject
 */
class StudentSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'subject_id'], 'required'],
            [['student_id', 'subject_id', 'grade', 'final_grade'], 'integer'],
            [['date'], 'safe'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'subject_id' => 'Subject ID',
            'grade' => 'Grade',
            'final_grade' => 'Final Grade',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function getGradesByStudent($student_id)
   {

       $sql = "SELECT student_id, subject_id, subject.title, student.first_name, student.last_name, GROUP_CONCAT(grade) AS grades
       FROM student_subject
       INNER JOIN student
       ON student_subject.student_id = student.id
       INNER JOIN subject
       ON student_subject.subject_id = subject.id
       WHERE student_subject.student_id=$student_id
       GROUP BY subject_id";

       $subject_id = $this->getSubject();
       $data = Yii::$app->db->createCommand($sql)->queryAll();

       return $data;
   }

   
}
