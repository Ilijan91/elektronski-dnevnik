<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\Teacher\models\StudentSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-subject-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Subject', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'student_id',
            'subject_id',
            'grade',
            'final_grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
