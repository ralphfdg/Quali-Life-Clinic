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
            // 1. Allow Patients (Booking helpers, viewing own data)
            array(
                'allow',
                'actions' => array('book', 'myAppointments', 'view', 'create', 'dynamicDoctors', 'getAvailableSlots', 'cancel', 'calendarEvents'),
                'expression' => 'Yii::app()->controller->isPatient()',
            ),
            
            // 2. Allow Doctors (Queue management, viewing history)
            array(
                'allow',
                'actions' => array('index', 'view', 'updateStatus', 'myQueue', 'calendarEvents', 'myHistory', 'dynamicDoctors', 'getAvailableSlots'),
                'expression' => 'Yii::app()->controller->isDoctor()',
            ),
            
            // 3. Allow Admins & Super Admins (Full access)
            array(
                'allow',
                // CRITICAL FIX: Ensure 'calendarEvents' is here!
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'calendar', 'cancel', 'updateStatus', 'book', 'dynamicDoctors', 'getAvailableSlots', 'calendarEvents'),
                'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()',
            ),
            
            // 4. Deny everyone else
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

		if (isset($_POST['Appointment'])) {
			$model->attributes = $_POST['Appointment'];
			if ($model->save()) {

				// --- AUDIT LOG ---
				if (class_exists('AuditHelper')) {
					AuditHelper::log(
						'UPDATE_APPOINTMENT',
						'tbl_appointment',
						$model->id,
						"Updated appointment details"
					);
				}
				// -----------------

				Yii::app()->user->setFlash('success', "Appointment updated successfully.");
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
			'criteria' => array(
				'order' => 'schedule_datetime ASC',
			),
			'pagination' => array(
				'pageSize' => 20,
			),
		));

		$this->render('calendar', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionBook()
    {
        $model = new Appointment;
        $isAdminOrSuperAdmin = Yii::app()->user->isAdmin() || Yii::app()->user->isSuperAdmin();
        $patientList = array();
        
        // --- DEFINITIVE SCOPE FIX: Initialize variables used in rendering ---
        $patientId = Yii::app()->user->isPatient() ? Yii::app()->user->id : 0; 
        // ------------------------------------------------------------------

        if ($isAdminOrSuperAdmin) {
            $patients = Account::model()->with('user')->findAll('account_type_id=4 AND status_id=1');
            $patientList = CHtml::listData($patients, 'id', function($p) {
                return (isset($p->user) ? $p->user->lastname . ', ' . $p->user->firstname : $p->username);
            });
        }
        
        // --- Handle Save Logic ---
        if (isset($_POST['Appointment'])) {
            $model->attributes = $_POST['Appointment'];
            
            // 1. Determine the Patient ID
            if ($isAdminOrSuperAdmin) {
                $patientId = (int) $_POST['selected_patient_id'];
            } else {
                // PatientId is already set from the initialization above if user is Patient
            }
            
            // ... (rest of the save logic using $patientId) ...
            
            if (isset($_POST['selected_time']) && !empty($_POST['selected_time'])) {
                
                if ($patientId === 0) {
                    $model->addError('patient_account_id', 'Please select a patient before confirming.');
                    goto render;
                }

                $fullDateTime = $model->schedule_datetime . ' ' . $_POST['selected_time'];
                $model->schedule_datetime = $fullDateTime;
                $model->patient_account_id = $patientId; 
                $model->booked_by_account_id = Yii::app()->user->id;
                $model->appointment_status_id = 1;

                if ($model->save()) {
                    if(class_exists('AuditHelper')) {
                        AuditHelper::log('CREATE_APPOINTMENT', 'tbl_appointment', $model->id, "Booked for Patient ID: " . $patientId);
                    }
                    
                    Yii::app()->user->setFlash('success', "Appointment successfully booked!");
                    $this->redirect(array('site/index'));
                }
            } else {
                $model->addError('schedule_datetime', 'Please select a valid time slot.');
            }
        }

        render: 
        $this->render('book', array(
            'model' => $model,
            'patientList' => $patientList,
            'isAdminOrSuperAdmin' => $isAdminOrSuperAdmin,
            'patientId' => $patientId, // Pass the now-guaranteed variable
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
			'params'    => array(':spec_id' => $spec_id),
		));

		$data = CHtml::listData($data, 'id', function ($account) {
			return 'Dr. ' . $account->user->firstname . ' ' . $account->user->lastname;
		});

		echo CHtml::tag('option', array('value' => ''), 'Select a Doctor', true);
		foreach ($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
		}
	}

	public function actionGetAvailableSlots()
	{
		if (!isset($_POST['doctor_id']) || !isset($_POST['date'])) {
			// ... (error handling) ...
		}

		$doctorId = (int)$_POST['doctor_id'];
		$date = $_POST['date'];

		// 1. Determine Day of Week (0 = Sunday, etc.)
		$timestamp = strtotime($date);
		$dayOfWeek = date('w', $timestamp); // PHP's day (0=Sun, 1=Mon)

		// --- DEBUG TRAP: Check the input values ---
		Yii::log("Slot Check: DoctorID=$doctorId, Date=$date, DayOfWeek=$dayOfWeek", 'info', 'application.slots');
		// ------------------------------------------

		// 2. Check Doctor's Schedule for this day
		$schedule = DoctorSchedule::model()->find(
			'doctor_account_id=:docId AND day_of_week=:day AND status_id=1',
			array(':docId' => $doctorId, ':day' => $dayOfWeek)
		);

		if (!$schedule) {
			// Check why it's missing
			$dayNames = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			$dayName = $dayNames[$dayOfWeek];

			// This will show up if the schedule is missing in the DB
			echo "<div class='alert alert-danger'>ERROR: Dr. is not scheduled to work on $dayName, or schedule is Inactive. (DB Check: Day $dayOfWeek)</div>";
			Yii::app()->end();
		}

		// --- DEBUG TRAP: Check the found schedule times ---
		Yii::log("Schedule Found: Start={$schedule->start_time}, End={$schedule->end_time}", 'info', 'application.slots');
		// --------------------------------------------------

		// 3. Get all existing appointments for this doctor on this specific date
		$bookedAppointments = Appointment::model()->findAll(
			'doctor_account_id=:docId AND date(schedule_datetime)=:date AND appointment_status_id != 5', // 5 = Canceled
			array(':docId' => $doctorId, ':date' => $date)
		);

		// Store booked times in a simple array (e.g., '09:00', '10:30')
		$bookedTimes = array();
		foreach ($bookedAppointments as $appt) {
			$bookedTimes[] = date('H:i', strtotime($appt->schedule_datetime));
		}

		// 4. Generate Time Slots (30-minute intervals)
		$startTime = strtotime($schedule->start_time);
		$endTime = strtotime($schedule->end_time);
		$interval = 30 * 60; // 30 minutes in seconds

		echo "<div class='time-slots'>";
		echo "<p>Available slots for <strong>" . date('F j, Y', $timestamp) . "</strong>:</p>";

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
			'criteria' => array(
				'condition' => 'patient_account_id = :pid',
				'params' => array(':pid' => $patientId),
				'with' => array('doctorAccount.user', 'appointmentStatus'),
				'order' => 'schedule_datetime ASC', // Upcoming first
			),
			'pagination' => array(
				'pageSize' => 10,
			),
		));

		$this->render('myAppointments', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Allow Patient to Cancel their own appointment
	 */
	public function actionCancel($id)
	{
		$model = $this->loadModel($id);

		// Security Check: Ensure the logged-in user owns this appointment
		if ($model->patient_account_id != Yii::app()->user->id && !$this->isAdmin() && !$this->isSuperAdmin()) {
			throw new CHttpException(403, 'You are not authorized to cancel this appointment.');
		}

		// Only allow canceling if it's 'Scheduled' (1) or 'Arrived' (2)
		if ($model->appointment_status_id == 1 || $model->appointment_status_id == 2) {
			$model->appointment_status_id = 5; // 5 = Canceled
			$model->cancellation_reason = "Canceled by Patient";

			if ($model->save()) {
				// --- AUDIT LOG HERE ---
				if (class_exists('AuditHelper')) {
					AuditHelper::log(
						'CANCEL_APPOINTMENT',
						'tbl_appointment',
						$model->id,
						"Reason: " . $model->cancellation_reason
					);
				}
				// --------------------------

				Yii::app()->user->setFlash('success', "Appointment #$id has been canceled.");
			} else {
				Yii::app()->user->setFlash('error', "Could not cancel appointment.");
			}
		} else {
			Yii::app()->user->setFlash('error', "This appointment cannot be canceled anymore.");
		}

		// Redirect back to the list
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('myAppointments'));
	}

	public function actionCalendarEvents()
    {
        $start = null;
        $end = null;
        
        $startParam = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $endParam  = isset($_GET['end'])  ? $_GET['end']  : date('Y-m-t');

        // Convert timestamps to MySQL format
        if (ctype_digit((string)$startParam)) {
            $start = date('Y-m-d H:i:s', $startParam);
            $end  = date('Y-m-d H:i:s', $endParam);
        } else {
            $start = date('Y-m-d H:i:s', strtotime($startParam));
            $end  = date('Y-m-d H:i:s', strtotime($endParam));
        }

        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('t.schedule_datetime', $start, $end);
        $criteria->compare('t.appointment_status_id', '<>5'); // 5 = Canceled

        // --- CRITICAL FIX: FORCE LEFT OUTER JOIN ---
        // This ensures the query returns appointments even if Patient or Doctor profile is missing.
        $criteria->with = array(
            'appointmentStatus',
            'patientAccount' => array(
                'joinType'=>'LEFT OUTER JOIN', // Ensures rows are NOT dropped if relation fails
                'with' => array(
                    'user' => array('alias' => 'patientUser')
                )
            ),
            'doctorAccount' => array(
                'joinType'=>'LEFT OUTER JOIN', // Ensures rows are NOT dropped
                'with' => array(
                    'user' => array('alias' => 'doctorUser')
                )
            ),
        );
        // ------------------------------------------
        
        $appointments = Appointment::model()->findAll($criteria);
        $events = array();
        
        // --- Crash Prevention Logic (Use try/catch and null checks) ---
        foreach ($appointments as $appt) {
            try {
                $pUser = isset($appt->patientAccount->user) ? $appt->patientAccount->user : null;
                $patientName = $pUser ? $pUser->firstname . ' ' . $pUser->lastname : "Unknown Patient";

                $dUser = isset($appt->doctorAccount->user) ? $appt->doctorAccount->user : null;
                $doctorName = $dUser ? $dUser->lastname : "Unassigned";

                $statusName = isset($appt->appointmentStatus) ? $appt->appointmentStatus->status_name : "Unknown";
                $color = '#3788d8'; // Scheduled
                if ($appt->appointment_status_id == 2) $color = '#28a745'; 
                if ($appt->appointment_status_id == 3) $color = '#e0a800'; 
                if ($appt->appointment_status_id == 4) $color = '#6c757d'; 
                
                $events[] = array(
                    'id' => $appt->id,
                    'title' => "Dr. " . $doctorName . " - " . $patientName,
                    'start' => date('Y-m-d\TH:i:s', strtotime($appt->schedule_datetime)),
                    'color' => $color,
                    'extendedProps' => array(
                        'patientName' => $patientName,
                        'status' => $statusName
                    ),
                    'url'  => $this->createUrl('view', array('id' => $appt->id)),
                );
            } catch (\Exception $e) {
                Yii::log("Calendar Event Crash on Appt ID {$appt->id}: " . $e->getMessage(), 'error', 'application.calendar');
                continue;
            }
        }

        header('Content-type: application/json');
        echo CJSON::encode($events);
        Yii::app()->end();
    }

	/**
	 * Doctor's Dashboard: Shows ONLY today's appointments for the logged-in doctor.
	 */
	public function actionMyQueue()
	{
		$doctorId = Yii::app()->user->id;
		$today = date('Y-m-d');

		$criteria = new CDbCriteria;

		// 1. Filter by Current Doctor AND Today's Date
		$criteria->compare('doctor_account_id', $doctorId);
		//$criteria->addCondition("date(t.schedule_datetime) = :today");
		//$criteria->params[':today'] = $today;

		// 2. Order by time (earliest first)
		$criteria->order = 't.schedule_datetime ASC';

		// 3. Load Patient info (using the alias fix we learned earlier!)
		$criteria->with = array(
			'appointmentStatus',
			'patientAccount' => array(
				'with' => array(
					'user' => array('alias' => 'patientUser')
				)
			)
		);

		$dataProvider = new CActiveDataProvider('Appointment', array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 50), // Show all patients for the day
		));

		$this->render('myQueue', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Action to change status (e.g., Mark as Arrived, Start Consult, Complete)
	 */
	public function actionUpdateStatus($id, $status)
	{
		$model = $this->loadModel($id);

		// Security Check: Ensure this appointment belongs to the logged-in Doctor OR is checked in by Admin
		// This check remains essential to prevent users from updating random appointments.
		if ($model->doctor_account_id != Yii::app()->user->id && !Yii::app()->user->isAdmin() && !Yii::app()->user->isSuperAdmin()) {
			throw new CHttpException(403, 'You cannot update appointments that are not assigned to you.');
		}

		$model->appointment_status_id = (int)$status;

		if ($model->save()) {
			// --- AUDIT LOG ---
			if (class_exists('AuditHelper')) {
				$statusName = ($status == 2) ? 'Arrived' : (($status == 3) ? 'In Consultation' : 'Completed');

				AuditHelper::log(
					'UPDATE_STATUS',
					'tbl_appointment',
					$model->id,
					"Changed status to: $statusName"
				);
			}
			// --------------------------

			// --- REDIRECT LOGIC FIX ---
			if ((int)$status === 3) {
				// If starting consultation, redirect to SOAP form (Doctors only)
				$this->redirect(array('consultationRecord/create', 'appointment_id' => $model->id));
			}

			Yii::app()->user->setFlash('success', "Status updated successfully.");

			// CRITICAL FIX: Redirect to the user's respective dashboard/queue
			if (Yii::app()->user->isDoctor()) {
				// Doctors go back to their personalized queue page
				$this->redirect(array('myQueue'));
			} else {
				// Admins/Secretaries go back to the main dashboard (Secretary Queue)
				$this->redirect(array('site/index'));
			}
		} else {
			Yii::app()->user->setFlash('error', "Error updating status.");
			// Fallback redirect in case of save failure
			$this->redirect(array('site/index'));
		}
	}

	/**
	 * Shows completed appointments and links to their SOAP notes.
	 */
	public function actionMyHistory()
	{
		$doctorId = Yii::app()->user->id;

		$criteria = new CDbCriteria;

		$criteria->compare('t.doctor_account_id', $doctorId);
		$criteria->compare('t.appointment_status_id', 4); // 4 = Completed

		// 3. Order by Date (Newest first)
		$criteria->order = 't.schedule_datetime DESC';

		// 4. Load Relations (Including the Consultation Record!)
		// Note: We need 'consultationRecords' to find the ID of the SOAP note to view.
		$criteria->with = array(
			'patientAccount.user' => array('alias' => 'patientUser'),
			'consultationRecords'
		);

		$dataProvider = new CActiveDataProvider('Appointment', array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20),
		));

		$this->render('myHistory', array(
			'dataProvider' => $dataProvider,
		));
	}
}
