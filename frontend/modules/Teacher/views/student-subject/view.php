<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\Teacher\models\StudentSubject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-subject-view">
<div class="container main">
<h2><?= Html::encode($this->title) ?> <span class="department_name"><?=$department_name?><span></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'student_id',
            'subject_id',
            'grade',
            'final_grade',
        ],
    ]) ?>

</div>
</div>
