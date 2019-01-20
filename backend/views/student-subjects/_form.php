<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Student;
use backend\models\Subject;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentSubjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-subjects-form">

    <?php 
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::find()->select(['id', 'CONCAT(first_name, " ", last_name) AS "first_name"'])->all(), 'id', 'first_name'), ['prompt' => 'Select student']) ?>

    <?= $form->field($model, 'subject_id')->checkboxList(ArrayHelper::map(Subject::find()->all(),'id','title'))->label($model->getAttributeLabel('subject_id')); ?>
    <?= Html::checkbox(null, false, [
    'label' => 'Check all',
    'class' => 'check-all',
]);?>  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
