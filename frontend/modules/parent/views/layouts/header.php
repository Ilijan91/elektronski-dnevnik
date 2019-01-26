<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
?>
<div class="wrap">
<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [

            'class' => 'navbar-inverse',
        ],
    ]);
    $menuItems = [
        ['label' => 'Grade', 'url' => ['/parent/default/grade', 'id' => Yii::$app->user->identity->id]],
        ['label' => 'Home', 'url' => ['/parent/default/index']],

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

        'options' => ['class' => 'navbar-nav navbar-right'],

        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    </div>