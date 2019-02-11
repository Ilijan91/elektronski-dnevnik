<?php

namespace frontend\modules\parent\models;
use backend\models\Student;
use backend\models\User;
use backend\models\Department;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $sender
 * @property int $receiver
 *
 * @property User $parent
 * @property User $teacher
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'sender', 'receiver'], 'required'],
            [['text'], 'string'],
            [['sender', 'receiver'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender' => 'id']],
            [['receiver'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
    }

    public function getTeacherById($student_id){
        $student = Student::find()
        ->select('id, department_id')
        ->where(['id'=>$student_id])
        ->one();
    //    $student_id = $student->id;
       $department_id = $student->department_id;
       $department = Department::find()
        ->select('id, user_id')
        ->where(['id'=>$department_id])
        ->one();
        // $user_id = $department->user_id;
        // $user = User::find()
        // ->select(['id', 'first_name', 'last_name'])
        // ->where(['id'=>$user_id])
        // ->one();
        return $department;
       }
}
