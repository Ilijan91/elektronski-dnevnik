<?php

use yii\db\Migration;

/**
 * Class m190204_092835_init_rbac
 */
class m190205_113013_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // BACKEND

        // USER

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

        // SCHEDULE

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

        // SITE

        // add "siteIndex" permission
        $siteIndex = $auth->createPermission('site/index');
        $siteIndex->description = 'Index site';
        $auth->add($siteIndex);

        // STUDENT

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

        // STUDENT-SUBJECT

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

        // SUBJECT

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

        // ADMIN

        // add "admin" role and give this role the "createUser" permission
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

        // admin department
        $auth->addChild($admin, $departmentIndex);
        $auth->addChild($admin, $departmentCreate);
        $auth->addChild($admin, $departmentUpdate);
        $auth->addChild($admin, $departmentDelete);
        $auth->addChild($admin, $departmentView);

        // admin news
        $auth->addChild($admin, $newsIndex);
        $auth->addChild($admin, $newsCreate);
        $auth->addChild($admin, $newsUpdate);
        $auth->addChild($admin, $newsDelete);
        $auth->addChild($admin, $newsView);

        // admin roll
        $auth->addChild($admin, $rollIndex);
        $auth->addChild($admin, $rollCreate);
        $auth->addChild($admin, $rollUpdate);
        $auth->addChild($admin, $rollDelete);
        $auth->addChild($admin, $rollView);

        $auth->assign($admin, 1);


        // FRONTEND

        // PARENT

        // DEFAULT

        // add "parentDefaultIndex" permission
        $parentDefaultIndex = $auth->createPermission('parent/default/index');
        $parentDefaultIndex->description = 'Index parent default';
        $auth->add($parentDefaultIndex);

        // add "parentDefaultGrade" permission
        $parentDefaultGrade = $auth->createPermission('parent/default/grade');
        $parentDefaultGrade->description = 'Grade parent default';
        $auth->add($parentDefaultGrade);

        // add "parentDefaultTeachermeeting" permission
        $parentDefaultTeachermeeting = $auth->createPermission('parent/default/teachermeeting');
        $parentDefaultTeachermeeting->description = 'Teachermeeting parent default';
        $auth->add($parentDefaultTeachermeeting);

        // add "parentDefaultSchedule" permission
        $parentDefaultSchedule = $auth->createPermission('parent/default/schedule');
        $parentDefaultSchedule->description = 'Schedule parent default';
        $auth->add($parentDefaultSchedule);

        // MESSAGES

        // add "parentMessagesIndex" permission
        $parentMessagesIndex = $auth->createPermission('parent/messages/index');
        $parentMessagesIndex->description = 'Index parent message';
        $auth->add($parentMessagesIndex);

        // add "parentMessagesView" permission
        $parentMessagesView = $auth->createPermission('parent/messages/view');
        $parentMessagesView->description = 'View parent message';
        $auth->add($parentMessagesView);

        // add "parentMessagesCreate" permission
        $parentMessagesCreate = $auth->createPermission('parent/messages/create');
        $parentMessagesCreate->description = 'Create parent message';
        $auth->add($parentMessagesCreate);

        // add "parentMessagesUpdate" permission
        $parentMessagesUpdate = $auth->createPermission('parent/messages/update');
        $parentMessagesUpdate->description = 'Update parent message';
        $auth->add($parentMessagesUpdate);

        // add "parentMessagesDelete" permission
        $parentMessagesDelete = $auth->createPermission('parent/messages/delete');
        $parentMessagesDelete->description = 'Delete parent message';
        $auth->add($parentMessagesDelete);

        // add "parent" role and give this role the "createUser" permission
        $parent = $auth->createRole('parent');
        $auth->add($parent);

        $auth->assign($parent, 8);
        
        // parent default
        $auth->addChild($parent, $parentDefaultIndex);
        $auth->addChild($parent, $parentDefaultGrade);
        $auth->addChild($parent, $parentDefaultTeachermeeting);
        $auth->addChild($parent, $parentDefaultSchedule);

        // parent messages
        $auth->addChild($parent, $parentMessagesIndex);
        $auth->addChild($parent, $parentMessagesView);
        $auth->addChild($parent, $parentMessagesCreate);
        $auth->addChild($parent, $parentMessagesUpdate);
        $auth->addChild($parent, $parentMessagesDelete);

        // DIRECTOR
        
        // DEFAULT

        // add "directorDefaultIndex" permission
        $directorDefaultIndex = $auth->createPermission('director/default/index');
        $directorDefaultIndex->description = 'Index director default';
        $auth->add($directorDefaultIndex);

        // add "directorDefaultStatisticsPerDepartment" permission
        $directorDefaultStatisticsPerDepartment = $auth->createPermission('director/default/statistics_per_department');
        $directorDefaultStatisticsPerDepartment->description = ' statistics Per Department director default';
        $auth->add($directorDefaultStatisticsPerDepartment);

        // add "directorDefaultStatistics" permission
        $directorDefaultStatistics = $auth->createPermission('director/default/statistics');
        $directorDefaultStatistics->description = 'default Statistics';
        $auth->add($directorDefaultStatistics);

        // TEACHER
        
        // DEFAULT

        // add "teacherDefaultIndex" permission
        $teacherDefaultIndex = $auth->createPermission('teacher/default/index');
        $teacherDefaultIndex->description = 'Index teacher default';
        $auth->add($teacherDefaultIndex);
        
        // add "teacherDefaultNews" permission
        $teacherDefaultNews = $auth->createPermission('teacher/default/news');
        $teacherDefaultNews->description = 'News teacher default';
        $auth->add($teacherDefaultNews);

        // add "teacherDefaultSchedule" permission
        $teacherDefaultSchedule = $auth->createPermission('teacher/default/schedule');
        $teacherDefaultSchedule->description = 'Schedule teacher default';
        $auth->add($teacherDefaultSchedule);

        // add "teacherDefaultStudents" permission
        $teacherDefaultStudents = $auth->createPermission('teacher/default/students');
        $teacherDefaultStudents->description = 'Students teacher default';
        $auth->add($teacherDefaultStudents);

        //STUDENT-SUBJECT

        // add "teacherStudentSubjectIndex" permission
        $teacherStudentSubjectIndex = $auth->createPermission('teacher/student-subject/index');
        $teacherStudentSubjectIndex->description = 'Index teacher student-subject';
        $auth->add($teacherStudentSubjectIndex);

        // add "teacherStudentSubjectCreate" permission
        $teacherStudentSubjectCreate = $auth->createPermission('teacher/student-subject/create');
        $teacherStudentSubjectCreate->description = 'Create teacher student subject';
        $auth->add($teacherStudentSubjectCreate);

        // add "teacherStudentSubjectUpdate" permission
        $teacherStudentSubjectUpdate = $auth->createPermission('teacher/student-subject/update');
        $teacherStudentSubjectUpdate->description = 'Update teacher student subject';
        $auth->add($teacherStudentSubjectUpdate);

        // add "teacherStudentSubjectView" permission
        $teacherStudentSubjectView = $auth->createPermission('teacher/student-subject/view');
        $teacherStudentSubjectView->description = 'View teacher student subject';
        $auth->add($teacherStudentSubjectView);

        // add "teacherStudentSubjectDelete" permission
        $teacherStudentSubjectDelete = $auth->createPermission('teacher/student-subject/delete');
        $teacherStudentSubjectDelete->description = 'Delete teacher student subject';
        $auth->add($teacherStudentSubjectDelete);

        // add "teacherStudentSubjectCreate_grades_per_subject" permission
        $teacherStudentSubjectCreate_grades_per_subject =  $auth->createPermission('teacher/student-subject/create_grades_per_subject');
        $teacherStudentSubjectCreate_grades_per_subject->description = 'create_grades_per_subject teacher student-subject';
        $auth->add($teacherStudentSubjectCreate_grades_per_subject);

        // MESSAGES

        // add "teacherMessagesIndex" permission
        $teacherMessagesIndex = $auth->createPermission('teacher/messages/index');
        $teacherMessagesIndex->description = 'Index teacher messages index';
        $auth->add($teacherMessagesIndex);

        // add "teacherMessagesCreate" permission
        $teacherMessagesCreate = $auth->createPermission('teacher/messages/create');
        $teacherMessagesCreate->description = 'Index teacher messages create';
        $auth->add($teacherMessagesCreate);

        // add "teacherMessagesUpdate" permission
        $teacherMessagesUpdate = $auth->createPermission('teacher/messages/update');
        $teacherMessagesUpdate->description = 'Index teacher messages update';
        $auth->add($teacherMessagesUpdate);

        // add "teacherMessagesView" permission
        $teacherMessagesView = $auth->createPermission('teacher/messages/view');
        $teacherMessagesView->description = 'Index teacher messages view';
        $auth->add($teacherMessagesView);

        // add "teacherMessagesDelete" permission
        $teacherMessagesDelete = $auth->createPermission('teacher/messages/delete');
        $teacherMessagesDelete->description = 'Index teacher messages delete';
        $auth->add($teacherMessagesDelete);
 
        // ROLES

        // add "teacher" role and give this role the permission for teacher module 
        $teacher = $auth->createRole('teacher');
        $auth->add($teacher);
        $auth->assign($teacher, 14);

        //teacher messages
        $auth->addChild($teacher, $teacherMessagesView);
        $auth->addChild($teacher, $teacherMessagesUpdate);
        $auth->addChild($teacher, $teacherMessagesCreate);
        $auth->addChild($teacher, $teacherMessagesIndex);
        $auth->addChild($teacher, $teacherMessagesDelete);

        //teacher student-subject
        $auth->addChild($teacher, $teacherStudentSubjectIndex);
        $auth->addChild($teacher, $teacherStudentSubjectCreate);
        $auth->addChild($teacher, $teacherStudentSubjectCreate_grades_per_subject);
        $auth->addChild($teacher, $teacherStudentSubjectUpdate);
        $auth->addChild($teacher, $teacherStudentSubjectView);
        $auth->addChild($teacher, $teacherStudentSubjectDelete);

        // teacher default
        $auth->addChild($teacher, $teacherDefaultIndex);
        $auth->addChild($teacher, $teacherDefaultStudents);
        $auth->addChild($teacher, $teacherDefaultSchedule);
        $auth->addChild($teacher, $teacherDefaultNews);
       
        // add "director" role and give this role the permission for director module 
        $director = $auth->createRole('director');
        $auth->add($director);
        $auth->assign($director, 15);

        // director default
        $auth->addChild($director, $directorDefaultIndex);
        $auth->addChild($director, $directorDefaultStatisticsPerDepartment);
        $auth->addChild($director, $directorDefaultStatistics);
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
