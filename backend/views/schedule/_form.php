<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\controllers\SubjectController;
use backend\models\Subject;
use backend\controllers\DepartmentController;
use backend\models\Department;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'day')->dropDownList([ 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', ], ['prompt' => 'Select day']) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->all(), 'id', 'title'),['prompt' => 'Select subject']) ?>

    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->select(['id', 'CONCAT(year, "/" ,name) AS "year"'])->where('id = id')->all(), 'id', 'year' ),['prompt' => 'Select department']) ?>



    <?= $form->field($model, 'class')->dropDownList([ '1.' => '1.', '2.' => '2.', '3.' => '3.', '4.' => '4.', '5.' => '5.', '6.' => '6.', '/' => '/', ], ['prompt' => 'Select class'])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
