<?php

namespace frontend\modules\parent\controllers;
use backend\models\News;
use backend\models\Student;

use backend\models\StudentSubject;
use backend\models\StudentSearch;
use backend\models\User;
use backend\models\Roll;
use backend\models\Department;
use backend\models\Subject;
use backend\models\Days;
use backend\models\Schedule;
use frontend\modules\parent\models\Messages;
use frontend\modules\parent\models\MessagesSearch;
use frontend\modules\parent\controllers\MessagesController;
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


        $studenttt= new StudentSubject;

        $diary=$studenttt->getGradesByStudent($id);

      

        $title=array_column($diary, 'title');
        $grade=array_column($diary, 'grades');
        

        $grades=array_combine($title, $grade);

        

        $this->layout = "main";
        $subjects=Subject::find()->all();

        $StudentSubject=StudentSubject::find()
        ->select('grade')
        ->where(['student_id'=>$id])
        ->all();

        
        

        return $this->render('grade', [
            'student' => $student,
            'subjects' => $subjects,
            'StudentSubject' => $StudentSubject,
            'grades'=>$grades,
            
        
        ]);  
    }
    public function actionMessages() {
        $this->layout = "main";
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $student = Student::find()
        ->select('id')
        ->where(['user_id'=>Yii::$app->user->identity->id])
        ->one();
        $student_id= $student->id;
        return $this->render('messages/index', [
            'student_id' => $student_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $this->layout = "main";
        $model = new Messages();
        $student = Student::find()
        ->select('id')
        ->where(['user_id'=>Yii::$app->user->identity->id])
        ->one();
        $student_id= $student->id;
        $teacher = $this->getTeacherById($student_id);
        $model->sender = Yii::$app->user->identity->id;
        $model->receiver = $teacher->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionView($id)
    {
        $this->layout = "main";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
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

    

    public function actionSchedule($id)
    {
        $schedule = Schedule::find()->where("department_id = $id")->all();

        $r= new Schedule;
        $rasp=$r->getScheduleByDepartmentId($id);
        $days=Days::find()->all();

        $this->layout = "main";

        return $this->render('Schedule', [
           'schedule'=>$schedule,
           'rasp'=>$rasp,
           'days'=>$days
            ]);
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
}
