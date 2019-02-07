<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */

$this->title = 'Send Message';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index container main">
    <h2><?=Html::encode($this->title) ?> <span class="department_name"><?= \Yii::$app->user->identity->first_name.' '.\Yii::$app->user->identity->last_name;;?> <span></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'impl' => $impl,
    ]) ?>

</div>
