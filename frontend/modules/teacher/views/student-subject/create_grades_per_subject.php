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
<<<<<<< HEAD
                                echo Html::label($student_name, $student_id);
                                echo '<span>'. Html::textInput($student_id, $student_id, ['readonly' => true, 'class' => 'form-control']). "</span>" ;
=======
                               echo '<span>'. $form->field($model, 'student_id')->hiddenInput(['name'=>$student_id, 'value'=>$student_id])->label($student_name). "</span>" ;
                               
>>>>>>> caadb743e0534e2b0bec1f88666eb6c7cb86e479
                                //dodeljujemo jedinstvenu vrednost name atributu za grade kako bismo pratili post zahteve koje saljemo nakon submitovanja forme. Tu vrednost za definisemo kao id studenta i id ocene
                                $grade_attribute = $student_id.'ocena';     
                            
                                echo "</div>";  //end of col
                                echo " <div class='col-lg-6 col-md-6'>";
                                echo '<span>'.$form->field($model, 'grade_id')->dropDownList(ArrayHelper::map(Grade::find()->select(['id', 'title'])->all(), 'id', 'title' ),['prompt' => 'Select grade', 'name'=>$grade_attribute]). "</span>" ;
                            echo "</div>";  //end of col
                        echo "</div>";  //end of row
                       
                    }
                    
                    ?>
                </div> <!-- End of row -->
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div><!-- End of student-subject-form -->
    </div><!-- End of container main -->
</div><!-- End of student-subject-create -->