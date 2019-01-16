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
   

<<<<<<< HEAD
   <div id="header">
<?= $this->render('header')?>
</div>
=======
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [

            'class' => '',
        ],
    ]);
    $menuItems = [
        ['label' => 'Dashboard', 'url' => ['/site/index']],
        ['label' => 'Users', 'url' => ['/user/index']],
        ['label' => 'Departments', 'url' => ['/department/index']],
        ['label' => 'Subject', 'url' => ['/subject/index']],
        ['label' => 'Schedule', 'url' => ['/schedule/index']],
        ['label' => 'News Feed', 'url' => ['/site/index']],
        ['label' => 'Teachers', 'url' => ['/user/teachers']],
        ['label' => 'Students', 'url' => ['/site/index']],
        ['label' => 'Director', 'url' => ['/site/index']],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([

        'options' => ['class' => 'sidenav'],

        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => '',
        ],
    ]);
    $menuItems = [
        ['label' => 'Dashboard', 'url' => ['/site/index']],
        ['label' => 'Users', 'url' => ['/user/index']],
        ['label' => 'Departments', 'url' => ['/department/index']],
        ['label' => 'Subject', 'url' => ['/subject/index']],
        ['label' => 'Schedule', 'url' => ['/schedule/index']],
        ['label' => 'News Feed', 'url' => ['/site/index']],
        ['label' => 'Teachers', 'url' => ['/user/teachers']],
        ['label' => 'Students', 'url' => ['/site/index']],
        ['label' => 'Director', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'sidenav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
>>>>>>> da4aa64a8efa7dc94d0e006782298600906605a6
  
    <div id="main-container">
      
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<div id="footer">
<?= $this->render('footer')?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
