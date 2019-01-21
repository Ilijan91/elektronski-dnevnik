<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Student;
use backend\models\Subject;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::find()->select(['id', 'CONCAT(first_name, " ", last_name) AS "first_name"'])->all(), 'id', 'first_name'), ['prompt' => 'Select student']) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->select(['id', 'title'])->all(), 'id', 'title'), ['prompt' => 'Select subject']) ?>

    <?= $form->field($model, 'grade')->textInput() ?>

    <?= $form->field($model, 'final_grade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
