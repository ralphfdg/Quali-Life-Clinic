<?php

class AppointmentController extends Controller
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
			// Allow Patients to Book, View Own, AND fetch Doctors
			array('allow',
				// Added 'getAvailableSlots' to the list
				'actions'=>array('book', 'myAppointments', 'view', 'create', 'dynamicDoctors', 'getAvailableSlots', 'cancel'),
				'expression'=>'Yii::app()->controller->isPatient()',
			),
			// Allow Doctors
			array('allow',
				'actions'=>array('index', 'view', 'updateStatus', 'myQueue'),
				'expression'=>'Yii::app()->controller->isDoctor()',
			),
			// Allow Admins & Super Admins
			array('allow',
				// ADD 'dynamicDoctors' HERE TOO:
				'actions'=>array('index', 'view', 'create', 'update', 'admin', 'delete', 'calendar', 'cancel', 'dynamicDoctors'),
				'expression'=>'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()',
			),
			// Deny everyone else
			array('deny',
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
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Appointment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Appointment'])) {
			$model->attributes = $_POST['Appointment'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
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
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Appointment'])) {
			$model->attributes = $_POST['Appointment'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
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
		$dataProvider = new CActiveDataProvider('Appointment');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Appointment('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Appointment']))
			$model->attributes = $_GET['Appointment'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Appointment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Appointment::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Appointment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'appointment-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Displays the appointment calendar/list.
	 */
	public function actionCalendar()
	{
		$dataProvider = new CActiveDataProvider('Appointment', array(
			'criteria'=>array(
				'order'=>'schedule_datetime ASC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));

		$this->render('calendar', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Step 1 & 2: Patient Booking Page
	 */
	/**
     * Step 1 & 2: Patient Booking Page
     */
    public function actionBook()
    {
        $model = new Appointment;

        // --- ADDED THIS BLOCK TO HANDLE SAVING ---
        if(isset($_POST['Appointment']))
        {
            $model->attributes = $_POST['Appointment'];
            
            // We have the Date in $model->schedule_datetime (from the date picker)
            // We have the Time in $_POST['selected_time'] (from the hidden field)
            
            if (isset($_POST['selected_time']) && !empty($_POST['selected_time'])) {
                // Combine Date and Time: "2025-11-23" + " " + "09:30"
                $fullDateTime = $model->schedule_datetime . ' ' . $_POST['selected_time'];
                $model->schedule_datetime = $fullDateTime;
                
                // Set auto-fields
                $model->patient_account_id = Yii::app()->user->id;
                $model->booked_by_account_id = Yii::app()->user->id;
                $model->appointment_status_id = 1; // Scheduled
                // $model->clinic_id = 1; // Uncomment if you use clinic_id
                
                if($model->save()) {
                    Yii::app()->user->setFlash('success', "Appointment successfully booked!");
                    $this->redirect(array('site/index'));
                }
            } else {
                $model->addError('schedule_datetime', 'Please select a valid time slot.');
            }
        }
        // -----------------------------------------

        $this->render('book',array(
            'model'=>$model,
        ));
    }

	/**
	 * AJAX Helper: Returns <option> tags for doctors based on specialization_id
	 */
	public function actionDynamicDoctors()
	{
		// The dropdown name in the view will generate a POST variable named 'specialization_id'
		// But since we are using a custom CHtml::dropDownList, we check the POST data directly.
		
		$spec_id = (int) $_POST['specialization_id'];

		$data = Account::model()->with('user')->findAll(array(
			'condition' => 'account_type_id=3 AND status_id=1 AND user.specialization_id=:spec_id',
			'params'    => array(':spec_id'=>$spec_id),
		));

		$data = CHtml::listData($data, 'id', function($account) {
			return 'Dr. ' . $account->user->firstname . ' ' . $account->user->lastname;
		});

		echo CHtml::tag('option', array('value'=>''), 'Select a Doctor', true);
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
		}
	}

	public function actionGetAvailableSlots()
	{
		if (!isset($_POST['doctor_id']) || !isset($_POST['date'])) {
			echo "<div class='flash-error'>Please select a doctor and date.</div>";
			Yii::app()->end();
		}

		$doctorId = (int)$_POST['doctor_id'];
		$date = $_POST['date'];
		
		// 1. Determine Day of Week (0 = Sunday, etc.)
		$timestamp = strtotime($date);
		$dayOfWeek = date('w', $timestamp);

		// 2. Check Doctor's Schedule for this day
		$schedule = DoctorSchedule::model()->find(
			'doctor_account_id=:docId AND day_of_week=:day AND status_id=1',
			array(':docId'=>$doctorId, ':day'=>$dayOfWeek)
		);

		if (!$schedule) {
			echo "<div class='flash-notice'>Doctor is not scheduled to work on this day.</div>";
			Yii::app()->end();
		}

		// 3. Get all existing appointments for this doctor on this specific date
		$bookedAppointments = Appointment::model()->findAll(
			'doctor_account_id=:docId AND date(schedule_datetime)=:date AND appointment_status_id != 5', // 5 = Canceled
			array(':docId'=>$doctorId, ':date'=>$date)
		);

		// Store booked times in a simple array (e.g., '09:00', '10:30')
		$bookedTimes = array();
		foreach($bookedAppointments as $appt) {
			$bookedTimes[] = date('H:i', strtotime($appt->schedule_datetime));
		}

		// 4. Generate Time Slots (30-minute intervals)
		$startTime = strtotime($schedule->start_time);
		$endTime = strtotime($schedule->end_time);
		$interval = 30 * 60; // 30 minutes in seconds

		echo "<div class='time-slots'>";
		echo "<p>Available slots for <strong>".date('F j, Y', $timestamp)."</strong>:</p>";
		
		$slotsFound = false;

		for ($time = $startTime; $time < $endTime; $time += $interval) {
			$currentTimeSlot = date('H:i', $time);
			$displayTime = date('g:i A', $time);

			// Style: Red if booked, Green if available
			if (in_array($currentTimeSlot, $bookedTimes)) {
				// Booked - Show as disabled
				echo "<button type='button' class='slot-btn disabled' disabled style='margin:5px; background-color:#ccc; border:1px solid #999; color:#666;'>$displayTime (Taken)</button>";
			} else {
				// Available - Clickable
				// We use a small JS onclick to put the value into the hidden field
				echo "<button type='button' class='slot-btn available' 
						style='margin:5px; cursor:pointer; background-color:#dfd; border:1px solid #4a4; padding:5px 10px;'
						onclick='selectTime(\"$currentTimeSlot\", this)'>$displayTime</button>";
				$slotsFound = true;
			}
		}
		
		if (!$slotsFound) {
			echo "<p>No slots available.</p>";
		}
		
		echo "</div>";
	}

	/**
	 * List the logged-in Patient's appointments
	 */
	public function actionMyAppointments()
	{
		$patientId = Yii::app()->user->id;

		$dataProvider = new CActiveDataProvider('Appointment', array(
			'criteria'=>array(
				'condition'=>'patient_account_id = :pid',
				'params'=>array(':pid'=>$patientId),
				'with'=>array('doctorAccount.user', 'appointmentStatus'),
				'order'=>'schedule_datetime ASC', // Upcoming first
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$this->render('myAppointments', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Allow Patient to Cancel their own appointment
	 */
	public function actionCancel($id)
	{
		$model = $this->loadModel($id);

		// Security Check: Ensure the logged-in user owns this appointment
		if($model->patient_account_id != Yii::app()->user->id && !$this->isAdmin() && !$this->isSuperAdmin()) {
			throw new CHttpException(403, 'You are not authorized to cancel this appointment.');
		}

		// Only allow canceling if it's 'Scheduled' (1) or 'Arrived' (2)
		if($model->appointment_status_id == 1 || $model->appointment_status_id == 2) {
			$model->appointment_status_id = 5; // 5 = Canceled
			$model->cancellation_reason = "Canceled by Patient";
			
			if($model->save()) {
				Yii::app()->user->setFlash('success', "Appointment #$id has been canceled.");
			} else {
				Yii::app()->user->setFlash('error', "Could not cancel appointment.");
			}
		} else {
			Yii::app()->user->setFlash('error', "This appointment cannot be canceled anymore.");
		}

		// Redirect back to the list
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('myAppointments'));
	}

	
}
