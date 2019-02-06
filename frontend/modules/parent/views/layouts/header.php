<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use backend\models\Department;
use backend\models\Student;
use backend\models\StudentSubject;
?>
<div class="wrap">
<?php
     $student = Student::find()
     ->select('id')
     ->where(['user_id'=>Yii::$app->user->identity->id])
     ->one();
    $student_id= $student->id;


    $department=Student::find()
    ->select('department_id')
    ->where(['user_id'=>Yii::$app->user->identity->id])
    ->one();
    $department_id= $department->department_id;

    

    NavBar::begin([
        'brandLabel' => 'School management system',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [

            'class' => 'navbar-inverse',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['default/index', 'id' => Yii::$app->user->identity->id]],
        ['label' => 'Grade', 'url' => ['default/grade', 'id' => $student_id]],
        ['label' => 'Schedule', 'url' => ['default/schedule', 'id' => $department_id]],
        ['label' => 'News Feed', 'url' => ['default/news']],
        ['label' => 'Messages', 'url' => ['messages/index', 'department_id' => $department_id]],
        ['label' => 'Teacher Meeting', 'url' => ['teachermeeting']],

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