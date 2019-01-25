<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [

            'class' => 'NavBar',
        ],
    ]);
    $menuItems = [
        ['label' => 'Dashboard', 'url' => ['/site/index']],
        ['label' => 'Users', 'url' => ['/user/index']],
        ['label' => 'Departments', 'url' => ['/department/index']],
        ['label' => 'Subject', 'url' => ['/subject/index']],
        ['label' => 'Schedule', 'url' => ['/schedule/index']],
        ['label' => 'Diary', 'url' => ['/diary/index']],
        ['label' => 'Grades', 'url' => ['/grade/index']],
        ['label' => 'Student-subjects', 'url' => ['/student-subject/index']],
        ['label' => 'News Feed', 'url' => ['/news/index']],
        ['label' => 'Teachers', 'url' => ['/user/teachers']],
        ['label' => 'Students', 'url' => ['/student/index']],
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