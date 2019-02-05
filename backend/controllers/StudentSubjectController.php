<?php

namespace backend\controllers;

use Yii;
use backend\models\StudentSubject;
use backend\models\StudentSubjectSearch;
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
                        'roles' => ['@'],
                        'matchCallback' => function($rules, $action){
                            //module = \yii::$app->controller->module->id;
                            $action = Yii::$app->controller->action->id;
                            $controller = Yii::$app->controller->id;
                            $route = "$controller/$action";
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
    public function actionIndex()
    {
        $searchModel = new StudentSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $gradeModel = new StudentSubject();
        $grades = $gradeModel->getGrades();
        // $grades = $gradeModel->getSubject();

        // $subject_id = $gradeModel->getSubjects();


        // $subjectModel = new StudentSubject();
        $subjects = $gradeModel->getSubject();

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

                    $model->id =null;
                    $model->subject_id = $row;
                    $model->save();
                }
                return $this->redirect(['index']);
            } 
           
        }
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
