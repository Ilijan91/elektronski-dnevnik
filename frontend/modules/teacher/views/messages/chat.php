<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */

$this->title = 'Conversation history';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$parent_full_name = $parent[0]['first_name'].' '.$parent[0]['last_name'];
$teacher_full_name =\Yii::$app->user->identity->first_name.' '.\Yii::$app->user->identity->last_name;
?>
<div class="messages-index container main">
    <h2><?=Html::encode($this->title) ?> <span class="department_name"><?= $parent_full_name?> <span></h2>
    <div class="message-inbox">
        <?php
             foreach($message as $msg) {
                if($msg['receiver'] == $teacher_id){
                    echo '<div class="message received-msg">';
                        echo '<h4 class="message-sender">'.$parent_full_name.'</h4>';
                        echo '<p class="message-body">'.$msg['text'].'</p>';
                        echo '<span class="message-date" >'.$msg['date'].'</span>';
                    echo '</div>'; 
                }else {
                    echo '<div class="message sent-msg">';
                    echo '<h4 class="message-sender">'.$teacher_full_name.'</h4>';
                        echo '<p class="message-body">'.$msg['text'].'</p>';
                        echo '<span class="message-date" >'.$msg['date'].'</span>';
                    echo '</div>'; 
                }
            }
        ?>
        
            <?= Html::a('Send new message', ['create', 'teacher_id'=>$teacher_id], ['class' => 'btn btn-success send_msg_btn']) ?>
      
    </div>
</div>