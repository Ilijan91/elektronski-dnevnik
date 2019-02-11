<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
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
            'brandUrl' => Yii::$app->homeUrl.'teacher',
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        $menuItems = [
        ['label' => 'Dashboard', 'url' => ['default/index']],
        ['label' => 'Students', 'url' => ['default/students','department_id' =>$department_id]],
     
        ];
        $menuItems[] = 
            '<li class="dropdown nav-item"><a href="student-subject/index" class="dropdown-toggle" data-toggle="dropdown">Diary <i class="fas fa-sort-down"></i></a>
                <ul class="dropdown-menu">
                     <li><a href="'.Url::to(['student-subject/index', 'department_id' =>$department_id]).'">Diary</a></li>
                    <li><a href="'.Url::to(['student-subject/create', 'department_id' =>$department_id]).'">Add a single grade per student</a></li>
                    <li><a href="'.Url::to(['student-subject/create_grades_per_subject', 'department_id' =>$department_id]).'">Add grades per subject</a></li>
                    
                </ul>
            </li>';
        $menuItems[] = ['label' => 'Schedule', 'url' => ['default/schedule','department_id' =>$department_id ]];
        $menuItems[] = ['label' => 'News Feed', 'url' => ['default/news']];
        $menuItems[] = ['label' => 'Time Meetings', 'url' => ['time-meeting/index']];
        $menuItems[] = ['label' => 'Messages', 'url' => ['messages/index', 'id' => Yii::$app->user->identity->id]];
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