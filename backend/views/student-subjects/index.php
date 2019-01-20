<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentSubjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-subjects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Subjects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'Student',
                'attribute' => 'student_id',
                'value' => 'student.fullName'
            ],
            [
                'label'=>'Subject',
                'attribute' => 'subject_id',
                'value' => 'subject.title'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
