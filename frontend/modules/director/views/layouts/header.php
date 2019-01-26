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
        ['label' => 'Subjects', 'url' => ['']],
        ['label' => 'Grades', 'url' => ['']],
        ['label' => 'News Feed', 'url' => ['']],
        ['label' => 'Statistics', 'url' => ['']],
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