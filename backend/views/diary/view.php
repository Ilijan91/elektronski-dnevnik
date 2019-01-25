<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Diary */

$this->title = $model->student->first_name .' '.$model->student->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Diaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diary-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            [
                'label'=>'Student',
                'attribute' => 'student_id',
                'value' => $model->student->first_name
            ],
            [
                'label'=>'Subject',
                'attribute' => 'subject_id',
                'value' => $model->subject->title
            ],
            [
                'label'=>'Grade',
                'attribute' => 'grade_id',
                'value' => $model->grade->title
            ],
            'final_grade',
        ],
    ]) ?>

</div>
