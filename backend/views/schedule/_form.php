<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\controllers\SubjectController;
use backend\controllers\DaysController;
use backend\models\Subject;
use backend\models\Department;
use backend\models\Days;
use backend\models\Classes;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="schedule-form">
    <!-- Prvo biramo odeljenje za koje se kreira raspored casova -->
    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->select(['id', 'CONCAT(year, "/" ,name) AS "year"'])->where('id = id')->all(), 'id', 'year' ),['prompt' => 'Select department']); ?>
   
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
                    echo '<span>'.$form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->select(['id', 'title'])->where('id = id')->all(), 'id', 'title' ),['prompt' => 'Select day', 'name'=>$subject_name_attribute]). "</span>" ;
             }
        echo "</div>";  //end of col
    }
   
    ?>
  </div> <!-- End of row -->
</div><!-- End of schedule form -->


<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
