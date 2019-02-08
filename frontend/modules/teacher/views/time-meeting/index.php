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

    <?php
    function getAllTermins($meeting) {
        foreach($meeting as $meet) {
            $interval = -15;
            $end = date_create($meet->end_at);
            $time = '';
            $termins = [];
            while($time != $end){
                $interval += 15;
                $time = date_create($meet->start_at);
                date_modify($time, $interval.' minutes');
                if($time == $end) {
                    return $termins;
                } else {
                    $termins[] = date_format($time, 'H:i');
                }
            }
            return $termins;
        }
    }
    $m = getAllTermins($meeting);
    print_r($m);

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
