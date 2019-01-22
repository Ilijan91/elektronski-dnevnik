<?php

namespace backend\controllers;

use Yii;
use backend\models\StudentSubject;
use backend\models\StudentSubjectSearch;
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
    public function actionIndex()
    {
        $searchModel = new StudentSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $gradeModel = new StudentSubject();
        $grades = $gradeModel->getGrades();
        // $grades = $gradeModel->getSubject();

        // $subject_id = $gradeModel->getSubjects();


        // $subjectModel = new StudentSubject();
        $subjects = $gradeModel->getSubjects();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gradeModel' => $gradeModel,
            'grades' => $grades,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Displays a single StudentSubject model.
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
     * Creates a new StudentSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentSubject();
        if ($model->load(Yii::$app->request->post()) ) {
            if(sizeof(array_filter($_POST['StudentSubject']['subject_id'])) > 0){
                foreach($_POST['StudentSubject']['subject_id'] as $key => $row){
                    //Set value for each subject from current array subject_id
                    $model->setIsNewRecord(true);
                    $model->id = null;
                    $model->subject_id = $row;
                    $model->save();
                }
                return $this->redirect(['index']);
            } 
           
        }
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('create', [
            'model' => $model,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
}
