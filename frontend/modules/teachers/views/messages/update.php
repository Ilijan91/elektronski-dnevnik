<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */

$this->title = 'Update Messages: ';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'impl' => $impl,
    ]) ?>

</div>
