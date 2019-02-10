<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */

$this->title = 'Conversation history';
// $this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$parent_full_name = $parent[0]['first_name'].' '.$parent[0]['last_name'];
$teacher_full_name =\Yii::$app->user->identity->first_name.' '.\Yii::$app->user->identity->last_name;
?>
<div class="messages-index container main">

    <h2><?=Html::encode($this->title) ?> <span class="department_name"><?= $parent_full_name?> <span></h2>
    <div class="message-inbox">
        <?php
        if($message == null){
            echo "There's no messages to show.";
        }else{ 
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
        }
        ?>
        
        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($messages, 'text')->textarea(['rows' => 6, 'label' => '']) ?>

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>
      
    </div>
    
</div>