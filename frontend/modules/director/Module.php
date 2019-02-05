<?php

namespace frontend\modules\director;

// use yii2mod\rbac\filters\AccessControl;

/**
 * director module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\director\controllers';

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
