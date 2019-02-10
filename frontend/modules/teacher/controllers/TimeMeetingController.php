<?php

namespace frontend\modules\teacher\controllers;

use Yii;
use frontend\modules\teacher\models\TimeMeeting;
use frontend\modules\teacher\models\TimeMeetingAppointment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimeMeetingController implements the CRUD actions for TimeMeeting model.
 */
class TimeMeetingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TimeMeeting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TimeMeeting::find(),
        ]);
        $teacher_id = Yii::$app->user->identity->id;
        $TimeMeeting = TimeMeeting::find()->where('teacher_id = '.$teacher_id)->all();

        //Dohvati sve termine za odredjeni sastanak
        $timeMeetingAppointmentModel = new TimeMeetingAppointment;
      
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimeMeeting model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TimeMeeting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TimeMeeting();
       
        $model->teacher_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) ) {
           
            if ( $model->save() ) {
                $termins = $this->getAllTermins($model->start_at, $model->end_at);

                $timeMeetingAppointmentModel = new TimeMeetingAppointment; 
                //insert appointments
                foreach($termins as $termin){ 
                    $timeMeetingAppointmentModel->setIsNewRecord(true);
                    $timeMeetingAppointmentModel->id = null;
                    $timeMeetingAppointmentModel->teacher_id = Yii::$app->user->identity->id;
                    $timeMeetingAppointmentModel->term = $termin;
                    $timeMeetingAppointmentModel->save();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TimeMeeting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TimeMeeting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TimeMeeting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimeMeeting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimeMeeting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function getAllTermins($start_at, $end_at){
      
            $interval = -15;
            $end = date_create($end_at);
            $time = '';
            $termins = [];
            
            //Proveri da li se sastanak zavrsio uporedjivanjem pocetnog i zavrsnog termina
            while($time < $end){
                $interval += 15;
                
                $time = date_create($start_at);
                date_modify($time, $interval.' minutes');
                if($time == $end) {
                    //echo '<hr>';
                    return $termins;
                } else {
                    //echo date_format($date, 'H:i');
                    $termins[]= date_format($time, 'H:i');
                }
            }
            return $termins;
  
    }
}
