
<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="teacher-default-index">
    <div class="front-hero">
        <div class="cover-hero text-center">
            <h1>Welcome, <?= $user_full_name?></h1>
            <p>This is <?= $roll?> panel for school <b><?= $school_name?></b> .</p>
        </div>
    </div>
    <div class="container main">
        <h2>Latest news</h2>
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
    '.Html::img(Url::to("@web/img/$image"),["class"=>"img-responsive","alt"=>"news"]).'
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
 <p class="text-center">
<?= Html::a('See all news', ['news'], ['class' => 'btn btn-success']) ?>
</p>

  
</div> 
</div>
