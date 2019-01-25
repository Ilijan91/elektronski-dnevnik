<?php

<<<<<<< HEAD:frontend/modules/parent/Module.php
namespace frontend\modules\parent;

/**
 * parent module definition class
=======
namespace frontend\modules\teacher;

/**
 * teacher module definition class
>>>>>>> c25e03d88ad94939ee1b09f58c356205b6106726:frontend/modules/Teacher/Module.php
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
<<<<<<< HEAD:frontend/modules/parent/Module.php
    public $controllerNamespace = 'frontend\modules\parent\controllers';
=======
    public $controllerNamespace = 'frontend\modules\teacher\controllers';
>>>>>>> c25e03d88ad94939ee1b09f58c356205b6106726:frontend/modules/Teacher/Module.php

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
