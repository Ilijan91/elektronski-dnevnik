<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$t = array_column($termins, 'term');
// $this->title = $department_name;
$this->title = 'Time Meeting: ' . $teacherFullName;
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container main">

<h2>Teacher Meeting: <span class="department_name"><?=$teacherFullName?><span></h2>

<h3>Meeteng day: <span><?= $timeMeetingInfo['day']?></span></h3>
<h3>Meeteng duration: <span><?= $timeMeetingInfo['start_at'].' - '.$timeMeetingInfo['end_at']?></span></h3>

<?php
 //Proveri da li je korisnik vec zakazao sastanak

if($count > 0){
   echo '<h4>Your termin is '.$booked['term'].'</h4>';
   echo '<h4>You can change it in form below.</h4>';
//    print_r($booked);
//    echo count($booked['term']);
}
?>
<h3>Free termins</h3>
<?php


// foreach($termins as $termin){ ?>
    <div >
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, "term")->checkboxList(ArrayHelper::map($termins,'id','term'))->label($model->getAttributeLabel('')); ?>
       
    <p>Select appropriate term to make an appointment</p>
    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    
