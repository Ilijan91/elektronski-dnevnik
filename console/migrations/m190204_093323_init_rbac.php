<?php

use yii\db\Migration;

/**
 * Class m190204_092835_init_rbac
 */
class m190204_093323_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // DEPARTMENT

        // add "departmentIndex" permission
        $departmentIndex = $auth->createPermission('department/index');
        $departmentIndex->description = 'Department index';
        $auth->add($departmentIndex);

        // add "departmentCreate" permission
        $departmentCreate = $auth->createPermission('department/create');
        $departmentCreate->description = 'Create a department';
        $auth->add($departmentCreate);

        // add "departmentUpdate" permission
        $departmentUpdate = $auth->createPermission('department/update');
        $departmentUpdate->description = 'Update department';
        $auth->add($departmentUpdate);

        // add "departmentDelete" permission
        $departmentDelete = $auth->createPermission('department/delete');
        $departmentDelete->description = 'Delete department';
        $auth->add($departmentDelete);

        // add "departmentView" permission
        $departmentView = $auth->createPermission('department/view');
        $departmentView->description = 'View department';
        $auth->add($departmentView);

        // MESSAGES

        // add "messagesIndex" permission
        $messagesIndex = $auth->createPermission('messages/index');
        $messagesIndex->description = 'Messages index';
        $auth->add($messagesIndex);

        // add "messagesCreate" permission
        $messagesCreate = $auth->createPermission('messages/create');
        $messagesCreate->description = 'Create a messages';
        $auth->add($messagesCreate);

        // add "messagesUpdate" permission
        $messagesUpdate = $auth->createPermission('messages/update');
        $messagesUpdate->description = 'Update messages';
        $auth->add($messagesUpdate);

        // add "messagesDelete" permission
        $messagesDelete = $auth->createPermission('messages/delete');
        $messagesDelete->description = 'Delete messages';
        $auth->add($messagesDelete);

        // add "messagesView" permission
        $messagesView = $auth->createPermission('messages/view');
        $messagesView->description = 'View messages';
        $auth->add($messagesView);

        // NEWS

        // add "newsIndex" permission
        $newsIndex = $auth->createPermission('news/index');
        $newsIndex->description = 'News index';
        $auth->add($newsIndex);

        // add "newsCreate" permission
        $newsCreate = $auth->createPermission('news/create');
        $newsCreate->description = 'Create news';
        $auth->add($newsCreate);

        // add "newsUpdate" permission
        $newsUpdate = $auth->createPermission('news/update');
        $newsUpdate->description = 'Update news';
        $auth->add($newsUpdate);

        // add "newsDelete" permission
        $newsDelete = $auth->createPermission('news/delete');
        $newsDelete->description = 'Delete news';
        $auth->add($newsDelete);

        // add "newsView" permission
        $newsView = $auth->createPermission('news/view');
        $newsView->description = 'View news';
        $auth->add($newsView);

        // ROLL

        // add "rollIndex" permission
        $rollIndex = $auth->createPermission('roll/index');
        $rollIndex->description = 'Roll index';
        $auth->add($rollIndex);

        // add "rollCreate" permission
        $rollCreate = $auth->createPermission('roll/create');
        $rollCreate->description = 'Create a roll';
        $auth->add($rollCreate);

        // add "rollUpdate" permission
        $rollUpdate = $auth->createPermission('roll/update');
        $rollUpdate->description = 'Update roll';
        $auth->add($rollUpdate);

        // add "rollDelete" permission
        $rollDelete = $auth->createPermission('roll/delete');
        $rollDelete->description = 'Delete roll';
        $auth->add($rollDelete);

        // add "rollView" permission
        $rollView = $auth->createPermission('roll/view');
        $rollView->description = 'View roll';
        $auth->add($rollView);

        // GRADE

        // add "gradeIndex" permission
        $gradeIndex = $auth->createPermission('grade/index');
        $gradeIndex->description = 'Grade index';
        $auth->add($gradeIndex);

        // add "gradeCreate" permission
        $gradeCreate = $auth->createPermission('grade/create');
        $gradeCreate->description = 'Create grade';
        $auth->add($gradeCreate);

        // add "gradeUpdate" permission
        $gradeUpdate = $auth->createPermission('grade/update');
        $gradeUpdate->description = 'Update grade';
        $auth->add($gradeUpdate);

        // add "gradeDelete" permission
        $gradeDelete = $auth->createPermission('grade/delete');
        $gradeDelete->description = 'Delete grade';
        $auth->add($gradeDelete);

        // add "gradeView" permission
        $gradeView = $auth->createPermission('grade/view');
        $gradeView->description = 'View grade';
        $auth->add($gradeView);

        // add "admin" role and give this role the "createUser" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $departmentIndex);
        $auth->addChild($admin, $departmentCreate);
        $auth->addChild($admin, $departmentUpdate);
        $auth->addChild($admin, $departmentDelete);
        $auth->addChild($admin, $departmentView);
        $auth->addChild($admin, $newsIndex);
        $auth->addChild($admin, $newsCreate);
        $auth->addChild($admin, $newsUpdate);
        $auth->addChild($admin, $newsDelete);
        $auth->addChild($admin, $newsView);
        $auth->addChild($admin, $rollIndex);
        $auth->addChild($admin, $rollCreate);
        $auth->addChild($admin, $rollUpdate);
        $auth->addChild($admin, $rollDelete);
        $auth->addChild($admin, $rollView);

        $auth->assign($admin, 1);

        // add "admin" role and give this role the "createUser" permission
        $parent = $auth->createRole('parent');
        $auth->add($parent);


        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        // $admin = $auth->createRole('admin');
        // $auth->add($admin);
        // $auth->addChild($admin, $updatePost);
        // $auth->addChild($admin, $author);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
        //echo "m190203_215539_init_rbac cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190204_092835_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
