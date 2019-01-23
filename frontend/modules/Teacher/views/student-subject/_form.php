<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\Teacher\models\Student;
use frontend\modules\Teacher\models\Subject;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::find()->select(['id', 'CONCAT(first_name, " ", last_name) AS "first_name"'])->all(), 'id', 'first_name'), ['prompt' => 'Select student']) ?>

    <?= $form->field($model, 'subject_id')->checkboxList(ArrayHelper::map(Subject::find()->all(),'id','title'))->label($model->getAttributeLabel('subject_id')); ?>
    <?= Html::checkbox(null, false, [
    'label' => 'Check all',
    'class' => 'check-all',
]);?>  

    <?= $form->field($model, 'grade')->textInput(); ?>

    <?= $form->field($model, 'final_grade')->textInput(); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
