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
use common\models\LoginForm;
use yii\helpers\Url;
/**
 * Default controller for the `director` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()) {
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
        } else {
            $this->redirect(Url::to(['/site/index']));
        }
    }

    public function actionStatistika() {
        $this->layout = 'main';

        $stsub = new StudentSubject();
        $avg = $stsub->getAvgGrade();
        foreach($avg as $average) {

            $item[] = $average;
        }
        $ite = json_encode($item);
        file_put_contents("prosek.json", $ite);
        return $this->render('statistika', [
        ]);
    }

    public function actionStatistika_po_odeljenju() {
        $this->layout = 'main';

        $stsub = new StudentSubject();
        $avg = $stsub->getAvgGradeByDepartment();
        foreach($avg as $average) {

            $item[] = $average;
        }
        $ite = json_encode($item);
        file_put_contents("prosek_po_odeljenju.json", $ite);
        return $this->render('statistika_po_odeljenju', [
        ]);
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
