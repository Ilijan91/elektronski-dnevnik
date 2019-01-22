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
            [['department_id'], 'required'],
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
}
