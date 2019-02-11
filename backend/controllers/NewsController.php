<?php

namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\filters\AccessControl;


/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$model=News::find()->all();

        $model= new ActiveDataProvider([
            'query'=>News::find(),
            'pagination'=>[
                'pageSize'=>5
            ]
        ]);
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelNews=News::find()->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelNews'=>$modelNews
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       
       $model=new News();
        
        if ($model->load(Yii::$app->request->post())) {

            $images=UploadedFile::getInstances($model, 'image');
                
                foreach($images as $image){

                     $image->saveAs('../../frontend/web/img/upload/'.$image->baseName. '.'.$image->extension);       
                }
            
            
            $model->image=$image->baseName. '.'.$image->extension;
        }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);   
            }
            
        
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $images=UploadedFile::getInstances($model, 'image');
            foreach($images as $image){
                $image->saveAs('img/upload/'.$image->baseName. '.'.$image->extension);
            }
            
            $model->image=$image->baseName. '.'.$image->extension;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
