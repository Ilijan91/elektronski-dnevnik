<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Department;
use backend\models\User;
use frontend\modules\parent\models\Messages;
use backend\controllers\DepartmentController;
use frontend\modules\parent\controllers\DefaultController;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sender')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'receiver')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
