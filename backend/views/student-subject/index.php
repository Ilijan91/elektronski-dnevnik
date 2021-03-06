<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\StudentSubject;
use backend\models\StudentSubjectSearch;
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

            [
                'attribute' => 'student_id',
                'value' => 'student.fullName'
            ],
            [
                'attribute' => 'subject_id',
                'value' => 'subject.title',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
     ?>
    
        
 
       
</div>
