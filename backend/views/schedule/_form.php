<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'days_id')->textInput() ?>

    <?= $form->field($model, 'class_id')->textInput() ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
