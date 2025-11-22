<?php

class ConsultationRecordController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new ConsultationRecord;

        // --- 1. PRE-FILL DATA (If coming from the Queue) ---
        if (isset($_GET['appointment_id'])) {
            $apptId = (int)$_GET['appointment_id'];
            // Load the appointment to get patient/doctor details
            $appointment = Appointment::model()->findByPk($apptId);

            if ($appointment) {
                $model->appointment_id = $apptId;
                $model->patient_account_id = $appointment->patient_account_id;
                $model->doctor_account_id = $appointment->doctor_account_id;
                // Set date to today
                $model->date_of_consultation = date('Y-m-d');
            }
        }
        // ---------------------------------------------------

        if (isset($_POST['ConsultationRecord'])) {
            $model->attributes = $_POST['ConsultationRecord'];

            // Safety: Ensure Doctor ID is set to the logged-in user if missing
            if(empty($model->doctor_account_id)) {
                $model->doctor_account_id = Yii::app()->user->id;
            }

            if ($model->save()) {
                
                // --- 2. CLOSE THE APPOINTMENT LOOP ---
                // If this SOAP note is linked to an appointment, mark it as 'Completed' (4)
                if (!empty($model->appointment_id)) {
                    $linkedAppt = Appointment::model()->findByPk($model->appointment_id);
                    if ($linkedAppt) {
                        $linkedAppt->appointment_status_id = 4; // 4 = Completed
                        $linkedAppt->save();
                    }
                    
                    Yii::app()->user->setFlash('success', "Consultation saved! Appointment marked as Completed.");
                    
                    // Redirect back to the Doctor's Queue instead of the view page
                    $this->redirect(array('appointment/myQueue'));
                }
                // --------------------------------------

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ConsultationRecord']))
		{
			$model->attributes=$_POST['ConsultationRecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ConsultationRecord');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ConsultationRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ConsultationRecord']))
			$model->attributes=$_GET['ConsultationRecord'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ConsultationRecord the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ConsultationRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ConsultationRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='consultation-record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
