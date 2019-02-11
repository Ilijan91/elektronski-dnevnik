<?php

namespace frontend\modules\teacher\controllers;

use Yii;
use frontend\modules\teacher\models\Messages;
use backend\models\User;
use backend\models\Student;
use backend\models\Department;
use frontend\modules\teacher\models\MessagesSearch;
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
    //                 'roles' => ['teacher'],
    //                 'matchCallback' => function($rules, $action){
    //                     //module = \yii::$app->controller->module->id;
    //                     $action = Yii::$app->controller->action->id;
    //                     $controller = Yii::$app->controller->id;
    //                     $route = "teacher/$controller/$action";
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
    public function actionIndex()
    {
        $this->layout = "main";
        $messages = new Messages();
        $message = $messages->getMessagesByTeacher();
        $teacher_id = \Yii::$app->user->identity->id;

        $students = $messages->getStudentsByTeacherId($teacher_id);
        $stud_arr = array_column($students,'id');
        $impl = implode(",", $stud_arr);

        $users = new User;
        $students = $this->getUserByStudent($teacher_id);
        $parents =  $this->getParents($teacher_id);
        
        return $this->render('index', [
            'teacher_id' => $teacher_id,
            'message' => $message,
            'parents' => $parents,
            'students'=>$students
        ]);
    }
    public function actionChat($parent_id)
    {
        $this->layout = "main";
        //Dohvati id ucitelja
        $teacher_id = \Yii::$app->user->identity->id;

        //Dohvati ime i prezime roditelja
        $user = new User;
        $parent_full_name = $user->getUserFullName($parent_id);

        //Dohvati sve poruke
        $messages = new Messages();
        $message = $messages->getTeacherChatByParent($parent_id);

        if ($messages->load(Yii::$app->request->post())) {
            $messages->sender = \Yii::$app->user->identity->id;
            
            $messages->parent_id = $parent_id;
            $messages->receiver = $parent_id;
            $messages->teacher_id =\Yii::$app->user->identity->id;
            if($messages->save()){
                Yii::$app->session->setFlash('success', "Message has been successfully sent!"); 
                
            }else {
                Yii::$app->session->setFlash('error', "Message send failed! Try again."); 
            }
            return $this->redirect(['chat', 'parent_id' => $messages->parent_id]);
        }

        return $this->render('chat', [
            'teacher_id' => $teacher_id,
            'message' => $message,
            'messages' => $messages,
            'parent_full_name' => $parent_full_name,

        ]);
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
    public function actionCreate()
    {
        $this->layout = "main";
        $model = new Messages();
        $teacher_id = \Yii::$app->user->identity->id;
        $students = $model->getStudentsByTeacherId($teacher_id);
        $stud_arr = array_column($students,'id');
        $impl = implode(",", $stud_arr);

       
        if ($model->load(Yii::$app->request->post())) {
            $model->sender = \Yii::$app->user->identity->id;
            
            $model->parent_id = $_POST['Messages']['receiver'];
            $model->teacher_id =\Yii::$app->user->identity->id;
            if($model->save()){
                Yii::$app->session->setFlash('success', "Message has been successfully sent!"); 
                
            }else {
                Yii::$app->session->setFlash('error', "Message send failed! Try again."); 
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'impl' => $impl,
            'teacher_id'=>$teacher_id,

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
        $messages = new Messages();
        $model = $this->findModel($id);
        $teacher_id = \Yii::$app->user->identity->id;
        $students = $messages->getStudentsByTeacherId($teacher_id);
        $stud_arr = array_column($students,'id');
        $impl = implode(",", $stud_arr);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'impl' => $impl,
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



    public function getUserByStudent($teacher_id) {
        $students = $this->getStudentsByTeacherId($teacher_id);
        $stud_arr = array_column($students,'id');
        $impl = implode(",", $stud_arr);
            $st = Student::find()->where("id IN ($impl)")->all();
            return $st;
    }
    
    //Dohvati sve roditelje 
    public function getParents($teacher_id){
        //Dohvati sve ucenike jednog odeljenja kome predaje ulogovani ucitelj
        $students = $this->getStudentsByTeacherId($teacher_id);
        //Izvuci kolonu user_id koja predstavlja id roitelja
        $parent_arr = array_column($students,'user_id');
        $impl = implode(",", $parent_arr);
        //Dohvati sve roditelje iz tabele user preko parent_arr niza
        $parents = User::find()->select(['id','first_name', 'last_name'])->where("id IN ($impl)")->all();

        return $parents;
    }


    //Dohvati sve ucenike jednog odeljenja kome predaje ulogovani ucitelj
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
}
