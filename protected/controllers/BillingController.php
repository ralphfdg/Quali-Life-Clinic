<?php

class BillingController extends Controller
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
			array('allow',  // allow only Super Admin to perform all actions
				'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete'),
				'expression'=>array($this, 'isSuperAdmin'), // Use our helper function
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
		$model=new Billing;

		if(isset($_POST['Billing']))
		{
			$model->attributes=$_POST['Billing'];
			
			//--- CUSTOM LOGIC ---
			// 1. Find the appointment to get the patient ID
			$appointment = Appointment::model()->findByPk($model->appointment_id);
			if ($appointment) {
				$model->patient_account_id = $appointment->patient_account_id;
			}
			
			// 2. Set who created this bill
			$model->created_by_account_id = Yii::app()->user->id;
			
			// 3. Set payment date if status is 'Paid'
			if ($model->payment_status == 'Paid' && empty($model->date_paid)) {
				$model->date_paid = new CDbExpression('NOW()');
			}
			//--- END CUSTOM LOGIC ---
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		//--- CUSTOM LOGIC ---
		// We only want to bill for appointments that are:
		// 1. Completed (status_id = 4)
		// 2. Not already billed
		
		// Get all appointment IDs that already have a billing record
		$billed_app_ids = Yii::app()->db->createCommand()
			->select('appointment_id')
			->from('{{billing}}')
			->where('appointment_id IS NOT NULL')
			->queryColumn();

		$criteria = new CDbCriteria;
		$criteria->addCondition('appointment_status_id = 4'); // 4 = Completed
		$criteria->addNotInCondition('id', $billed_app_ids); // Exclude already billed
		$criteria->with = array('patientAccount.user', 'doctorAccount.user');
		$criteria->order = 'schedule_datetime DESC';
		
		$availableAppointments = Appointment::model()->findAll($criteria);
		//--- END CUSTOM LOGIC ---

		$this->render('create',array(
			'model'=>$model,
			'availableAppointments'=>$availableAppointments, // Pass this to the view
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

		if(isset($_POST['Billing']))
		{
			$model->attributes=$_POST['Billing'];
			
			//--- CUSTOM LOGIC ---
			// 1. Set payment date if status is 'Paid' and date is not already set
			if ($model->payment_status == 'Paid' && empty($model->date_paid)) {
				$model->date_paid = new CDbExpression('NOW()');
			}
			// 2. If status is set back to 'Pending', clear the payment date
			if ($model->payment_status == 'Pending') {
				$model->date_paid = null;
			}
			//--- END CUSTOM LOGIC ---
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		// On update, we don't need to filter appointments,
		// as the appointment is already set.
		$this->render('update',array(
			'model'=>$model,
			'availableAppointments'=>array(), // Not needed for update
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
		$dataProvider=new CActiveDataProvider('Billing');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Billing('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Billing']))
			$model->attributes=$_GET['Billing'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Billing the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		// Eager load the related data
		$model=Billing::model()->with('appointment', 'patientAccount.user', 'createdByAccount.user')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Billing $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='billing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}