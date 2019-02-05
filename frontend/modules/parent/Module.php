<?php

namespace frontend\modules\parent;

// use yii2mod\rbac\filters\AccessControl;
/**
 * parent module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\parent\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    // public function behaviors()
    // {
    //     return [
    //         AccessControl::class
    //     ];
    // }
    
}
