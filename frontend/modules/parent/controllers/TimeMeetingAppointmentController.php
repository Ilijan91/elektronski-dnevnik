<?php

namespace frontend\modules\parent\controllers;
use frontend\modules\teacher\models\TimeMeetingAppointment;

class TimeMeetingAppointmentController extends \yii\web\Controller
{
    public function actionIndex($department_id)
    {
        $parent_id = Yii::$app->user->identity->id;
        $teacher_id = $this->getTeacherIdByDepartmentId($department_id);

        //Dohvati sve termine za odredjeni sastanak
        $timeMeetingAppointmentModel = new TimeMeetingAppointment;
        $termins = $timeMeetingAppointmentModel->getAllFreeMeetingTerminsForParent($teacher_id);
        return $this->render('index', [
            'termins'=>$termins,
        ]);
    }
    function getTeacherIdByDepartmentId($department_id){
        $teacher_id = Department::find()->select(['user_id'])->where(['id'=>$department_id])->all();
        return $teacher_id;
    }
}
