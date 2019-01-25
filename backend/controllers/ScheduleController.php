<?php

namespace backend\controllers;

use Yii;
use backend\models\Schedule;
use backend\models\ScheduleSearch;
use backend\models\Department;
use backend\models\Days;
use backend\models\Classes;
use backend\models\SearchSchedule;
use backend\models\DepartmentSearch;
use yii\web\Controller;
use backend\models\Subject;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
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
                   
                ],
            ],
        ];
    }

    /**
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelDepartment= Department::find()
        ->orderBy([
            'year' => SORT_ASC,
            'name'=>SORT_ASC
          ])
        ->all();
       
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelDepartment'=>$modelDepartment,
            ]);
        }

    /**
     * Displays a single Schedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
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
            return $this->render('view', [
                'model' => $model,
                'modelDays'=>$modelDays,
                'modelClasses'=>$modelClasses,
                'department_name'=>$department_name,
            ]);
        }
        
    }

    /**
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $modelDay= Days::find()->all();
        $modelClasses= Classes::find()->all();
        $model = new Schedule();
        //Ako je primljen post zahtev obradjujemo primljene podatke
        if($model->load(Yii::$app->request->post()) ) {
                //Prvo proveravamo koliko imamo dana u nedelji i za svaki dan obradjujemo podatke
                for($j=0;$j<count($modelDay);$j++){  
                    $day = $modelDay[$j]['title'];
                   
                    //Brojimo casove po danu i u zavisnosti od casa dodeljujemo vrednosti
                    for($i=0;$i<count($modelClasses);$i++){
                        $subject_name_attribute = $day.$i;
                        $model->setIsNewRecord(true);
                        $model->id = null;
                        //Posto brojac petlje krece od nule, day_id mora da ima vrednost brojaca +1
                        $model->days_id = $j+1;
                        //Posto brojac petlje krece od nule, classes_id mora da ima vrednost brojaca +1
                        $model->classes_id =$i+1;
                        //Ako nije definisan predmet za dati cas, predmet za taj cas ima vrednost null.
                        //Ako je definisan predmet za dati cas on se poziva preko name atributa i dodeljuje mu se vrednosst
                        if(!isset($_POST[$subject_name_attribute])){
                            $model->subject_id = null;
                        }else{
                            $model->subject_id = $_POST[$subject_name_attribute];
                        }
                        $model->save();
                    }
                }
                Yii::$app->session->setFlash('success', "Schedule created successfully."); 
                return $this->redirect(['index']);
        }
            return $this->render('create', [
                'model' => $model,
                'modelDay'=>$modelDay,
                'modelClasses'=>$modelClasses

            ]);
        }

    /**
     * Updates an existing Schedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelDays= Days::find()->all();
        $modelClasses= Classes::find()->all();
        $schedule= new Schedule();
        $model = $schedule->getScheduleByDepartmentId($id);
        $department_name = $schedule->getDepartmentFullName($id);


        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('update', [
            'model' => $model,
            'modelDays'=>$modelDays,
            'modelClasses'=>$modelClasses,
            'department_name'=>$department_name,
        ]);
    }

    /**
     * Deletes an existing Schedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

<<<<<<< HEAD
        $delete = \Yii::$app
        ->db
        ->createCommand()
        ->delete('schedule', ['department_id' => $id])
        ->execute();

        if ($delete) {
            Yii::$app->session->setFlash('success', "Schedule deleted successfully.");
        } else {
            Yii::$app->session->setFlash('error', "Schedule not deleted.");
        }
        return $this->redirect(['index']);
=======
    $delete = \Yii::$app
    ->db
    ->createCommand()
    ->delete('schedule', ['department_id' => $id])
    ->execute();

    if ($delete) {
        Yii::$app->session->setFlash('success', "Schedule deleted successfully."); 
    } else {
        Yii::$app->session->setFlash('error', "Schedule not found.");
>>>>>>> c25e03d88ad94939ee1b09f58c356205b6106726
    }
    return $this->redirect(['index']);
}

    /**
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
