<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Subject;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */

// $this->title = 'Update Schedule: {nameAttribute}';
// $this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">  
<?php
$form = ActiveForm::begin(); 
foreach($model as $m){
   print_r($m);
   echo "<br>";
    
  
}

foreach($model as $m){
    echo '<div class="col-lg-2 col-md-2">
            <h2>'.$m['days_title'].'</h2>
    ';
    echo "</div>";  //end of col
   
 }
?>
<div class="row">   
    <?php
    //Prvo proveravamo koliko imamo dana u nedelji i za svaki dan otvaramo petlju, zatim novu kolonu (div col-lg-2) gde prikazujemo u h2 tagu naziv dana
    for($j=0;$j<count($modelDay);$j++){
        $day = $modelDay[$j]['title'];
       
        echo "<div class='col-lg-2 col-md-2'>";
            echo '<h2>'.$modelDay[$j]['title'].'</h2>';
            //sa svaki dan proveravamo koliko imamo casova i otvaramo petlju za svaki cas
            for($i=0;$i<count($modelClasses);$i++){
                //dodeljujemo jedinstvenu vrednost name atributu za subject_id kako bismo pratili post zahteve koje saljemo nakon submitovanja forme. Tu vrednost za subject_id definisemo kao naziv dana u nedelji i redni broj u petlji
                $subject_name_attribute = $day.$i;
                    echo '<span>Class - '.$modelClasses[$i]['title'].'</span>';
                    //echo '<span>'.$form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->select(['id', 'title'])->where('id = id')->all(), 'id', 'title' ),['prompt' => 'Select day', 'name'=>$subject_name_attribute]). "</span>" ;
             }
        echo "</div>";  //end of col
    }
    ?>
    </div>
  <?php ActiveForm::end(); ?>
</div>
