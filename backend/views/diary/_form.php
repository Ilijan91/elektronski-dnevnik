<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Student;
use backend\controllers\StudentController;
use backend\controllers\SubjectController;
use backend\models\Subject;

/* @var $this yii\web\View */
/* @var $model backend\models\Diary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grade')->textInput() ?>

    <?= $form->field($model, 'final_grade')->textInput() ?>

    <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::find()->select(['id', 'CONCAT(first_name, " ",last_name) AS first_name'])->all(), 'id', 'first_name'), ['prompt' => 'Select student']) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->all(), 'id', 'title'), ['prompt' => 'Select subject']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
