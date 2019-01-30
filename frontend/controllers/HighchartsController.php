<?php
namespace frontend\controllers;
use yii\web\Controller;

class HighchartsController extends Controller {
    public function actionIndex(){
        return $this->render('index');
    }
}