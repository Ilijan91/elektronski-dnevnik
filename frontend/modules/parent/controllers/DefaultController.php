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
use frontend\modules\teacher\models\TimeMeetingAppointment;
use frontend\modules\teacher\models\TimeMeeting;
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

    public function actionTimemeeting($department_id)
    {
        $this->layout = 'main';

        $parent_id = Yii::$app->user->identity->id;
        $teacher_id = $this->getTeacherIdByDepartmentId($department_id);
        //Dohvati ime i prezime ucitelja
        $user = new User;
        $teacherFullName = $user->getUserFullName($teacher_id);

        //Dohvati sve termine za odredjeni sastanak
        $model = new TimeMeetingAppointment;
       $termins = $model->getAllFreeMeetingTerminsForParent($teacher_id);
       //timeMeetingDay
       $timeMeetingInfo = TimeMeeting::find()->select(['day', 'start_at', 'end_at'])->where(['teacher_id'=>$teacher_id])->one();
       
       //Proveri da li je korisnik vec zakazao sastanak i onemoguci zakazivanje jos jednog sastanka
       $booked =TimeMeetingAppointment::find()->where(['parent_id'=>$parent_id])->one();

       //Unesi podatke u bazu
        if ($model->load(Yii::$app->request->post())) {

                //Dohvati appointment id
                $term = $_POST['TimeMeetingAppointment']['term'];
                $appointment_id = $term[0];
                  
                    
                    if(count($booked) > 0){
                        //Obrisi stari termin
                        $deleteOldAppointment =  Yii::$app->db->createCommand()
                        ->update('time_meeting_appointment', ['status' => 0, 'parent_id'=>null],'parent_id='.$parent_id)
                        ->execute();

                        //zakazi novi
                        $update =  Yii::$app->db->createCommand()
                        ->update('time_meeting_appointment', ['status' => 1, 'parent_id'=>$parent_id],'id='.$appointment_id)
                        ->execute();
                        if($update){
                            Yii::$app->session->setFlash('success', "Successfully updated appointment"); 
                            }else{
                                Yii::$app->session->setFlash('error', "Error"); 
                            }
                    }else{
                        $update =  Yii::$app->db->createCommand()
                        ->update('time_meeting_appointment', ['status' => 1, 'parent_id'=>$parent_id],'id='.$appointment_id)
                        ->execute();
                        if($update){
                            Yii::$app->session->setFlash('success', "Success"); 
                            }else{
                                Yii::$app->session->setFlash('error', "Error"); 
                            }
                            return $this->redirect('default/timemeeting', ['department_id'=>$department_id]);
                    }
                
        }
        return $this->render('timemeeting', [
            'model'=>$model,
            'termins'=>$termins,
            'teacherFullName'=>$teacherFullName,
            'timeMeetingInfo'=>$timeMeetingInfo,
            'booked'=>$booked,
        ]);
    }
    function getTeacherIdByDepartmentId($department_id){
        $teacher_id = Department::find()->select(['user_id'])->where(['id'=>$department_id])->all();
        return $teacher_id[0]['user_id'];
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
