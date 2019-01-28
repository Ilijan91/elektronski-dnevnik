<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Student;
use backend\models\Subject;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = 'Create Student Subject';
$this->params['breadcrumbs'][] = ['label' => 'Student Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-subject-create">
    <div class="container main">
        <div class="student-subject-form">

            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::find()->select(['id', 'CONCAT(first_name, " ", last_name) AS "first_name"'])->all(), 'id', 'first_name'), ['prompt' => 'Select student']) ?>

                <?= $form->field($model, 'subject_id')->textInput() ?>

                <?= $form->field($model, 'grade')->textInput() ?>

                <?= $form->field($model, 'final_grade')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>