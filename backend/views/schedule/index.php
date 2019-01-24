<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
    <table>
        <tr>
         <th class="text-center">Department</th>
         <th  class="text-center">Action</th>
        </tr>
        <?php 
        foreach($modelDepartment as $department){
        $dep = $department['year'].$department['name'];
            
            echo '
            
            <tr>
                <td>'.Html::a($dep, ['view', 'id' => $department['id']]).'</td>
                <td>'. Html::a('Update Schedule', ['update', 'id' =>$department['id']], ['class' => 'btn btn-primary']).' '. Html::a('Delete Schedule', ['delete'], ['class' => 'btn btn-danger']).'</td>
                
            </tr>
            ';
        }
        ?>
       
       
    </table>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    

    
</div>
