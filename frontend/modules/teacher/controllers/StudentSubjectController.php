<?php

namespace frontend\modules\teacher\controllers;

use Yii;
use frontend\modules\teacher\models\StudentSubject;
use frontend\modules\teacher\models\StudentSubjectSearch;
use backend\models\Roll;
use backend\models\Subject;
use backend\models\Student;
use backend\models\Department;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * StudentSubjectController implements the CRUD actions for StudentSubject model.
 */
class StudentSubjectController extends Controller
{
    /**
     * @inheritdoc
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

    /**
     * Lists all StudentSubject models.
     * @return mixed
     */
    public function actionIndex($department_id)
    {
        //Globalna promenljiva school name iz config-main.php params
        $school_name =\Yii::$app->params['school_name'];
        
        //Svi podaci o ulogovanom korisniku
        $user = \Yii::$app->user->identity;

        //Dohvati ime i prezime korisnika koji je trenutno ulogovan
        $user_full_name = $this->getLoggedUserFullName($user);

        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $department_id])->one();
        $department_name = $department->getYearName();

        //Dohvati podatke za prikaz grupisanih ocena u dnevnik (ucenici, predmeti i ocene)
        
        $studentSubject  = new StudentSubject;
        // $diary = $studentSubject->getGradesByDepartment($department_id);
        
       
        //Dohvati id ucitelja koji je trenutno ulogovan i pronadji njegove ucenike pomocu funkcije getStudentsByTeacherId
        $teacher_id = \Yii::$app->user->identity->id;
        $modelStudents = $this->getStudentsByTeacherId($teacher_id);

        $this->layout = 'main';
        return $this->render('index', [
            'department_name'=>$department_name,
            'department_id' =>$department_id,
            'user_full_name'=>$user_full_name,
            'modelStudents'=>$modelStudents
        ]);
    }
   

    /**
     * Displays a single StudentSubject model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($student_id)
    {
        //Dohvati odeljenje ucenika koga drzi ulogovani ucitelj
        $department = Department::find()
                       ->select('id')
                       ->where(['user_id'=>Yii::$app->user->identity->id])
                       ->one();
        $department_id= $department->id;
        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $department_id])->one();
        $department_name = $department->getYearName();

        $student = Student::find()->where(['id'=> $student_id])->one();;
        $student_name =$student->getfullname($student_id);

        $modelSubjects = Subject::find()->all();

        //Dohvati sve ocene iz svih predmeta za jednog studenta
        $studentSubject  = new StudentSubject;
        $diary = $studentSubject->getGradesByStudent($student_id); 

        //Napravi novi niz $grades pomocu prethodno dobijenog niza za datog ucenika ($diary)  gde je odnos key=>value kao ocena=>predmet
        $title = array_column($diary, 'title');unset($title[9]);
        $grade = array_column($diary, 'grades');unset($grade[9]);
        $grades = array_combine($title, $grade);
        
        
        $this->layout = 'main';
        return $this->render('view', [
            'department_name'=>$department_name,
            'modelSubjects'=>$modelSubjects,
            'student_name'=>$student_name,
            'grades'=>$grades,
        ]);
    }

    /**
     * Creates a new StudentSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($department_id)
    {    
        //Dohvati id ucitelja koji je trenutno ulogovan i pronadji njegove ucenike pomocu funkcije getStudentsByTeacherId
        $teacher_id = \Yii::$app->user->identity->id;
        $modelStudents = $this->getStudentsByTeacherId($teacher_id);
        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $department_id])->one();
        $department_name = $department->getYearName();

        $this->layout = 'main';
        $model = new StudentSubject();

        if($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('StudentSubject');
            $student_id = $post['student_id'];
            $subject_id = $post['subject_id'];
            $grade_id = $post['grade_id'];
            $ids = StudentSubject::find()->select('id')->where("student_id = $student_id")->andWhere("subject_id = $subject_id")->andWhere("grade_id is null")->all();
            $count = count($ids);
            if($count > 0) {
                $model2 = $this->findModel($ids);
                $sql = "UPDATE student_subject SET grade_id = '$grade_id' WHERE student_subject.id = ".$model2->id;
                $model2 = Yii::$app->db->createCommand($sql)->execute();
            } else {
                $model->save();
            }
            Yii::$app->session->setFlash('success', "Grade inserted successfully."); 
        }

        return $this->render('create', [
            'model' => $model,
            'department_name'=>$department_name,
            'modelStudents'=>$modelStudents,
            
        ]);
    }


    public function actionCreate_grades_per_subject($department_id)
    {   
        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $department_id])->one();
        $department_name = $department->getYearName();

        //Dohvati id ucitelja koji je trenutno ulogovan i pronadji njegove ucenike pomocu funkcije getStudentsByTeacherId
        $teacher_id = \Yii::$app->user->identity->id;
        $modelStudents = $this->getStudentsByTeacherId($teacher_id);

        $model = new StudentSubject();

         //Ako je primljen post zahtev obradjujemo primljene podatke
         if($model->load(Yii::$app->request->post()) ) {
            //Prvo proveravamo koliko imamo ucenika u odeljenju i za svakog otvaramo petlju, zatim novu kolonu (div col-lg-2) gde prikazujemo u h2 tagu ime ucenika
            for($j=0;$j<count($modelStudents);$j++){
                $student_id = $modelStudents[$j]['id'];
                    $model->setIsNewRecord(true);
                    $model->final_grade = null;
                    $model->id = null;
                    $model->subject_id = $_POST['StudentSubject']['subject_id'];
                    $model->student_id =$_POST[$student_id];
                    
                    //Ako nije definisana ocena za ucenika cas, ocena za tog ucenika iz definisanog predmeta ima vrednost null.
                        //dodeljujemo jedinstvenu vrednost name atributu za grade kako bismo pratili post zahteve koje saljemo nakon submitovanja forme. Tu vrednost za definisemo kao id studenta i id ocene
                        $grade_attribute = $student_id.'ocena'; 
                    if(!isset($_POST[$grade_attribute])){
                       $model->grade_id = null;
                    }else{
                        $model->grade_id = $_POST[$grade_attribute];
                    }
                    $model->save();
                   
            }
            Yii::$app->session->setFlash('success', "Grades inserted successfully."); 
            return $this->redirect(['index','department_id' =>$department_id, ]);
    }
        $this->layout = 'main';
        return $this->render('create_grades_per_subject', [
            'model' => $model,
            'department_name'=>$department_name,
            'modelStudents'=>$modelStudents
           
        ]);
    }

    /**
     * Updates an existing StudentSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   
        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $id])->one();
        $department_name = $department->getYearName();

        $this->layout = 'main';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'department_name'=>$department_name,
        ]);
    }

    /**
     * Deletes an existing StudentSubject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'main';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentSubject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
}
