<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = 'Create Student Subject';
$this->params['breadcrumbs'][] = ['label' => 'Student Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
