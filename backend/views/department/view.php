<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\controllers\UserController;

/* @var $this yii\web\View */
/* @var $model backend\models\Department */

$this->title = $model->year . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view">

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
                'attribute' => 'department',
                'value' => $model->yearname
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->fullName
            ],
        ],
    ]) ?>

</div>
