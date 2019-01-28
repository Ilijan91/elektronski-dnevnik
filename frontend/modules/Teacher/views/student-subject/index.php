<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\teacher\models\StudentSubject;

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
    <table class="table text-left">
                <thead>
                    <tr>
                        <th scope="col" class="text-left">Students</th>
                    </tr>
                </thead>
                <tbody>
                <?php   foreach($modelStudents as $student){
                     $student_id= $student['id'];
                     $student_name = $student['first_name'].' '. $student['last_name'] ;
                    ?>
                    <tr>
                        <td><?= Html::a($student_name, ['view', 'student_id' =>$student_id]) ?></li></td>
                    </tr>        
                </tbody><!-- End of table body-->
                <?php }?>
            </table><!-- End of table -->
</div>
    </div>