<?php

namespace backend\models;

use Yii;


/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $day
 * @property int $subject_id
 * @property int $department_id
 *
 * @property Department $department
 * @property Subject $subject
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
            [['day', 'subject_id', 'department_id'], 'required'],
            [['day'], 'string'],
            [['class'], 'string'],
            [['subject_id', 'department_id'], 'integer'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
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
            'day' => 'Day',
            'subject_id' => 'Subject ID',
            'department_id' => 'Department ID',
            'class'=> 'class'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }



}
