<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\Teacher\models\StudentSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diary';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-subject-index">
<div class="container main">
<h2><?= Html::encode($this->title) ?> <span class="department_name"><?=$department_name?><span></h2>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add single grade per student', ['create', 'department_id' =>$department_id], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Add grades for multiple students per subject', ['create_grades_per_subject', 'department_id' =>$department_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
//$model(svi podaci dobijeni prilikom kreiranje rasporeda casova), $modelDays(dani u nedelji) i $modelClasses(casovi) salje ScheduleController
foreach($modelStudents as $modelSstudent){
  //Kreiramo array $day u koji smestamo dane u nedelji
  $students= $modelSstudent['id'];  
  //Kreiramo array $array_day gde je key dan u nedelji, a value je array sa casovima po rasporedu za taj dan. 
  //SVI PODACI IZ RASPOREDA PO DANU
  //Sve podatke za odredjeni dan dobijamo preko funkcije array_filter koja prolazi kroz sve elemente $model i smesta ih u array_day po danima
  $array_students[$students] = array_filter($diary, function ($element) use ($students) {
       return ($element['student_id'] == $students);
      })
   ;
   
   //PREDMETI IZ RASPOREDA PO DANU
   //funkcija array_column izvlaci samo casove po danu iz $array_day niza i smesta ih u niz $subjects
   $grades[$students]= array_column($array_students[$students], 'subject_title');
   
}

?>
   <?php
//  print_r($array_students[6][1]);
//    echo "<hr>";
//    echo "<br>";
//    echo "<br>";
    $stud_id = array_column($modelStudents, 'id');
// print_r($stud_id);
foreach($stud_id as $id){
    echo $id;
    echo "<br>";
    // $array_students[$id]
    print_r($array_students[$id]);
    // echo $array_students[$id][0];
}
//     for($i=1;$i<10;$i++){
//         echo '<p class="schedule_classes">'.$i.'. </p>';
//         print_r($array_students[$i]);
//     // print_r($d);
//     //  echo $d['first_name'];
//    echo "<hr>";
//    }

   ?>
    
</div>
    </div>