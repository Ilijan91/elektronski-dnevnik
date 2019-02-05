<?php

use yii\db\Migration;

/**
 * Class m190203_213929_init_rbac
 */
class m190203_213929_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        //**************  BACKEND *************************/
//USER CONTROLLER
        // add "userIndex" permission
        $userIndex = $auth->createPermission('user/index');
        $userIndex->description = 'Index user';
        $auth->add($userIndex);

        // add "userCreate" permission
        $userCreate = $auth->createPermission('user/create');
        $userCreate->description = 'Create user';
        $auth->add($userCreate);

        // add "userUpdate" permission
        $userUpdate = $auth->createPermission('user/update');
        $userUpdate->description = 'Update user';
        $auth->add($userUpdate);

        // add "userView" permission
        $userView = $auth->createPermission('user/view');
        $userView->description = 'View user';
        $auth->add($userView);

        // add "userDelete" permission
        $userDelete = $auth->createPermission('user/delete');
        $userDelete->description = 'Delete user';
        $auth->add($userDelete);
//SCHEDULE CONTROLLER
        // add "scheduleIndex" permission
        $scheduleIndex = $auth->createPermission('schedule/index');
        $scheduleIndex->description = 'Index schedule';
        $auth->add($scheduleIndex);

        // add "scheduleCreate" permission
        $scheduleCreate = $auth->createPermission('schedule/create');
        $scheduleCreate->description = 'Create schedule';
        $auth->add($scheduleCreate);

        // add "scheduleUpdate" permission
        $scheduleUpdate = $auth->createPermission('schedule/update');
        $scheduleUpdate->description = 'Update schedule';
        $auth->add($scheduleUpdate);

        // add "scheduleView" permission
        $scheduleView = $auth->createPermission('schedule/view');
        $scheduleView->description = 'View schedule';
        $auth->add($scheduleView);

        // add "scheduleDelete" permission
        $scheduleDelete = $auth->createPermission('schedule/delete');
        $scheduleDelete->description = 'Delete schedule';
        $auth->add($scheduleDelete);

//SITE CONTROLLER
        // add "siteIndex" permission
        $siteIndex = $auth->createPermission('site/index');
        $siteIndex->description = 'Index site';
        $auth->add($siteIndex);

//STUDENT CONTROLLER
        // add "studentIndex" permission
        $studentIndex = $auth->createPermission('student/index');
        $studentIndex->description = 'Index student';
        $auth->add($studentIndex);

        // add "studentCreate" permission
        $studentCreate = $auth->createPermission('student/create');
        $studentCreate->description = 'Create student';
        $auth->add($studentCreate);

        // add "studentUpdate" permission
        $studentUpdate = $auth->createPermission('student/update');
        $studentUpdate->description = 'Update student';
        $auth->add($studentUpdate);

        // add "studentView" permission
        $studentView = $auth->createPermission('student/view');
        $studentView->description = 'View student';
        $auth->add($studentView);

        // add "studentDelete" permission
        $studentDelete = $auth->createPermission('student/delete');
        $studentDelete->description = 'Delete student';
        $auth->add($studentDelete);

//STUDENT-SUBJECT CONTROLLER
        // add "studentSubjectIndex" permission
        $studentSubjectIndex = $auth->createPermission('student-subject/index');
        $studentSubjectIndex->description = 'Index student-subject';
        $auth->add($studentSubjectIndex);

        // add "studentSubjectCreate" permission
        $studentSubjectCreate = $auth->createPermission('student-subject/create');
        $studentSubjectCreate->description = 'Create student subject';
        $auth->add($studentSubjectCreate);

        // add "studentSubjectUpdate" permission
        $studentSubjectUpdate = $auth->createPermission('student-subject/update');
        $studentSubjectUpdate->description = 'Update student subject';
        $auth->add($studentSubjectUpdate);

        // add "studentSubjectView" permission
        $studentSubjectView = $auth->createPermission('student-subject/view');
        $studentSubjectView->description = 'View student subject';
        $auth->add($studentSubjectView);

        // add "studentSubjectDelete" permission
        $studentSubjectDelete = $auth->createPermission('student-subject/delete');
        $studentSubjectDelete->description = 'Delete student subject';
        $auth->add($studentSubjectDelete);

        // add "studentSubjectCreate_grades_per_subject" permission
        $studentSubjectCreate_grades_per_subject =  $auth->createPermission('student-subject/create_grades_per_subject');
        $studentSubjectCreate_grades_per_subject->description = 'create_grades_per_subject student subject';
        $auth->add($studentSubjectCreate_grades_per_subject);

