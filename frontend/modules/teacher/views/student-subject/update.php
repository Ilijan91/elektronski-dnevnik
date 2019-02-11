<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = 'Update Student Subject: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Student Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-subject-update">
<div class="container main">
<h2><?= Html::encode($this->title) ?> <span class="department_name"><?=$department_name?><span></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>