<?php

namespace frontend\modules\parent\models;
use backend\models\Student;
use frontend\modules\parent\models\User;
use backend\models\Department;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
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
            [['text', 'sender', 'receiver'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['sender', 'receiver'], 'integer'],
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
            'text' => 'Text',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'date' => 'Date'
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
        $user_id = $department->user_id;
        $user = User::find()
        ->select(['id', 'first_name', 'last_name'])
        ->where(['id'=>$user_id])
        ->one();

        return $user;
       }

       public function getStudentById() {
        $student = Student::find()
        ->select('id')
        ->where(['user_id'=>Yii::$app->user->identity->id])
        ->one();

        return $student;
       }
}
