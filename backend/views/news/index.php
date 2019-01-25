<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchNews */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';

?>
<div class="news-index">

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $model,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'title',
        [
            'attribute'=>'created_at',
            'label'=>'Published at',
            'format'=>['date','d/M/Y'],
            'contentOptions' => ['style' => 'width: 110px;', 'class' => 'text-right'],
        ],


        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>