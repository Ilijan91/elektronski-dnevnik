<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\teacher\models\TimeMeeting */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
print_r($termins);
?>
<div class="time-meeting-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'teacher_id',
            'day',
            'start_at',
            'end_at',
        ],
    ]) ?>

</div>
