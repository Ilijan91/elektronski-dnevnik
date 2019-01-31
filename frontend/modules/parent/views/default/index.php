<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="director-default-index">
    <div class="front-hero">
        <div class="cover-hero text-center">
            <h1>Welcome, <?= $user_full_name?></h1>
            <p>This is <?= $roll?> panel for school <b><?= $school_name?></b> .</p>
        </div>
    </div>
    <div class="container main">
        <h2>Latest news</h2>

        <div class="parent-default-index">
            <?php
                for($i=0;$i<count($news);$i++) {
                    echo '
                    <div class="row news">
                        <div class="col-lg-5 col-md-5">
                        '.Html::img(Url::to('@web/img/upload/'.$news[$i]['image']),["class"=>"img-responsive","alt"=>"news"]).'
                        </div>
                        <div class="col-lg-7">
                            <h3>'.$news[$i]['title'].'</h3>
                            <p>'.$news[$i]['body'].'</p>
                            <span><i>'.$news[$i]['created_at'].'</i></span>
                        </div>
                    </div>';
                  
                }
        //Html::a('Grade', ['grade', 'id' => $model->id], ['class' => 'btn btn-primary']) 

        // print_r($model);
            ?>

            
        </div><!-- End of parent-default-index -->
</div><!-- End of container-main -->
    
