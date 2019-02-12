<?php

namespace frontend\modules\parent\controllers;

use Yii;
use frontend\modules\parent\models\Messages;
use backend\models\User;
use backend\models\Student;
use backend\models\Department;
use frontend\modules\parent\models\MessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class MessagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
     * Lists all Messages models.
     * @return mixed
     */
    public function actionIndex($department_id)
    {
        

        $this->layout = "main";
        //Dohvati id ulogovanog roditelja
        $parent_id = \Yii::$app->user->identity->id;

        //Dohvati id ucitelja preko id odeljenja
        $teacher_find_id = Department::find()->select(['user_id'])->where(['id'=>$department_id])->all();
        $teacher_id = $teacher_find_id[0]['user_id'];

        //Dohvati ime i prezime ucitelja pomocu njegovog id-ja
        $teacher = User::find()->select(['id', 'first_name', 'last_name'])->where(['id'=> $teacher_id])->all();

        //Dohvati sve poruke
        $messages = new Messages();
        $message = $messages->getTeacherChatByParent($parent_id);

        // $searchModel = new MessagesSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'teacher_id' => $teacher_id,
            'teacher'=>$teacher,
            'parent_id'=>$parent_id,
            'message' => $message,
            'department_id'=>$department_id,
           
        ]);
    }

    public function actionFetch(){
        // if request is AJAX
        if(Yii::$app->request->isAjax){
            // get user id

            $parent_id = Yii::$app->user->identity->id;
            // get all msg where status = 0 and receiver = $parent_id
            $msg = Messages::find()->where(['read_msg' => 0,'receiver' => $parent_id])->all();
            // count all msg
            $msg = count($msg);
            // echo Json::encode($msg);
            echo $msg;
           
        }
    }
    public function actionInsert(){
        // if request is AJAX
        if(Yii::$app->request->isAjax){
            $parent_id = Yii::$app->user->identity->id;
            // create model msg
            $msg = new Messages();
            // update all statuses where is status = 0 and id_roditelj = $roditelj_id with value 1
            $msg::updateAll(['read_msg' => 1], 'read_msg = 0 && receiver = '.$parent_id.'');
        }
    }

    /**
     * Displays a single Messages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'main';
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Messages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($teacher_id, $department_id)
    {
        $this->layout = "main";
        $model = new Messages();
        if ($model->load(Yii::$app->request->post())) {
            $model->sender = \Yii::$app->user->identity->id;
            $model->parent_id = \Yii::$app->user->identity->id;
            $model->receiver =$teacher_id;
            $model->teacher_id = $teacher_id;
            if($model->save()){
                Yii::$app->session->setFlash('success', "Message has been successfully sent!"); 
                
            }else {
                Yii::$app->session->setFlash('error', "Message send failed! Try again."); 
            }
            return $this->redirect(['index', 'department_id' => $department_id]);
            
        }
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Messages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Messages model.
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
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
