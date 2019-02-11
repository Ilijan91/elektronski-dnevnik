<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\teacher\models\TimeMeeting */

$this->title = 'Create Time Meeting';
?>
<div class="time-meeting-create message-inbox">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
