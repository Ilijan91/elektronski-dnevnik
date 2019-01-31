<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
/* @var $this yii\web\View */
/* @var $model backend\models\News */
?>
<div class="news-view">

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right-bottom']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger pull-right',
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
        'title',
        'body:ntext',
        [
            'attribute'=>'created_at',
            'format'=>['date','d/M/Y'],
            
        ],
        'image'
    ],
]) ?>

 
<?php 
    if(empty($model->image)){
        
    }else{ ?>
        <?=Html::img(Url::to('@web/img/upload/'.$model->image),['class'=>'img-responsive','alt'=>'Image'])?>
        
    <?php print_r($model->image); } ?>
</div>

