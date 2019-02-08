<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Time Meetings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-meeting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Time Meeting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    // $date = new Time();
    // print_r($date);
    // $t = new DateTime();
    // echo $t;
    foreach($meeting as $meet) {
        // echo $meet->start_at . '<br>';
        // $t->modify('+15 minutes');
        // echo $datetime->format('H:i:s');
        // $words = [' AM', ' PM'];
        // $rep = str_replace($words, ':00', $meet->start_at);
        // $rep = strstr($meet->start_at, $words, true);
        // $rep = str_replace('PM', '', $meet->start_at);
        // echo $rep;
        // $time = strtotime($meet->start_at);
        // $time = DateTime::setTime($meet->start_at);
        for($i=strtotime($meet->start_at);$i<strtotime($meet->end_at);$i+=900) {
            // if($i==0) {
        // $times[] = $meet->start_at;
        $times = date('H:i:s', $i) . '<br>';
    // }
            // $time = [];
            // $newTime = $times;
        // echo $newTime->modify('+15 minutes') . '<br>';
        // $times[$i] = $newTime;
        // $times[$i] = $newTime[$i];
        echo $times[$i];
        // $time->modify('+15 minutes');
        // $meet->start_at->format('H:i:s');
        }
        $min = strtotime($meet->start_at) + 900;
        $day = date('H:i:s', $min);
        echo $day;
    }

    // print_r($meeting);

    echo TimePicker::widget([
        'name' => 't1',
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ],
        'value' => '21:30:00',
        'value' => '22:30:00'
    ]);
    ?>

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
