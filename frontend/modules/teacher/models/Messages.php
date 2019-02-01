<?php

namespace frontend\modules\teacher\models;
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
            'date' => 'Date',
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

    public function getStudentsByTeacherId($teacher_id){
        //Dohvati odeljenje kome predaje ulogovani ucitelj
            $department = Department::find()
                            ->select('id')
                            ->where(['user_id'=>$teacher_id])
                            ->one();
            $department_id= $department->id;
        //Dohvati sve ucenike koji su u odeljenju kome predaje ulogovani ucitelj
        $s = new Student;
        $students= $s->getAllStudentsByDepartmentId($department_id);
        return $students;
    }   

    public function getUserByStudent($teacher_id) {
        $students = $this->getStudentsByTeacherId($teacher_id);
        $stud_arr = array_column($students,'id');
        $impl = implode(",", $stud_arr);
            $st = Student::find()->where("id IN ($impl)")->all();
            // $uimpl = implode(",", $st['user_id']);
            // $user_id = $st->id;
            // $data = User::find()->where("id IN ($uimpl)")->all();
            return $st;
    }

    public function getStudentById() {
        $student = Student::find()
        ->select('id')
        ->where(['user_id'=>Yii::$app->user->identity->id])
        ->one();

        return $student;
    }

    public function getMessagesByTeacher() {
        $sql = 'SELECT messages.id, messages.text, messages.sender FROM messages WHERE messages.receiver = '.Yii::$app->user->identity->id;

        $mess = \Yii::$app->db->createCommand($sql)->queryAll();

        return $mess;
    }

    public function getSenderFullName() {
        $mess = $this->getMessagesByTeacher();
        $column = array_column($mess, 'sender');
        $iml = implode(",", $column);
        // $message = $mess->sender;
        // foreach($mess as $mes) {
            $sql = 'SELECT user.id, user.first_name, user.last_name FROM user WHERE user.id IN ('.$iml.')';
            $sender = \Yii::$app->db->createCommand($sql)->queryAll();
        // }
        

        return $sender;
    }
    
}
