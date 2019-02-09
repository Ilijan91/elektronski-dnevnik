<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Time Meetings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-meeting-index container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Time Meeting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'teacher_id',
            'day',
            'start_at',
            'end_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
