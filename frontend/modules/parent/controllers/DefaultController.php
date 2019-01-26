<?php

namespace frontend\modules\parent\controllers;
use backend\models\News;
use backend\models\Student;
use backend\models\StudentSearch;
use backend\models\User;
// use backend\controllers\NewsController;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `parent` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "main";
        $news = News::find()->all();
        return $this->render('index', [
            'news' => $news,
        ]);
    }
    public function actionGrade($id) {
        $student = Student::find()->where("user_id = $id")->all();
        $this->layout = "main";
        return $this->render('grade', [
            'student' => $student,
        ]);
    }
    protected function findModel()
    {
        if (($model = Yii::$app->user->identity->id) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
