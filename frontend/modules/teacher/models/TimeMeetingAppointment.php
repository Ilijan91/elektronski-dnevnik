<?php

namespace frontend\modules\teacher\models;

use Yii;

/**
* This is the model class for table "time_meeting_appointment".
*
* @property int $id
* @property int $teacher_id
* @property int $parent_id
* @property string $term
* @property int $status
*
* @property User $parent
* @property User $teacher
*/
class TimeMeetingAppointment extends \yii\db\ActiveRecord
{
   /**
    * {@inheritdoc}
    */
   public static function tableName()
   {
       return 'time_meeting_appointment';
   }

   /**
    * {@inheritdoc}
    */
   public function rules()
   {
       return [
           [['teacher_id', 'term'], 'required'],
           [['teacher_id', 'parent_id', 'status'], 'integer'],
           [['term'], 'safe'],
           [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
           'teacher_id' => 'Teacher',
           'parent_id' => 'Parent',
           'term' => 'Term',
           'status' => 'Status',
       ];
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getParent()
   {
       return $this->hasOne(User::className(), ['id' => 'parent_id']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getTeacher()
   {
       return $this->hasOne(User::className(), ['id' => 'teacher_id']);
   }

   public function getAllFreeMeetingTerminsForParent($teacher_id){
       // INNER JOIN time_meeting
       // ON time_meeting_appointment.teacher_id = time_meeting.teacher_id
       $query =
       "SELECT term, id
       FROM time_meeting_appointment

       WHERE time_meeting_appointment.teacher_id = $teacher_id AND time_meeting_appointment.status=0
       ";
    $data = Yii::$app->db->createCommand($query)->queryAll();
    return $data;
   }


}