<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Student;
use backend\models\Subject;
use backend\models\Grade;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map($modelStudents, 'id', 'full_name'), ['prompt' => 'Select student']) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->select(['id', 'title'])->all(), 'id', 'title'), ['prompt' => 'Select subject']) ?>

    <?= $form->field($model, 'grade_id')->dropDownList(ArrayHelper::map(Grade::find()->select(['id', 'title'])->all(), 'id', 'title'), ['prompt' => 'Select grade']) ?>

    <?= $form->field($model, 'final_grade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
