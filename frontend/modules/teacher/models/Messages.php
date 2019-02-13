<?php

namespace frontend\modules\teacher\models;

use Yii;
use backend\models\Student;
use backend\models\User;
use backend\models\Department;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $text
 * @property string $date
 * @property int $sender
 * @property int $receiver
 * @property int $parent_id
 * @property int $teacher_id
 * @property int $read_msg
 *
 * @property User $sender0
 * @property User $receiver0
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
            [['text', 'sender', 'receiver', 'parent_id', 'teacher_id'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['sender', 'receiver', 'parent_id', 'teacher_id', 'read_msg'], 'integer'],
            [['sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender' => 'id']],
            [['receiver'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver' => 'id']],
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
            'text' => 'Text',
            'date' => 'Date',
<<<<<<< HEAD
            'teacher_id' => 'Teacher',
            'parent_id' => 'Parent',
=======
>>>>>>> caadb743e0534e2b0bec1f88666eb6c7cb86e479
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'parent_id' => 'Parent ID',
            'teacher_id' => 'Teacher ID',
            'read_msg' => 'Read Msg',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver0()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
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
        $sql = 'SELECT messages.id, messages.text, messages.sender FROM messages WHERE messages.receiver= '.Yii::$app->user->identity->id;

        $mess = \Yii::$app->db->createCommand($sql)->queryAll();
        if(empty($mess)){
            return null;
        }else{
            return $mess;
        }
       
    }

    //Dohvati konverzaciju ucitelj-roditelj preko id roditelja
    public function getTeacherChatByParent($parent_id) {
        $sql = "SELECT id, text, DATE_FORMAT(date, '%d %M %Y %H:%i') AS date, sender, receiver, parent_id, teacher_id
        FROM messages
        WHERE messages.parent_id=$parent_id
        ORDER BY messages.date ASC";

        $mess = \Yii::$app->db->createCommand($sql)->queryAll();
        if(empty($mess)){
            return null;
        }else{
            return $mess;
        }
       
    }
    public function getSenderFullName() {
        $mess = $this->getMessagesByTeacher();
        if($mess == null){
            return null;
        }else{
            $column = array_column($mess, 'sender');
            $iml = implode(",", $column);
                $sql = 'SELECT user.id, user.first_name, user.last_name FROM user WHERE user.id IN ('.$iml.')';
                $sender = \Yii::$app->db->createCommand($sql)->queryAll();
            return $sender;
        }
    }
}
