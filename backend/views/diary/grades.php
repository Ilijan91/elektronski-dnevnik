<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diary - '. $model[0]['student']['first_name'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diary-index">

    <h1><?= Html::encode($this->title) ?></h1>
  
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Subject</th>
            <th scope="col">Grades</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            
            <!-- <td> <?= $model[0]['subject']['title']?> </td> -->
            <td>
            <?php
        $grades = $model[0]['grade'];
        $subject = $model[0]['subject'];
        //echo count($subjects);
        // echo $grades['title'];
            for($i=0;$i<count($subjects);$i++){
                $predmet =$subjects[$i]['title'];
               echo $model[$i]['subject']['title'];
                
                echo '<hr>'; 

        ;
}
    
   
    
    ?>
    </td>
    <td>
    <?php 
     for($i=0;$i<count($subjects);$i++){
        echo ' - '. $model[$i]['grade']['title'];
        echo '<hr>'; 

;
}
     ?>
    </td>
    </tr>
    </tbody>
    </table>'
    <p>
        <?= Html::a('Create Diary', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
