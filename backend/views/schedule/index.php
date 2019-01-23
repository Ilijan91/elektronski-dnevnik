<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Department;
use backend\controllers\DepartmentController;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchSchedule */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';

?>
<div class="schedule-index">

    

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table>
        <tr>
         <th class="text-center">Department</th>
         <th  class="text-center">Action</th>
        </tr>
        <?php 
        foreach($modelDepartment as $department){
            echo '
            <tr>
                <td >'.$department['year'].''.$department['name'].'</td>
                <td>'. Html::a('Update Schedule', ['update', 'id' =>$department['id']], ['class' => 'btn btn-primary']).' '. Html::a('Delete Schedule', ['delete'], ['class' => 'btn btn-danger']).'</td>
                
            </tr>
            ';
        }
        ?>
       
       
    </table>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
            
            [
                'attribute' => 'department_id',
                'label' => 'Departments',
                'value' => 'department.yearname'
            ],
        
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
