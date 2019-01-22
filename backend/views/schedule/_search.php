<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Department;

/* @var $this yii\web\View */
/* @var $model backend\models\ScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<<<<<<< HEAD
    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'days_id') ?>

    <?= $form->field($model, 'class_id') ?>

    <?= $form->field($model, 'subject_id') ?>

=======
>>>>>>> 79c1607dc6a2a34e15375b0a400caed5004f3ae8
    <?= $form->field($model, 'department_id') ?>

   

    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
