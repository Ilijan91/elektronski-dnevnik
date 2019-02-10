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
    
// if($meeting == null){
//     echo 'There is no data to show!';
// }else{
//     // foreach($meeting as $m){
//     //     echo $m;
//     //     echo '<hr>';
//     // }
// }
    ?>

</div>
