<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Diary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grade')->textInput() ?>

    <?= $form->field($model, 'final_grade')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>