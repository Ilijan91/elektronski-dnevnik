<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = $student_name;
?>
<div class="student-subject-view">
    <div class="container main">
    <h2>Student <?= Html::encode($this->title) ?> <span class="department_name"><?=$department_name?><span></h2>
  
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Subjects</th>
                        <th scope="col">Grades</th>
                    </tr>
                </thead>
                <tbody>
                <?php  foreach($grades as $subject=>$grade){
                    ?>
                    <tr>
                        <th scope="col"><?= $subject?></th>
                        <td><?= $grade?></td>
                    </tr>        
                </tbody><!-- End of table body-->
                <?php }?>
            </table><!-- End of table -->
    </div>
</div>
