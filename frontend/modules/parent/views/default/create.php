<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */

$this->title = 'Send Message';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('messages', [
        'model' => $model,
    ]) ?>

</div>
