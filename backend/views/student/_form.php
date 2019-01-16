<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\controllers\UserController;
use backend\controllers\DepartmentController;
use backend\models\User;
use backend\models\Department;


/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JMBG')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->select(['id', 'CONCAT(first_name, " ", last_name) AS "first_name"'])->where('roll_id = 4')->all(), 'id', 'first_name')) ?>

    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->select(['id', 'CONCAT(year, " ", name) AS "year"'])->all(), 'id', 'year')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
