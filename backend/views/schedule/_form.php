<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
=======
use yii\helpers\ArrayHelper;
use backend\controllers\SubjectController;
use backend\models\Subject;
use backend\models\Department;
use backend\models\Days;
use backend\models\Classes;



>>>>>>> 79c1607dc6a2a34e15375b0a400caed5004f3ae8

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="schedule-form">

    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->select(['id', 'CONCAT(year, "/" ,name) AS "year"'])->where('id = id')->all(), 'id', 'year' ),['prompt' => 'Select department']) ?>

<<<<<<< HEAD
    <?= $form->field($model, 'days_id')->textInput() ?>

    <?= $form->field($model, 'class_id')->textInput() ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'department_id')->textInput() ?>
=======
</div>



<table class="table table-borderd table striped">

    <tr>  
        <td>CAS/DAN</td> 
            <?php foreach($modelDay as $day){ ?>
            
                <td align="center">

                    <?=$day->Title?>
>>>>>>> 79c1607dc6a2a34e15375b0a400caed5004f3ae8

                </td>
           <?php } ?> 

    </tr>

        <?php foreach($modelClasses as $class){ ?>

    <tr>
        
        <td align="center"><?=$class->title?></td>
        
         <?php for($i=0;$i<6;$i++){ ?>
            <td align="center"><?= $form->field($model, 'subject_id')->dropDownList(ArrayHelper::map(Subject::find()->all(), 'id', 'title'),['prompt' => 'Izaberi predmet']) ?><br>
         <?php } ?>
        
            
    
    </tr>

        <?php } ?> 

</table>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
 
</div>


<?php ActiveForm::end(); ?>
