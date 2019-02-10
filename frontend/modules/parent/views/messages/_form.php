<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'receiver')->dropDownList(ArrayHelper::map(Student::find()->select(['student.id','user_id', 'CONCAT(user.first_name, " ", user.last_name) AS "first_name"'])->innerJoin('user', 'student.user_id = user.id')->where("student.id IN ($impl)")->all(), 'user_id', 'first_name'), ['prompt' => 'Select parent']) ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
