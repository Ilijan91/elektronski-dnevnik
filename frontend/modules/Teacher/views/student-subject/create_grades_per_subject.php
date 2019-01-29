<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Student;
use backend\models\Subject;
use backend\models\Grade;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = 'Create Student Subject';
$this->params['breadcrumbs'][] = ['label' => 'Student Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$subjects = Subject::find()->all();
//Izbaci iz niza vrednost za predmete /, ona se koristi samo za raspored casova
unset($subjects[9]);
?>
<div class="student-subject-create">
    <div class="container main">
        <div class="student-subject-form">

            <?php $form = ActiveForm::begin(); ?>
                <div class="row">   
                <?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map($subjects, 'id', 'title'), ['prompt' => 'Select subject']) ?>
                <?php
                //Prvo proveravamo koliko imamo ucenika u odeljenju i za svakog otvaramo petlju, zatim novu kolonu (div col-lg-2) gde prikazujemo u h2 tagu ime ucenika
                for($j=0;$j<count($modelStudents);$j++){
                    $student_id = $modelStudents[$j]['id'];
                    $student_name = $modelStudents[$j]['first_name'].' '.$modelStudents[$j]['last_name'];

                    echo "
                    <div class='row'>
                    <div class='col-lg-6 col-md-6'>";
                   // echo '<span>'.$form->field($model, 'student_id')->dropDownList(ArrayHelper::map($modelStudents, 'id', 'first_name' ),['prompt' => 'Select student', 'name'=>'ff    ']). "</span>" ;
                   echo '<span>'. Html::textInput("$student_id", $student_id, ['readonly' => true, 'class' => 'form-control']). "</span>" ;
                       //echo '<h4>'.$modelStudents[$j]['first_name'].'</h4>';
                        //petlja za ocene
                        // for($i=0;$i<6;$i++){
                            //dodeljujemo jedinstvenu vrednost name atributu za grade kako bismo pratili post zahteve koje saljemo nakon submitovanja forme. Tu vrednost za definisemo kao id studenta i id ocene
                            $grade_attribute = $student_id.'ocena';     
                        // }
                    
                    echo "</div>";  //end of col
                    echo " <div class='col-lg-6 col-md-6'>";
                    echo '<span>'.$form->field($model, 'grade')->dropDownList(ArrayHelper::map(Grade::find()->select(['id', 'title'])->where('id = id')->all(), 'id', 'title' ),['prompt' => 'Select grade', 'name'=>$grade_attribute]). "</span>" ;
                    echo "</div>";  //end of col
                    echo "</div>";  //end of row
                }
            
                ?>
  </div> <!-- End of row -->
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>