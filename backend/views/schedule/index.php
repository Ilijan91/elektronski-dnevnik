<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Department;
use backend\models\Days;
use backend\controllers\DepartmentController;
use backend\controllers\DaysController;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';

?>
<div class="schedule-index">

    

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


          
            
           /* [
                'attribute' => 'department_id',
                'label' => 'Departments',
                'value' => 'department.yearname'
            ],
        */
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
