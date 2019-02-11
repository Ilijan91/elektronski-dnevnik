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
$school_name = \Yii::$app->params['school_name'];
$school_phone = \Yii::$app->params['school_phone'];
$school_mail =\Yii::$app->params['school_mail'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

   <div id="frontend-header">
   <div class="school-info container">
        <span class="school-name"><?= $school_name?></span>
        <div class="phone">
            <span ><i class="fas fa-phone"></i> <?= $school_phone?></span>
            <span ><i class="fas fa-envelope-open"></i> <?= $school_mail?></span>
        </div>
    </div>
<?= $this->render('header')?>
</div>

    <div id="frontend-main-container">
      
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