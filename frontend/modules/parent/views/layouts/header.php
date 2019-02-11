<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use backend\models\Department;
use backend\models\Student;
use frontend\modules\parent\models\OpenDors;
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
        ['label' => 'Grade', 'url' => ['grade', 'id' => $student_id]],
        ['label' => 'Schedule', 'url' => ['schedule' ,'id'=>$department_id]],
        ['label' => 'News Feed', 'url' => ['index']],
        ['label' => 'Open Dors', 'url' => ['open-dors']],
        ['label' => 'Messages', 'url' => ['messages','id' => $student_id]]

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