// //SUBJECT CONTROLLER
        // add "subjectIndex" permission
        $subjectIndex = $auth->createPermission('subject/index');
        $subjectIndex->description = 'Index subject';
        $auth->add($subjectIndex);

        // add "subjectCreate" permission
        $subjectCreate = $auth->createPermission('subject/create');
        $subjectCreate->description = 'Create subject';
        $auth->add($subjectCreate);

        // add "subjectUpdate" permission
        $subjectUpdate = $auth->createPermission('subject/update');
        $subjectUpdate->description = 'Update subject';
        $auth->add($subjectUpdate);

        // add "subjectView" permission
        $subjectView = $auth->createPermission('subject/view');
        $subjectView->description = 'View subject';
        $auth->add($subjectView);

        // add "subjectDelete" permission
        $subjectDelete = $auth->createPermission('subject/delete');
        $subjectDelete->description = 'Delete subject';
        $auth->add($subjectDelete);

 //**************  FRONTEND *************************/

//DIRECTOR MODULE DEFAULT CONTROLLER
        // add "directorDefaultIndex" permission
        $defaultIndex = $auth->createPermission('default/index');
        $defaultIndex->description = 'Index default';
        $auth->add($defaultIndex);

        // add "directorDefaultStatisticsPerDepartment" permission
        $defaultStatisticsPerDepartment = $auth->createPermission('default/statisticsPerDepartment');
        $defaultStatisticsPerDepartment->description = 'default statistics Per Department';
        $auth->add($defaultStatisticsPerDepartment);

        // add "defaultStatistics" permission
        $defaultStatistics = $auth->createPermission('default/statistics');
        $defaultStatistics->description = 'default Statistics';
        $auth->add($defaultStatistics);

         // add "defaultNews" permission
         $defaultNews = $auth->createPermission('default/news');
         $defaultNews->description = 'News default';
         $auth->add($defaultNews);

         // add "defaultSchedule" permission
         $defaultSchedule = $auth->createPermission('default/schedule');
         $defaultSchedule->description = 'Schedule default';
         $auth->add($defaultSchedule);

         // add "defaultStudents" permission
         $defaultStudents = $auth->createPermission('default/students');
         $defaultStudents->description = 'Students default';
         $auth->add($defaultStudents);

//ROLES
        // 
        $teacher = $auth->createRole('teacher');
        $auth->add($teacher);
          //teacher student-subject
         $auth->addChild($teacher, $studentSubjectIndex);
         $auth->addChild($teacher, $studentSubjectCreate);
         $auth->addChild($teacher, $studentSubjectCreate_grades_per_subject);
         $auth->addChild($teacher, $studentSubjectUpdate);
         $auth->addChild($teacher, $studentSubjectView);
         $auth->addChild($teacher, $studentSubjectDelete);

          //teacher default
          $auth->addChild($teacher, $defaultStudents);
          $auth->addChild($teacher, $defaultSchedule);
          $auth->addChild($teacher, $defaultNews);
       

         // add "director" role and give this role the permission for director module 
         $director = $auth->createRole('director');
         $auth->add($director);
         $auth->addChild($director, $defaultIndex);
         $auth->addChild($director, $defaultStatisticsPerDepartment);
         $auth->addChild($director, $defaultStatistics);

        // // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "teacher" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        //admin user
        $auth->addChild($admin, $userIndex);
        $auth->addChild($admin, $userCreate);
        $auth->addChild($admin, $userUpdate);
        $auth->addChild($admin, $userView);
        $auth->addChild($admin, $userDelete);

        //admin schedule
        $auth->addChild($admin, $scheduleIndex);
        $auth->addChild($admin, $scheduleCreate);
        $auth->addChild($admin, $scheduleUpdate);
        $auth->addChild($admin, $scheduleView);
        $auth->addChild($admin, $scheduleDelete);

        //admin site
        $auth->addChild($admin, $siteIndex);

        //admin student
        $auth->addChild($admin, $studentIndex);
        $auth->addChild($admin, $studentCreate);
        $auth->addChild($admin, $studentUpdate);
        $auth->addChild($admin, $studentView);
        $auth->addChild($admin, $studentDelete);

         //admin student-subject
         $auth->addChild($admin, $studentSubjectIndex);
         $auth->addChild($admin, $studentSubjectCreate);
         $auth->addChild($admin, $studentSubjectUpdate);
         $auth->addChild($admin, $studentSubjectView);
         $auth->addChild($admin, $studentSubjectDelete);

         //admin subject
         $auth->addChild($admin, $subjectIndex);
         $auth->addChild($admin, $subjectCreate);
         $auth->addChild($admin, $subjectUpdate);
         $auth->addChild($admin, $subjectView);
         $auth->addChild($admin, $subjectDelete);

        // // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // // usually implemented in your User model.
        $auth->assign($teacher, 20);
        $auth->assign($admin, 1);
        $auth->assign($director, 22);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m190203_213929_init_rbac cannot be reverted.\n";

        // return false;
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190203_213929_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
