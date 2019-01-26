<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use backend\models\Department;
use backend\models\User;
?>
<div class="wrap">

        <?php
       //Dohvati odeljenje kome predaje ulogovani ucitelj
            $department = Department::find()
                            ->select('id')
                            ->where(['user_id'=>Yii::$app->user->identity->id])
                            ->one();
            $department_id= $department->id;
        NavBar::begin([
            'brandLabel' => 'School management system',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        $menuItems = [
        ['label' => 'Dashboard', 'url' => ['index']],
        ['label' => 'Students', 'url' => ['students','department_id' =>$department_id]],
        // ['label' => 'Subject', 'url' => ['/subject/index']],
        ['label' => 'Diary', 'url' => ['diary']],
        ['label' => 'Schedule', 'url' => ['schedule','department_id' =>$department_id ]],
        ['label' => 'News Feed', 'url' => ['news']],
        ['label' => 'Messages', 'url' => ['messages']],
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