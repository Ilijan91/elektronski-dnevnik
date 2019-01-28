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
//$subjects= array_column($diary, 'title');
foreach($modelStudents as $modelSstudent){
  $students= $modelSstudent['id'];  
// //prikazi po uceniku ocene za sve predmete
  $array_students[$students] = array_filter($diary, function ($element) use ($students) {
       return ($element['student_id'] == $students);
      })
   ;
  
//    //ocene po predmetu
//    $grades['matematika']= array_column($array_students[$students], 'title');

// }
// foreach($array_students as $student){
//     foreach($subjects as $subj){
//         $arr[$subj] = array_filter($student, function ($element) use ($subj) {
//             return ($element['title'] == $subj);
//            })
//         ;
//     }
   
  }

  $m = filterSubjectsAndGradesPerStudent(5, 2, $diary);
  
  function filterSubjectsAndGradesPerStudent($student_id, $subject_id, $diary){
    $arr[$student_id] = array_filter($diary, function ($element) use ($student_id) {
    return ($element['student_id'] == $student_id);
    });
   return $arr;
  
}
$stud_id = array_column($modelStudents, 'id');
?>
   <?php
foreach($stud_id as $id){
   
   echo "<br>";
//    for($i=0;$i<count($diary);$i++){
    print_r($array_students);
    echo "<hr>"; 
// }
   
    
//    echo "<hr>"; 
//     echo $array_students[$id][0];
   
}
   
    echo "arr arej"; 
    echo "<hr>"; 
   print_r($m);
   echo "<hr>"; 
   echo "<hr>"; 
echo count($diary);
  
    // //  print_r($stud_id);
    // //  echo count($array_students);
    //  foreach($diary as $id){
    //     echo 'diary:';
    //     print_r($id);
    
    //    // $array_students[$id];
      
        
    //     echo "<hr>"; 
    //     // echo $array_students[$id][0];
       
    // }
  //  print_r($array_students);
    echo 'dsffffffffffff00';
    echo "<hr>"; 

//foreach($stud_id as $id){
    //echo $id;

   // echo "<br>";
   // $array_students[$id];
   // print_r($array_students[$id]);
    
  //  echo "<hr>"; 
    // echo $array_students[$id][0];
   
//}
    

   ?>
    
</div>
    </div>