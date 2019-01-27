<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Student;
use backend\models\Subject;
use yii\helpers\ArrayHelper;

use backend\controllers\StudentController;
?>








<!-- List group -->

<div class="list-group" id="myList" role="tablist">
    <?php foreach($subjects as $subject){ ?>          
         <a class="list-group-item list-group-item-action active" data-toggle="list" href="" role="tab"><?=$subject->title?></a>
    <?php } ?>

</div>
