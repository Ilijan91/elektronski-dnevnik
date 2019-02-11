<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Time Meetings';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-meeting-index container message-inbox">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Time Meeting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
    foreach($timeMeetingAppointment as $meeting) {
        if($meeting->parent_id == null) {
            echo '<div class="bg-success" style="border-radius:7px;">';
        } else {
            echo '<div class="bg-danger" style="border-radius:7px;">';
        }
        echo '<hr>';
        $term = date_create($meeting->term);
        echo '<p style="padding-left:15px;padding-right:15px;">' . date_format($term, 'H:i');
        if($meeting->parent_id != null) {
            echo '<span class="pull-right">' . $name = $user->getUserFullName($meeting->parent_id) . '</span>';
        } else {
            echo '<span class="pull-right"> There is no appointment for this termin</span>';
        }
        echo '</p>';
        echo '<hr>';
        echo '</div>';
    }
?>
</div>

</div>
