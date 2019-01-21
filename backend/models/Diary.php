<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "diary".
 *
 * @property int $id
 * @property int $student_id
 * @property int $subject_id
 * @property int $grade_id
 * @property int $final_grade
 *
 * @property Subject $subject
 * @property Student $student
 * @property Grade $grade
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
            [['student_id', 'subject_id', 'grade_id'], 'required'],
            [['student_id', 'subject_id', 'grade_id', 'final_grade'], 'integer'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['grade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grade::className(), 'targetAttribute' => ['grade_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student',
            'subject_id' => 'Subject',
            'grade_id' => 'Grade',
            'final_grade' => 'Final Grade',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrade()
    {
        return $this->hasOne(Grade::className(), ['id' => 'grade_id']);
    }
    
}
