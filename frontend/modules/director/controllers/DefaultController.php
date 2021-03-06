<?php

namespace frontend\modules\director\controllers;

use Yii;
use yii\web\Controller;
use backend\models\News;
use backend\models\Roll;
use backend\models\Student;
use backend\models\StudentSubject;
use backend\models\Department;
use backend\models\User;
use backend\controllers\NewsController;
use backend\controllers\DepartmentController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * Default controller for the `director` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
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
                        'roles' => ['director'],
                        'matchCallback' => function($rules, $action){
                            //module = \yii::$app->controller->module->id;
                            $action = Yii::$app->controller->action->id;
                            $controller = Yii::$app->controller->id;
                            $route = "director/$controller/$action";
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
    public function actionIndex()
    {
        //Globalna promenljiva school name iz config-main.php params
        $school_name =\Yii::$app->params['school_name'];
        
        //Svi podaci o ulogovanom korisniku
        $user = \Yii::$app->user->identity;

        $roll =$this->getLoggedUserRollTitle($user->roll_id);
        $user_full_name = $this->getLoggedUserFullName($user);

        $news = News::find()->orderBy(['created_at'=> SORT_DESC])->all();
        
        $this->layout = 'main';
        return $this->render('index', [
            'news'=> $news,
            'user_full_name'=> $user_full_name,
            'roll'=>$roll,
            'school_name'=>$school_name
        ]);
    }

    public function actionStatistics() {
        $this->layout = 'main';

        $stsub = new StudentSubject();
        $avg = $stsub->getAvgGrade();
        if(empty($avg)){
            $msg= "<h4>There is no data for department yet!</h4>";
            return $this->render('empty', [
                'msg'=>$msg
                ]);
        }else{
            foreach($avg as $average) {

                $item[] = $average;
            }
            $ite = json_encode($item);
            file_put_contents("prosek.json", $ite);
            return $this->render('statistics', [
            ]);
        } 
    }

    public function actionStatistics_per_department() {
        $this->layout = 'main';

        $stsub = new StudentSubject();
        $avg = $stsub->getAvgGradeByDepartment();
       
        if(empty($avg)){
            $msg= "<h4>There is no data for department yet!</h4>";
            return $this->render('empty', [
                'msg'=>$msg
                ]);
        }else{
            foreach($avg as $average) {
                $item[] = $average;
            }
            $ite = json_encode($item);
            file_put_contents("prosek_po_odeljenju.json", $ite);
            return $this->render('statistics_per_department', [
                ]);
        }
       
       
       
        
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
