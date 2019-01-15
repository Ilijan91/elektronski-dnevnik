<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\controllers\UserController;
use backend\controllers\RollController;
use backend\models\User;
use backend\models\Roll;

/* @var $this yii\web\View */
/* @var $model backend\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'year')->dropDownList([ 'I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', ], ['prompt' => '']) ?>
    
    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where('roll_id = 4')->all(), 'id', 'first_name', 'last_name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
