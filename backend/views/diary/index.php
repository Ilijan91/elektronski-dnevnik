<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\models\Diary;
use backend\controllers\DiaryController;
use yii\db\ActiveRecord;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Diary', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'grade_id',
                'value' => 'grade.title'
            ],
            'final_grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
