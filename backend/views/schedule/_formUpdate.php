<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\controllers\SubjectController;
use backend\models\Subject;
use backend\models\Department;
use backend\models\Schedule;
use backend\models\Classes;
 $mode = Schedule::find()->where(['department_id'=>1])->all();
// var_dump($mode)
foreach($mode as $m){
    print_r($m['subject_id']);
}


?>