<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Roll */

$this->title = 'Update Roll: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Rolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roll-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
