<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="parent-default-index">
    <?php
        for($i=0;$i<count($news);$i++) {
            echo '<h1>' . $news[$i]['title'] . '</h1>';
            echo '<p>' . $news[$i]['body'] . '</p>';
            echo '<img src="../../img/upload/'.$news[$i]['image'].'" width=200 height=200 alt="">';
        }
 //Html::a('Grade', ['grade', 'id' => $model->id], ['class' => 'btn btn-primary']) 

// print_r($model);
    ?>

    
</div>
