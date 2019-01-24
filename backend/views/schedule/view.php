<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use backend\controllers\DaysController;
use backend\controllers\ScheduleController;
use backend\controllers\ClassesController;
use backend\models\Days;
use backend\models\Classes;
use backend\models\Schedule;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */

// $this->title = "View";
// $this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-view">


    <p>
        
    </p>

    
    <table class="table">
    <tr>
        <?php
                // echo '<th>Classes</th>';
                for($i=0;$i<count($modelDay);$i++) {
                    // echo '<tr>';
                        echo '<th>'.$modelDay[$i]['title'].'</th>';
                        echo '</tr>';
                        // for($j=0;$j<count($modelClasses);$j++) {
                            
                        // }
                        for($m=0;$m<count($modelClasses);$m++) {
                            echo '<tr>';
                            echo '<td>'.$modelClasses[$m]['title'].'</td>';
                                echo '<td>'.$model2[$m]['subject']['title'].'</td>';
                            // $v[]++;
                            // if($i%6==0) {
                            //     echo '<td>'.$model2[$m]['subject']['title'].'</td>';
                            //     return $model2[$m]['subject']['title'];
                            // } else {
                            //     echo '<td>'.$model2[$m]['subject']['title'].'</td>';
                                $v[] = $model2[$m]['subject']['title'];
                            //     // echo '<td>'.$v.'</td>';
                            // }
                    echo '</tr>';
                            // echo '<tr>';
                            //     echo '<td>'.$model2[$m]['subject']['title'].'</td>';
                            // echo '</tr>';
                            // if($m==count($modelDay)) {
                            //     $m=0;
                            // }
                }
                // return $model2[$m]['subject']['title'];
                        
                }

    //     foreach($modelDay as $day) {
    //             echo '<th>'.$day['title'].'</th>';
    //             // print_r($model2);
    //     }
    //         echo '</tr>';

    //             for($i=0;$i<count($modelClasses);$i++) {
    //                 // $j=$i+1;
    //         echo '<tr>';
    //     // print_r($model2);
    //     echo '<td>'.$model2[$i]['classes']['title'].'</td>'; 

    //                 for($j=0;$j<count($modelDay);$j++) {
    //                     print_r($model2[$j]['days_id']);
    //                     print_r($modelDay[$j]);
    //                 // $j=$i+7;
    //                     $v = $modelDay[$j];
    //                     $v++;
    //                     // return $v;
    //                     // if($model2[$j]['days_id'] == 1 || $model2[$j]['days_id']%7==0) {
    //                     // echo '<td>'.$model2[$j]['subject']['title'].'</td>'; 

    //                 // } else {
    //                     echo '<td>'.$model2[$i]['subject']['title'].'</td>';
    //                     return $model2[$i];
    //                 // }                     
    //                 // for($m=0;$m<count($model2);$m++) {
    //                 //     echo '<td>'.$model2[$m]['subject']['title'].'</td>'; 

    //                 // }
    //                 }
    //                     // echo '<td>'.$model2[$i]['classes']['title'].'</td>';
    //                     // echo '<td>'.$model2[$j]['subject']['title'].'</td>';
    //                     // for()
    //                     echo '</tr>';

    // }


        // for($i=0;$i<count($modelClasses);$i++) {
        //     // echo '<tr>';
        //     //     echo '<th class="col-lg-2 col-md-2">'.$model2->days['title'].'</th>';
        //     // echo '</tr>';
        //     foreach($model2 as $model) {
        //         echo '<td class="col-lg-2 col-md-2">'.$model2[$i]->days['title'].'</td>';
        //     }
        //     echo '<tr>';
        //         echo '<td class="col-lg-2 col-md-2">'.$model2[$i]->classes['title'].'</td>';
        //         echo '<td class="col-lg-2 col-md-2">'.$model2[$i]->subject['title'].'</td>';
        //     echo '</tr>';
        // }
        // foreach($model2 as $subject2) {
        //     foreach($modelDay as $subject) {
        //         echo '<th class="col-lg-2 col-md-2">'.$subject['title'].'</th>';
                
        //     }
        //     echo '<tr>';
        //         echo '<td class="col-lg-2 col-md-2">'.$subject2['classes']['title'].'</td>';
        //         echo '<td class="col-lg-2 col-md-2">'.$subject2['subject']['title'].'</td>';
        //     echo '</tr>';
        //     }
    //  for($i=0;$i<count($model2);$i++) {
    //      echo '<tr>';
    //     echo '<th class="col-lg-2 col-md-2">'.$modelDay['title'].'</th>';
    //  echo '</tr>';
    //  echo '<tr>';
    //     echo '<td class="col-lg-2 col-md-2">'.$model2[$i]->classes['title'].'</td>';
    //     echo '<td class="col-lg-2 col-md-2">'.$model2[$i]->subject['title'].'</td>';
    //  echo '</tr>';
    //  }
    //  for($j=0;$j<count($modelClasses);$j++) {
    //     echo '<tr>';
    //         echo '<td>'.$model2[$j]->subject['title'].'</td>';
    //         // $classes_id = $j+1;
            
    //     echo '</tr>';
    //     }
    
    // foreach($modelDay as $day) {
    //     echo '<th>'.$day['title'].'</th>';
    //     foreach($model2 as $subject) {
    //         echo '<tr>';
    //         echo '<td>'.$subject->subject['title'].'</td>';
    //         echo '</tr>';

    //     }
    // }
        
        ?>
    </table>
</div>
