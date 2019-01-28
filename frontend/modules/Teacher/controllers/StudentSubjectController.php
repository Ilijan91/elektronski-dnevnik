<?php

namespace frontend\modules\teacher\controllers;

use Yii;
use frontend\modules\teacher\models\StudentSubject;
use frontend\modules\teacher\models\StudentSubjectSearch;
use backend\models\Roll;

use backend\models\Student;
use backend\models\Department;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
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
        $diary = $studentSubject->getGradesByDepartment($department_id);
        
        //Dohvati id ucitelja koji je trenutno ulogovan i pronadji njegove ucenike pomocu funkcije getStudentsByTeacherId
        $teacher_id = \Yii::$app->user->identity->id;

        $modelStudents = $this->getStudentsByTeacherId($teacher_id);

        // $searchModel = new StudentSubjectSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = 'main';
        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'department_name'=>$department_name,
            'department_id' =>$department_id,
            'user_full_name'=>$user_full_name,
            'diary'=>$diary,
            'modelStudents'=>$modelStudents
        ]);
    }

    /**
     * Displays a single StudentSubject model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($id)
    // {
        //dodaj [aram departm id 
    //     //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
    //     $department = Department::find()->where(['id'=> 7])->one();
    //     $department_name = $department->getYearName();

    //     $this->layout = 'main';
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //         'department_name'=>$department_name,
    //     ]);
    // }

    /**
     * Creates a new StudentSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($department_id)
    {    
        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $department_id])->one();
        $department_name = $department->getYearName();

        $this->layout = 'main';
        $model = new StudentSubject();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'department_name'=>$department_name,
            
        ]);
    }


    public function actionCreate_grades_per_subject($department_id)
    {   
        //Dohvati puni naziv odeljenja kome predaje ulogovani ucitelj
        $department = Department::find()->where(['id'=> $department_id])->one();
        $department_name = $department->getYearName();

        $model = new StudentSubject();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        $this->layout = 'main';
        return $this->render('create_grades_per_subject', [
            'model' => $model,
            'department_name'=>$department_name,
           
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
        $department = Department::find()->where(['id'=> 7])->one();
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
