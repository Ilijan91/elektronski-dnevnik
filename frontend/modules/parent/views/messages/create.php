<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\parent\models\Messages */

$this->title = 'Send Message to Teacher';
?>
<div class="messages-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
