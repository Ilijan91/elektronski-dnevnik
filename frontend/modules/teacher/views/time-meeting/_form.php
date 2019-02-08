<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\modules\teacher\models\TimeMeeting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-meeting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teacher_id')->textInput() ?>

    <?= $form->field($model, 'day')->dropDownList([ 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', ], ['prompt' => 'Select day']) ?>

    <?= $form->field($model, 'start_at')->widget(TimePicker::classname(), ['pluginOptions' => [
            'showSeconds' => false,
            'showMeridian' => false,
            'minuteStep' => 15,
            // 'secondStep' => 60,
        ]]) ?>

    <?= $form->field($model, 'end_at')->widget(TimePicker::classname(), ['pluginOptions' => [
            'showSeconds' => false,
            'showMeridian' => false,
            'minuteStep' => 15,
            'secondStep' => 60,
        ]]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
