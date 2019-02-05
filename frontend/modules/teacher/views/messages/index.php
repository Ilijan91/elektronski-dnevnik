<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;
use frontend\modules\teacher\models\Messages;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\parent\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="messages-index">
<h1><?=

Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Send Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    print_r($message);
    print_r($sender);
    if(count($message) < 1){
        echo "There's no messages to show.";
    }else{
        // return $mess;
   
        echo '<div style="border: 1.5px solid grey;">';
        foreach($sender as $send) {
            foreach($message as $text) {
                echo '<h4>'.$sender['first_name'] . ' ' . $sender['last_name'].'</h4>';
                echo '<p>'.$text['text'].'</p>';
            }
        }
        echo '</div>';  
    }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'text:ntext',
            [
                'attribute' => 'sender',
                'value' => 'sender'
            ],
            [
                'attribute' => 'receiver',
                'value' => 'sender'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>

    
</div>
