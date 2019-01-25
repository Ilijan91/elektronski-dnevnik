<?php

namespace backend\models;

use Yii;
use backend\models\Days;
use backend\controllers\DaysController;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $days_id
 * @property int $subject_id
 * @property int $department_id
 * @property int $classes_id
 *
 * @property Department $department
 * @property Subject $subject
 * @property Days $days
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['days_id', 'subject_id', 'department_id', 'classes_id'], 'integer'],
            [['department_id'
         ], 'required'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['days_id'], 'exist', 'skipOnError' => true, 'targetClass' => Days::className(), 'targetAttribute' => ['days_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'days_id' => 'Days',
            'subject_id' => 'Subject',
            'department_id' => 'Department',
            'classes_id' => 'Classes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
    public function getDepartmentFullName($id){
        $dep = Department::find()->where(['id'=> $id])->one();
        return $dep['year'].''.$dep['name'];
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
    public function getDays()
    {
        return $this->hasOne(Days::className(), ['id' => 'days_id']);
    }
    public function getScheduleByDepartmentId($id){
        $subjQuery = 
            "SELECT department_id, subject_id, days_id, classes_id, CONCAT(department.year, department.name) AS dep, subject.title AS subject_title, days.title as days_title ,classes.title AS classes_title
            FROM schedule 
            INNER JOIN department 
            ON schedule.department_id = department.id 
            INNER JOIN subject 
            ON schedule.subject_id = subject.id
            INNER JOIN days 
            ON schedule.days_id = days.id
            INNER JOIN classes 
            ON schedule.classes_id = classes.id
            WHERE department_id = $id
            GROUP BY days_id, classes_id";
         $data = Yii::$app->db->createCommand($subjQuery)->queryAll();
         return $data;
    }
    //NE RADI
    public function getDayForUpdate($day_id){
        $day= Days::find()->where(['id'=>$day_id])->one();
        return $day['title'];
    }
}
