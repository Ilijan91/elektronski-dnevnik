
<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="teacher-default-index">
    
    <div class="container main">
        <h2>News feed</h2>
<?php

        //Prikaz vesti
        foreach($news as $m){
            $title = $m['title'];
            $body = $m['body'];
            $image =$m['image'];
            $created_at = $m['created_at'];
            $news[] =[$title, $body, $image,  $created_at];
        echo '
        <div class="row news">
            <div class="col-lg-5 col-md-5">
            '.Html::img(Url::to("@web/img/upload/$image"),["class"=>"img-responsive","alt"=>"news"]).'
            </div>
            <div class="col-lg-7">

            <h3>'.$title.'</h3>
            <p>'.$body.'</p>
            <span><i>'.$created_at.'</i></span>
            </div>
        </div>
        ';
        }
?>    
</div> 
</div>
