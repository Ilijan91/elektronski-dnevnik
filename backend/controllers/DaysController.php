<?php

namespace backend\controllers;
use backend\models\Days;

class DaysController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDani(){
        
        $model = Days::find()->all();
        return $this->render('dani',[ 'model'=>$model]);
    }

}
