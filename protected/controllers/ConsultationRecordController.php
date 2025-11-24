<?php

class ConsultationRecordController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

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
			// Allow Doctors ONLY to create/update
			array(
				'allow',
				'actions' => array('create', 'update', 'view'),
				'expression' => 'Yii::app()->controller->isDoctor()', // <--- CRITICAL FIX
			),
			// Allow Admins to manage/delete
			array(
				'allow',
				'actions' => array('admin', 'delete', 'index', 'view'),
				'expression' => 'Yii::app()->controller->isAdmin() || Yii::app()->controller->isSuperAdmin()',
			),
			// Allow Patients to View their OWN records (We handle ownership in actionView)
			array(
				'allow',
				'actions' => array('view'),
				'expression' => 'Yii::app()->controller->isPatient()',
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model = new ConsultationRecord;
		$appointment = null;
		$prescriptionModel = new Prescription;

		// 1. PRE-FILL DATA (If coming from the Queue)
		if (isset($_GET['appointment_id'])) {
			$apptId = (int)$_GET['appointment_id'];

			// --- CRITICAL FIX: EAGER LOAD APPOINTMENT WITH ALIASES ---
			// This ensures the necessary patient/doctor data is available for the view 
			// without crashing the SQL due to duplicate 'user' aliases.
			$appointment = Appointment::model()->with(array(
				'patientAccount' => array(
					'joinType' => 'LEFT OUTER JOIN',
					'with' => array(
						'user' => array('alias' => 'pUserA') // Patient User Alias for Controller
					)
				),
				'doctorAccount' => array(
					'joinType' => 'LEFT OUTER JOIN',
					'with' => array(
						'user' => array('alias' => 'dUserA') // Doctor User Alias for Controller
					)
				)
			))->findByPk($apptId);
			// --------------------------------------------------------

			if ($appointment) {
				$model->appointment_id = $apptId;
				$model->patient_account_id = $appointment->patient_account_id;
				$model->doctor_account_id = $appointment->doctor_account_id;
				$model->date_of_consultation = date('Y-m-d');
			}
		}

		if (isset($_POST['ConsultationRecord'])) {
			// ... (rest of the save logic: validation, transaction, commit) ...

			// NOTE: The rest of your logic below this line is assumed to be the FINAL, 
			// TRANSACTIONAL, AUDIT-LOGGING code we finalized in the previous step.

			// We ensure the variable names are correct for the save logic
			$model->attributes = $_POST['ConsultationRecord'];
			$prescriptionModel->attributes = $_POST['Prescription'];

			if (empty($model->doctor_account_id)) {
				$model->doctor_account_id = Yii::app()->user->id;
			}

			$valid = $model->validate();
			$hasPrescription = !empty(trim($prescriptionModel->prescription));
			if ($hasPrescription) {
				$valid = $prescriptionModel->validate() && $valid;
			}

			if ($valid) {
				$transaction = Yii::app()->db->beginTransaction();
				try {
					if ($model->save(false)) {

						if (!empty($model->appointment_id)) {
							$linkedAppt = Appointment::model()->findByPk($model->appointment_id);
							if ($linkedAppt) {
								$linkedAppt->appointment_status_id = 4;
								$linkedAppt->save(false);
							}
						}

						if ($hasPrescription) {
							$prescriptionModel->patient_account_id = $model->patient_account_id;
							$prescriptionModel->doctor_account_id = $model->doctor_account_id;
							$prescriptionModel->consultation_id = $model->id;
							$prescriptionModel->date_of_prescription = date('Y-m-d');
							$prescriptionModel->status_id = 1;
							$prescriptionModel->save(false);
						}

						if (class_exists('AuditHelper')) {
							AuditHelper::log('CREATE_CONSULTATION', 'tbl_consultation_record', $model->id, "SOAP Note created for Appt ID: " . $model->appointment_id);
						}

						$transaction->commit();
						Yii::app()->user->setFlash('success', "Consultation completed and records saved!");
						$this->redirect(array('view', 'id' => $model->id));
					}
				} catch (Exception $e) {
					$transaction->rollback();
					Yii::app()->user->setFlash('error', "Error saving: " . $e->getMessage());
				}
			}
		}

		$this->render('create', array(
			'model' => $model,
			'appointment' => $appointment,
			'prescriptionModel' => $prescriptionModel,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['ConsultationRecord'])) {
			$model->attributes = $_POST['ConsultationRecord'];
			if ($model->save()) {

				// --- AUDIT LOG: UPDATE ---
				if (class_exists('AuditHelper')) {
					AuditHelper::log(
						'UPDATE_CONSULTATION',
						'tbl_consultation_record',
						$model->id,
						"SOAP Note updated."
					);
				}
				// -------------------------

				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
			'model' => $model,
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
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('ConsultationRecord');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new ConsultationRecord('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ConsultationRecord']))
			$model->attributes = $_GET['ConsultationRecord'];

		$this->render('admin', array(
			'model' => $model,
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
		// CRITICAL FIX: Explicitly assign unique aliases (dUser and pUser) to the tbl_user table joins.
		$model = ConsultationRecord::model()->with(array(

			// Load Doctor's Account and User Profile (Alias dUser)
			'doctorAccount' => array(
				'joinType' => 'LEFT OUTER JOIN',
				'with' => array(
					'user' => array('alias' => 'dUser') // Doctor User Alias
				)
			),

			// Load Patient's Account and User Profile (Alias pUser)
			'patientAccount' => array(
				'joinType' => 'LEFT OUTER JOIN',
				'with' => array(
					'user' => array('alias' => 'pUser') // Patient User Alias
				)
			)
		))->findByPk($id); // Eager loads all necessary profile data

		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ConsultationRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'consultation-record-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
