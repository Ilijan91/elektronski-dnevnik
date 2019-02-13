<?php
/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
AppAsset::register($this);
$school_name = \Yii::$app->params['school_name'];
$school_phone = \Yii::$app->params['school_phone'];
$school_mail =\Yii::$app->params['school_mail'];


$fetch_action = Url::to(['messages/fetch']);
$insert_action = Url::to(['messages/insert']);
$redirect = Url::to(['index']);
$csrf = Yii::$app->request->getCsrfToken();

$script = <<<JS
// get actionFetch from MessagesController
let url = '$fetch_action';
// get actionInsert from MessagesController
let url_insert = '$insert_action';
// get Csrf token
let crf = '$csrf';
// get url for redirect
let redirect = '$redirect';

JS;

$this->registerJs($script);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

   <div id="frontend-header">
   <div class="school-info container">
        <span class="school-name"><?= $school_name?></span>
        <div class="phone">
            <span ><i class="fas fa-phone"></i> <?= $school_phone?></span>
            <span ><i class="fas fa-envelope-open"></i> <?= $school_mail?></span>
        </div>
    </div>
<?= $this->render('header')?>
</div>

    <div id="frontend-main-container">
      
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php
$scritp2 = <<<JS
// load function
    function load(){
        // send get method
        $.get(url, function(data){
            // if is data value = 0, print 'nema obavestenja' in the console
            console.log(data);
            if(data == '0'){
                console.log('Nema Obavestenja');
            } else {
                console.log('Ima Obavestenja');
                // else put data in span element
                $('.count').html(data);
                // when user click on the span element
                $('.count_msg').on('click', function(){
                    // call function insert
                   
                    if(insert()){
                        console.log('kliknuo');
                    };
                    // remove .count element
                    $('.count').html('0');
                   // $(this).remove();
                    // redirect to obavestenja page
                  //  window.location.href = redirect;
                });
            }
        })
    }
    //set interval with load function
    function set(){
        setInterval(load, 7000);
    }
    // call function actionInsert in OdgovorController and insert status in db
    function insert(){
        $.post({
            url : url_insert,
            type: 'post',
            data: {
                _csrf : crf,
            },
        });
    }
    $('.wrap').on('load', load());
    $('.wrap').on('load', set());
JS;
$this->registerJs($scritp2);
?>


<div id="frontend-footer">
<?= $this->render('footer')?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>