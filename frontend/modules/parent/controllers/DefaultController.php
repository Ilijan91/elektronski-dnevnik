<?php

namespace frontend\modules\parent\controllers;
use backend\models\News;
use backend\models\Student;
use backend\models\StudentSubject;
use backend\models\StudentSearch;
use backend\models\User;
use backend\models\Roll;
use backend\models\Department;
use frontend\modules\parent\models\Messages;
use frontend\modules\parent\models\MessagesSearch;
use frontend\modules\parent\controllers\MessagesController;
use backend\models\Subject;
use backend\models\Days;
use backend\models\Classes;
use backend\models\Schedule;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * Default controller for the `parent` module
 */
class DefaultController extends Controller
{
    // public function behaviors()
    // {
    //     $behaviors['verbs'] = [
    //         'class' => VerbFilter::className(),
    //         'actions' => [
    //             'delete' => ['POST'],
    //         ],
    //     ];
    //     $behaviors['access'] = [
    //         'class' => AccessControl::className(),
    //         'rules'=>[
    //             [
    //                 'allow' => true,
    //                 'roles' => ['parent'],
    //                 'matchCallback' => function($rules, $action){
    //                     //module = \yii::$app->controller->module->id;
    //                     $action = Yii::$app->controller->action->id;
    //                     $controller = Yii::$app->controller->id;
    //                     $route = "parent/$controller/$action";
    //                     $post = Yii::$app->request->post();
    //                     if(\Yii::$app->user->can($route)){
    //                         return true;
    //                     }
    //                 }
    //             ],
    //         ],
    //     ];
    //     return $behaviors;
    // }
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
        $student = Student::find()->where("id = $id")->all();

        $studenttt= new StudentSubject;

        $diary=$studenttt->getGradesByStudent($id);

      

        $title=array_column($diary, 'title');
        $grade=array_column($diary, 'grades');
        

        $grades=array_combine($title, $grade);

        

        $this->layout = "main";
        $subjects=Subject::find()->all();

        $StudentSubject=StudentSubject::find()
        ->select('grade_id')
        ->where(['student_id'=>$id])
        ->all();

        
        

        return $this->render('grade', [
            'student' => $student,
            'subjects' => $subjects,
            'StudentSubject' => $StudentSubject,
            'grades'=>$grades,
            
        
        ]);  
    }

    public function actionNews() {
        $this->layout = "main";
        $news = News::find()->all();

        return $this->render('news', [
            'news' => $news,
        ]);
    }

    public function actionTeachermeeting()
    {
        $this->layout = "main";

        return $this->render('teachermeeting', [
           
        ]);
    }

    public function actionSchedule($id)
    {
        $this->layout = 'main';
        $modelDays= Days::find()->all();
        $modelClasses= Classes::find()->all();
        $schedule= new Schedule();
        $model = $schedule->getScheduleByDepartmentId($id);
        $department_name = $schedule->getDepartmentFullName($id);
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














}
