<?php

namespace backend\controllers;

use Yii;
use backend\models\Diary;
use backend\models\DiarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Student;
use backend\models\Subject;
use backend\models\StudentSearch;


/**
 * DiaryController implements the CRUD actions for Diary model.
 */
class DiaryController extends Controller
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
     * Lists all Diary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Diary model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Diary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Diary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Diary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Diary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Diary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Diary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Diary::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    // public function getGrade()
    // {
    //     $student= Student::find()
    //         ->select('first_name, last_name')
    //         ->where
    // }
   // select diary.id, student_id, subject_id, GROUP_CONCAT(grade.title) as grades from diary inner join grade on diary.grade_id = grade.id where student_id = 1
    public function actionGrades($id){
      
        $model = Diary::find()
        ->select(['grade_id', 'student_id', 'subject_id'])
        ->with(['grade_id'])
        ->with(['student'])
        ->with(['subject'])
        ->where(['student_id'=>$id])
        ->all();
        $subjects = Subject::find()->all();
        // $grades = $model->grade->title;
       
        return $this->render('grades_id', [
            'model' => $model,
            'subjects'=>$subjects,
          
        ]);
    }
}
