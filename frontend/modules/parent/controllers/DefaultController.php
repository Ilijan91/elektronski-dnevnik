<?php

namespace frontend\modules\parent\controllers;
use backend\models\News;
use backend\models\Student;
use backend\models\Subject;
use backend\models\StudentSearch;
use backend\models\User;
use backend\models\Roll;
// use backend\controllers\NewsController;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `parent` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //Globalna promenljiva school name iz config-main.php params
        $school_name =\Yii::$app->params['school_name'];
        
        //Podaci o ulogovanom korisniku
        $user = \Yii::$app->user->identity;
        $roll =$this->getLoggedUserRollTitle($user->roll_id);
        $user_full_name = $this->getLoggedUserFullName($user);

        $news = News::find()->all();

        $this->layout = "main";

        return $this->render('index', [
            'news' => $news,
            'school_name' => $school_name,
            'roll' => $roll,
            'user_full_name' => $user_full_name,
        ]);
    }
    public function actionGrade($id) {
        $student = Student::find()->where("user_id = $id")->all();
        $this->layout = "main";
        $subjects=Subject::find()->all();
        return $this->render('grade', [
            'student' => $student,
            'subjects' => $subjects,
        ]);
    }
    protected function findModel()
    {
        if (($model = Yii::$app->user->identity->id) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function getLoggedUserFullName($user){
        $userFullName = $user->first_name.' '.$user->last_name;
        return $userFullName;
    }
    public function getLoggedUserRollTitle($user_roll_id){
        $roll_arr = Roll::find()->select('title')->where(['id'=>$user_roll_id])->one();
         $roll = $roll_arr['title'];   
         return $roll;
    }












    public function getGradesByStudent($student_id)
    {
        
        $sql = "SELECT student_subject.id, student_id, subject_id, subject.title, student.first_name, student.last_name, GROUP_CONCAT(grade) AS grades 
        FROM student_subject 
        INNER JOIN student 
        ON student_subject.student_id = student.id 
        INNER JOIN subject 
        ON student_subject.subject_id = subject.id 
        WHERE student_subject.student_id IN (SELECT id FROM student WHERE department_id=$department_id)
        GROUP BY student_id, subject_id";
        
        $subject_id = $this->getSubject();
        $data = Yii::$app->db->createCommand($sql)->queryAll();
       
        return $data;
    }



}
