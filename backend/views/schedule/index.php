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
   
   

    
<!-- Koristimo model DepartmentSearch, view _search.php iz Department foldera, dataProvider i searchModel su vezani za Department tabelu -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
           
            [
                'attribute' => 'name',
                'label' => 'Department',
                'value' => 'yearname'
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.fullname',
            ],
        
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>