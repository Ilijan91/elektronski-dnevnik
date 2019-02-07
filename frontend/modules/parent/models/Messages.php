<?php

namespace frontend\modules\parent\models;

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
 * @property int $teacher_id
 * @property int $parent_id
 * @property int $sender
 * @property int $receiver
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
            [['text', 'teacher_id', 'parent_id', 'sender', 'receiver'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['teacher_id', 'parent_id', 'sender', 'receiver'], 'integer'],
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
            'teacher_id' => 'Teacher ID',
            'parent_id' => 'Parent ID',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
        ];
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
        $sql = 'SELECT messages.id, messages.text, messages.sender FROM messages WHERE messages.receiver= '.Yii::$app->user->identity->id;

        $mess = \Yii::$app->db->createCommand($sql)->queryAll();
        if(count($mess) < 1){
            return null;
        }else{
            return $mess;
        }
       
    }

    
    //Dohvati konverzaciju ucitelj-roditelj preko id roditelja
    public function getTeacherChatByParent($parent_id) {
        $sql = "SELECT *
        FROM messages
        WHERE messages.parent_id=$parent_id
        ORDER BY messages.date ASC";

        $mess = \Yii::$app->db->createCommand($sql)->queryAll();
        if(count($mess) < 1){
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
