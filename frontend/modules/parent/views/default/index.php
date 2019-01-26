<<<<<<< HEAD

<div class="parent-default-index">

    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
=======
<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="parent-default-index">
    <?php
        for($i=0;$i<count($news);$i++) {
            echo '<h1>' . $news[$i]['title'] . '</h1>';
            echo '<p>' . $news[$i]['body'] . '</p>';
            echo '<img src="../../img/upload/'.$news[$i]['image'].'" width=200 height=200 alt="">';
        }
 //Html::a('Grade', ['grade', 'id' => $model->id], ['class' => 'btn btn-primary']) 

// print_r($model);
    ?>

    
>>>>>>> bca278489a8edfd18ee207df08869167ba29a409
</div>
