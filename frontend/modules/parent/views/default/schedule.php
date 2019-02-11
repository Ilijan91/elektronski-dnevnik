<?php

use yii\helpers\Html;

?>
<div class="container main">

<h2>Schedule <span class="department_name"><?=$department_name?><span></h2>

<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="schedule-form">
<div class="row schedule">
            <div class="col-lg-1 col-md-1 col-sm-1">
            <div class="schedule_days ">
                <h4>Class</h4>
            </div>
                <?php
                for($i=1;$i<8;$i++){
                    echo '<p class="schedule_classes">'.$i.'. </p>';
                }
                ?>
            </div>
        
        <div class="col-lg-11 col-md-11 col-sm-11">
        <?php foreach($modelDays as $modelDay){
                    $day= $modelDay['title'];
                    echo '
                    <div class="schedule-rows col-md-2">
                    <div class="schedule_days"><h4>'.$day.'</h4></div>';
                    
                    foreach($subjects[$day] as $subject){
                    echo' <p>'.$subject.'</p>';
                    }
                echo '</div>';// End of col
                    
        }?>

</div><!-- End of row -->
</div><!-- End of schedule form -->
 </div>
</div>


<div class="teacher-default-index">
    <div class="container main">
        <h2>Schedule <span class="department_name"><?=$department_name?><span></h2>
        
        <?php
        //$model(svi podaci dobijeni prilikom kreiranje rasporeda casova), $modelDays(dani u nedelji) i $modelClasses(casovi) salje ScheduleController
        foreach($modelDays as $modelDay){
        //Kreiramo array $day u koji smestamo dane u nedelji
        $day= $modelDay['title'];  
        //Kreiramo array $array_day gde je key dan u nedelji, a value je array sa casovima po rasporedu za taj dan. 
        //SVI PODACI IZ RASPOREDA PO DANU
        //Sve podatke za odredjeni dan dobijamo preko funkcije array_filter koja prolazi kroz sve elemente $model i smesta ih u array_day po danima
        $array_day[$day] = array_filter($model, function ($element) use ($day) {
            return ($element['days_title'] == $day);
            })
        ;
        
        //PREDMETI IZ RASPOREDA PO DANU
        //funkcija array_column izvlaci samo casove po danu iz $array_day niza i smesta ih u niz $subjects
        $subjects[$day]= array_column($array_day[$day], 'subject_title');
        
        }

        ?>
        <div class="row schedule">
            <div class="col-lg-1">
            <div class="schedule_days ">
                <h4>Classes</h4>
            </div>
                <?php
                for($i=1;$i<8;$i++){
                    echo '<p class="schedule_classes">'.$i.'. </p>';
                }
                ?>
            </div>
        
        <div class="col-lg-11">
        <?php foreach($modelDays as $modelDay){
                    $day= $modelDay['title'];
                    echo '
                    <div class="col-lg-2">
                    <div class="schedule_days"><h4>'.$day.'</h4></div>';
                    
                    foreach($subjects[$day] as $subject){
                    echo' <p>'.$subject.'</p>';
                    }
                echo '</div>';// End of col
                    
        }?>

        </div><!-- End of row -->
</div> <!-- End of container main -->
</div> <!-- End ofteacher-default-index -->
