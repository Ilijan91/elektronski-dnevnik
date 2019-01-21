<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\StudentSubject;
use backend\controllers\StudentSubjectController;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentSubjectSearch */
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
            [
                'attribute' => 'student_id',
                'value' => 'student.fullName'
            ],
            [
                'attribute' => 'subject_id',
                'value' => 'subject.title',
            ],
            [
                'attribute' => 'grade',
                'value' => 'grade'
            ],
            'final_grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

        <table class="table">
            <tr>
                <th>Student</th>
                <?php
                    foreach($grades as $grade) {
                        echo '<th>'.$grade['title'].'</th>';
                    }
                ?>
            </tr>
            <?php
                    foreach($grades as $grade) {
                        echo '<tr>';
                            echo '<td>'.$grade['first_name'].' '.$grade['last_name'].'</td>';
                            echo '<td>'.$grade['grades'].'</td>';
                        echo '</tr>';
                    }
            ?>
        </table>
</div>
