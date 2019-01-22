<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\controllers\SubjectController;
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

   
    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->select(['id', 'CONCAT(year, "/" ,name) AS "year"'])->where('id = id')->all(), 'id', 'year' ),['prompt' => 'Select department']); ?>
    <?= $form->field($model, 'days_id')->dropDownList(ArrayHelper::map(Days::find()->select(['id', 'title'])->where('id = id')->all(), 'id', 'title' ),['prompt' => 'Select day']) ?>
   
    <?php
        for($i=0;$i<count($modelClasses);$i++){
            echo "<p id=class".$i.">Class - ".$modelClasses[$i]['title']."</p>";
           echo  $form->field($model, 'subject_id')->checkboxList(ArrayHelper::map(Subject::find()->all(),'id','title'), ['name' => 'subj'.$i])->label($model->getAttributeLabel('subject_id'));
        }
    ?>
   
    
</div>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
 
</div>





<?php ActiveForm::end(); ?>
