<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\teacher\models\TimeMeeting */

$this->title = 'Update Time Meeting: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Time Meetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="time-meeting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
