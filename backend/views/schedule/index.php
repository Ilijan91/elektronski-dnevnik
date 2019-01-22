<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Department;
use backend\controllers\DepartmentController;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';

?>
<div class="schedule-index">

    

    <h1><?= Html::encode($this->title) ?></h1>
<<<<<<< HEAD
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
=======
>>>>>>> 79c1607dc6a2a34e15375b0a400caed5004f3ae8

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

<<<<<<< HEAD
            'id',
            'days_id',
            'class_id',
            'subject_id',
            'department_id',

=======
          
            
           /* [
                'attribute' => 'department_id',
                'label' => 'Departments',
                'value' => 'department.yearname'
            ],
        */
>>>>>>> 79c1607dc6a2a34e15375b0a400caed5004f3ae8
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
