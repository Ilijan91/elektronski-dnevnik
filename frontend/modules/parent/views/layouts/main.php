<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

<div id="frontend-header">
   <div class="school-info container">
        <span class="school-name"></span>
        <div class="phone">
            <span ><i class="fas fa-phone"></i> 063/555-222</span>
            <span ><i class="fas fa-envelope-open"></i> school.mail@school.com</span>
        </div>
    </div>
<?= $this->render('header')?>
</div>

    <div id="frontend-main-container" class="container">
      
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<div id="frontend-footer">
<?= $this->render('footer')?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
