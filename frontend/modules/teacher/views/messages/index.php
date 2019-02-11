<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\User;
use frontend\modules\teacher\models\Messages;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\parent\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
// $this->params['breadcrumbs'][] = $this->title;
$teacher_full_name =\Yii::$app->user->identity->first_name.' '.\Yii::$app->user->identity->last_name;
?>

<div class="messages-index container main">
    <h2><?=Html::encode($this->title) ?> <span class="department_name"><?= $teacher_full_name?> <span></h2>
    
    <div class="message-inbox">
        <h3>List of all parents</h3>
        <?php
            
             foreach($parents as $parent) {
                foreach($students as $student){
               
                if($student->user_id == $parent->id){
                    echo '<div class="message">';
                        echo '<div class="pull-left user-info">';
                            echo Html::a("$parent->first_name $parent->last_name", ['chat', 'parent_id'=>$parent->id], ['class' => '', ]) ;
                            echo '<p class="">'.$student->first_name.' '.$student->last_name.'</p>';
                        echo '</div>';
                        echo '<div class="pull-right">'.Html::a('See conversation', ['chat', 'parent_id'=>$parent->id], ['class' => 'btn btn-primary pull-right']).'</div>';
                    echo '</div>';
                }// End of if statement
            } // End of students foreach
            }// End of parents foreach
        // End of else
        ?>
        <p>
            <?= Html::a('Send new message', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div><!-- End of message inbox -->
</div><!-- End of message index main container -->
