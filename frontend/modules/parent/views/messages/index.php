<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\parent\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\parent\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Send Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'text:ntext',
            'sender',
            'receiver',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
