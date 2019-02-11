<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\parent\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conversation history';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$teacher_full_name = $teacher[0]['first_name'].' '.$teacher[0]['last_name'];
$parent_full_name =\Yii::$app->user->identity->first_name.' '.\Yii::$app->user->identity->last_name;
?>
<div class="messages-index container main">
    <h2><?=Html::encode($this->title) ?> <span class="department_name"><?= $parent_full_name?> <span></h2>
    <div class="message-inbox">
        <?php
        if(count($message < 1)){
            echo "<p>There is no messages o show</p>";
        }else{
             foreach($message as $msg) {
                if($msg['receiver'] == $parent_id){
                    echo '<div class="message received-msg">';
                        echo '<h4 class="message-sender">'.$teacher_full_name.'</h4>';
                        echo '<p class="message-body">'.$msg['text'].'</p>';
                        echo '<span class="message-date" >'.$msg['date'].'</span>';
                    echo '</div>'; 
                }else {
                    echo '<div class="message sent-msg">';
                    echo '<h4 class="message-sender">'.$parent_full_name.'</h4>';
                        echo '<p class="message-body">'.$msg['text'].'</p>';
                        echo '<span class="message-date" >'.$msg['date'].'</span>';
                    echo '</div>'; 
                }
            }
        } 
        ?>
        <?= Html::a('Send new message', ['create', 'teacher_id'=>$teacher_id], ['class' => 'btn btn-primary pull-right send_msg_btn'])?>
    </div>
</div>

