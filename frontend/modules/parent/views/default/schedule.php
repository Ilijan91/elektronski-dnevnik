<?php
//print_r($rasp);
use yii\helpers\Html;


?> 

<?php
//$model(svi podaci dobijeni prilikom kreiranje rasporeda casova), $modelDays(dani u nedelji) i $modelClasses(casovi) salje ScheduleController
foreach($rasp as $raspored){
  //Kreiramo array $day u koji smestamo dane u nedelji
  $day= $raspored['days_title'];  
  //Kreiramo array $array_day gde je key dan u nedelji, a value je array sa casovima po rasporedu za taj dan. 
  //SVI PODACI IZ RASPOREDA PO DANU
  //Sve podatke za odredjeni dan dobijamo preko funkcije array_filter koja prolazi kroz sve elemente $model i smesta ih u array_day po danima
  $array_day[$day] = array_filter($rasp, function ($element) use ($day) {
       return ($element['days_title'] == $day);
      })
   ;
   
   //PREDMETI IZ RASPOREDA PO DANU
   //funkcija array_column izvlaci samo casove po danu iz $array_day niza i smesta ih u niz $subjects
   $subjects[$day]= array_column($array_day[$day], 'subject_title');
   
}

?>
<div class="schedule-form">
  <div class="row">

  <?php foreach($days as $raspDay){
            $day= $raspDay['title'];
            echo '
            <div class="col-lg-2  ">
              <h2>'.$day.'</h2>';
            foreach($subjects[$day] as $subject){
             echo' <p>'.$subject.'</p>';
            }
           echo '</div>';// End of col
             
        }?>

</div><!-- End of row -->
</div><!-- End of schedule form -->
 
</div>

