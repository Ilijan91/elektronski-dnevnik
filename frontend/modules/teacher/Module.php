<?php
namespace frontend\modules\teacher;

// use yii2mod\rbac\filters\AccessControl;

/**
 * director module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\teacher\controllers';

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
