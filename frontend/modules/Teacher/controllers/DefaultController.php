<?php

namespace frontend\modules\Teacher\controllers;
use backend\models\StudentSubject;
use yii\web\Controller;
use backend\models\StudentSubjectSearch;

/**
 * Default controller for the `Teacher` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        
        $gradeModel = new StudentSubject();
        $grades = $gradeModel->getGrades();
        // $grades = $gradeModel->getSubject();

        // $subject_id = $gradeModel->getSubjects();


        // $subjectModel = new StudentSubject();
        $subjects = $gradeModel->getSubjects();

        return $this->render('index', [
            'gradeModel' => $gradeModel,
            'grades' => $grades,
            'subjects' => $subjects,
        ]);
       
    }
}
