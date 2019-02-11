<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = 'Create diary';

?>
<div class="student-subject-create">
<div class="container main">
<h2><?= Html::encode($this->title) ?> <span class="department_name"><?=$department_name?><span></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'modelStudents' => $modelStudents,
    ]) ?>

</div>
</div>