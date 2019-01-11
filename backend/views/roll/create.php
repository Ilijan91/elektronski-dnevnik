<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Roll */

$this->title = 'Create Roll';
$this->params['breadcrumbs'][] = ['label' => 'Rolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
