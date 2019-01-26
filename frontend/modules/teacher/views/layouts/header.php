<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

?>
<div class="wrap">
    
        <?php
       
        NavBar::begin([
            'brandLabel' => 'School management system',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        $menuItems = [
        ['label' => 'Dashboard', 'url' => ['index']],
        ['label' => 'Students', 'url' => ['students']],
        // ['label' => 'Subject', 'url' => ['/subject/index']],
        ['label' => 'Dairy', 'url' => ['/teacher/index']],
        ['label' => 'Schedule', 'url' => ['/teacher/schedule']],
        ['label' => 'News Feed', 'url' => ['/teacher/news']],
        ['label' => 'Messages', 'url' => ['/teacher/messages']],
        ];
        $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </div>