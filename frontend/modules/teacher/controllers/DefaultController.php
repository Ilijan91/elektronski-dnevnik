<?php

namespace frontend\modules\teacher\controllers;

use Yii;
use yii\web\Controller;
use backend\models\News;
use backend\models\Roll;
use backend\models\Student;
use backend\models\StudentSubject;
use backend\models\Department;
use backend\models\User;
use backend\models\Days;
use backend\models\Classes;
use backend\models\Schedule;
use backend\controllers\NewsController;
use backend\controllers\DepartmentController;
use frontend\modules\teacher\models\Messages;
use frontend\modules\parent\models\MessagesSearch;
use frontend\modules\parent\controllers\MessagesController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * Default controller for the `teacher` module
 */
class DefaultController extends Controller
{
   
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules'=>[
                [
                    'allow' => true,
                    'roles' => ['teacher'],
                    'matchCallback' => function($rules, $action){
                        //module = \yii::$app->controller->module->id;
                        $action = Yii::$app->controller->action->id;
                        $controller = Yii::$app->controller->id;
                        $route = "teacher/$controller/$action";
                        $post = Yii::$app->request->post();
                        if(\Yii::$app->user->can($route)){
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        
            //Globalna promenljiva school name iz config-main.php params
            $school_name =\Yii::$app->params['school_name'];
            

            //Svi podaci o ulogovanom korisniku
            $user = \Yii::$app->user->identity;

            //Dohvati rolu korisnika koji je trenutno ulogovan
            $roll =$this->getLoggedUserRollTitle($user->roll_id);

            //Dohvati ime i prezime korisnika koji je trenutno ulogovan
            $user_full_name = $this->getLoggedUserFullName($user);

            //Dohvati sve vesti i prikazi prvo najnovije
            $news = News::find()->orderBy(['created_at'=> SORT_DESC])->limit(3)->all();
            
            $this->layout = 'main';
            return $this->render('index', [
                'news'=> $news,
                'user_full_name'=> $user_full_name,
                'roll'=>$roll,
                'school_name'=>$school_name
            ]);
    }

    public function actionStudents($department_id){
        
        $schedule= new Schedule();
        $model = $schedule->getScheduleByDepartmentId($department_id);
        $department_name = $schedule->getDepartmentFullName($department_id);

        //Dohvati id ucitelja koji je trenutno ulogovan i pronadji njegove ucenike pomocu funkcije getStudentsByTeacherId
        $teacher_id = \Yii::$app->user->identity->id;

        $students = $this->getStudentsByTeacherId($teacher_id);
        $this->layout = 'main';
        return $this->render('students', [
            'students'=>$students,
            'department_name'=>$department_name,
        ]);
    }


    
    public function actionDiary(){
        $this->layout = 'main';
        return $this->render('diary', [
        ]);
    }

    public function actionSchedule($department_id){
        $this->layout = 'main';

        $modelDays= Days::find()->all();
        $modelClasses= Classes::find()->all();
        $schedule= new Schedule();
        $model = $schedule->getScheduleByDepartmentId($department_id);
        $department_name = $schedule->getDepartmentFullName($department_id);
        //Ako nije kreiran raspored za izabrano odeljenje izbaci gresku
        if(count($model) < 1){
            $msg= "<h4>There is no data for department</h4>";
            return $this->render('error', [
                'msg' => $msg,
            ]);
        }else{
            return $this->render('schedule', [
                'model' => $model,
                'modelDays'=>$modelDays,
                'modelClasses'=>$modelClasses,
                'department_name'=>$department_name,
            ]);
        }
    }

    public function actionNews(){
         //Dohvati sve vesti i prikazi prvo najnovije
         $news = News::find()->orderBy(['created_at'=> SORT_DESC])->all();
        
        $this->layout = 'main';
        return $this->render('news', [
            'news'=>$news,
        ]);
    }


//Prikazi ovu stranicu ukoliko nema podataka za prikaz
    public function actionEmpty()
    {
        // $this->layout = 'main';
        return $this->render('default/empty', [
            
        ]);
    }
    
    public function getUserByStudent($teacher_id) {
        $students = $this->getStudentsByTeacherId($teacher_id);
        $stud_arr = array_column($students,'id');
        $impl = implode(",", $stud_arr);
            $st = Student::find()->where("id IN ($impl)")->all();
            return $st;
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

    public function getLoggedUserFullName($user){
        $userFullName = $user->first_name.' '.$user->last_name;
        return $userFullName;
    }
    public function getLoggedUserRollTitle($user_roll_id){
        $roll_arr = Roll::find()->select('title')->where(['id'=>$user_roll_id])->one();
         $roll = $roll_arr['title'];   
         return $roll;
    }
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
