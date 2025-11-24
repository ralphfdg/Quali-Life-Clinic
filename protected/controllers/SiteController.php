<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	public function accessRules()
    {
        return array(
            // 1. Allow Guests (*) to access the Landing Page, Login, and Error page
            array('allow', 
                'actions' => array('index', 'login', 'error'),
                'users' => array('*'), // * means ALL users (including guests)
            ),
            
            // 2. Authenticated Users (@) can access logout
            array('allow',
                'actions' => array('logout'),
                'users' => array('@'), // @ means authenticated (logged-in) users
            ),
            
            // 3. Deny ALL other actions for guests and unknown users
            array('deny', 
                'users' => array('*'),
            ),
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// 1. Guest -> Landing Page
		if (Yii::app()->user->isGuest) {
			$this->layout = '//layouts/column1';
			$this->render('index_guest');
		} else {
			// 2. Route based on Role
			if (Yii::app()->controller->isSuperAdmin()) {
				$this->renderSuperAdminDashboard();
			} elseif (Yii::app()->controller->isAdmin()) {
				$this->renderAdminDashboard();
			} elseif (Yii::app()->controller->isDoctor()) {
				$this->renderDoctorDashboard();
			} elseif (Yii::app()->controller->isPatient()) {
				$this->renderPatientDashboard();
			} else {
				$this->render('index'); // Fallback
			}
		}
	}

	/**
	 * 🏥 SUPER ADMIN: High-level stats & charts
	 */
	protected function renderSuperAdminDashboard()
	{
		// --- 1. DEFINE THE COUNTERS (This fixes the "Undefined variable" error) ---
		$totalDoctors = Account::model()->count('account_type_id=3 AND status_id=1');
		$totalPatients = Account::model()->count('account_type_id=4 AND status_id=1');

		// Appts this month
		$startMonth = date('Y-m-01');
		$endMonth = date('Y-m-t');
		$totalApptMonth = Appointment::model()->count(
			'schedule_datetime BETWEEN :start AND :end AND appointment_status_id != 5',
			array(':start' => $startMonth, ':end' => $endMonth)
		);

		// Appts Today
		$today = date('Y-m-d');
		$totalApptToday = Appointment::model()->count(
			'date(schedule_datetime) = :today AND appointment_status_id != 5',
			array(':today' => $today)
		);

		// --- 2. CHART DATA: Activity (-5 days to +25 days) ---
		$chartLabels = array();
		$chartData = array();

		// Get timestamp for today at midnight
		$todayTimestamp = strtotime(date('Y-m-d'));

		// Loop from -5 (5 days ago) to 25 (25 days in the future)
		for ($i = -5; $i <= 25; $i++) {
			$loopDate = strtotime("$i days", $todayTimestamp);
			$d = date('Y-m-d', $loopDate);
			$displayDate = date('M j', $loopDate);

			$count = Appointment::model()->count(
				'date(schedule_datetime)=:d AND appointment_status_id!=5',
				array(':d' => $d)
			);

			$chartLabels[] = $displayDate;
			$chartData[] = (int)$count;
		}

		// --- 3. PIE CHART: Doctor Specializations ---
		$specs = Yii::app()->db->createCommand()
			->select('s.specialization_name, COUNT(u.id) as count')
			->from('tbl_user u')
			->join('tbl_specialization s', 'u.specialization_id = s.id')
			->join('tbl_account a', 'u.account_id = a.id')
			->where('a.account_type_id=3 AND a.status_id=1')
			->group('s.specialization_name')
			->queryAll();

		$pieLabels = array();
		$pieData = array();
		foreach ($specs as $row) {
			$pieLabels[] = $row['specialization_name'];
			$pieData[] = (int)$row['count'];
		}

		// --- 4. RENDER THE VIEW ---
		$this->render('dashboard_superadmin', array(
			'totalDoctors' => $totalDoctors,     // Passed here
			'totalPatients' => $totalPatients,   // Passed here
			'totalApptMonth' => $totalApptMonth, // Passed here
			'totalApptToday' => $totalApptToday, // Passed here
			'chartLabels' => CJSON::encode($chartLabels),
			'chartData' => CJSON::encode($chartData),
			'pieLabels' => CJSON::encode($pieLabels),
			'pieData' => CJSON::encode($pieData),
		));
	}

	/**
	 * 📋 ADMIN (Secretary): Live Queue Management
	 */
	protected function renderAdminDashboard()
	{
		$today = date('Y-m-d');

		// Get Today's Appointments for the Grid
		$criteria = new CDbCriteria;
		$criteria->addCondition("date(t.schedule_datetime) = :today");
		$criteria->compare('t.appointment_status_id', '<>5'); // Not canceled
		$criteria->params[':today'] = $today;
		$criteria->order = 't.schedule_datetime ASC';

		// --- FIX STARTS HERE: Explicit Aliases for User Tables ---
		$criteria->with = array(
			'appointmentStatus',
			'patientAccount' => array(
				'with' => array(
					'user' => array('alias' => 'patientUser')
				)
			),
			'doctorAccount' => array(
				'with' => array(
					'user' => array('alias' => 'doctorUser')
				)
			),
		);

		$dataProvider = new CActiveDataProvider('Appointment', array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20),
		));

		// Quick Stats
		$countTotal = Appointment::model()->count('date(schedule_datetime)=:t AND appointment_status_id!=5', array(':t' => $today));
		$countWaiting = Appointment::model()->count('date(schedule_datetime)=:t AND appointment_status_id=2', array(':t' => $today)); // 2 = Arrived

		$this->render('dashboard_admin', array(
			'dataProvider' => $dataProvider,
			'countTotal' => $countTotal,
			'countWaiting' => $countWaiting,
		));
	}

	/**
	 * 🧑‍⚕️ DOCTOR: My Personal Queue
	 */
	protected function renderDoctorDashboard()
	{
		$doctorId = Yii::app()->user->id;
		$today = date('Y-m-d');

		// Grid: My Appointments Today
		$criteria = new CDbCriteria;
		$criteria->compare('doctor_account_id', $doctorId);
		$criteria->addCondition("date(t.schedule_datetime) = :today");
		$criteria->compare('t.appointment_status_id', '<>5');
		$criteria->params[':today'] = $today;
		$criteria->order = 't.schedule_datetime ASC';
		$criteria->with = array('patientAccount.user', 'appointmentStatus');

		$dataProvider = new CActiveDataProvider('Appointment', array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20),
		));

		// Quick Stats
		$myTotal = Appointment::model()->count('doctor_account_id=:d AND date(schedule_datetime)=:t AND appointment_status_id!=5', array(':d' => $doctorId, ':t' => $today));
		$myWaiting = Appointment::model()->count('doctor_account_id=:d AND date(schedule_datetime)=:t AND appointment_status_id=2', array(':d' => $doctorId, ':t' => $today));

		$this->render('dashboard_doctor', array(
			'dataProvider' => $dataProvider,
			'myTotal' => $myTotal,
			'myWaiting' => $myWaiting,
		));
	}

	/**
	 * 👤 PATIENT: Next Appointment Card
	 */
	protected function renderPatientDashboard()
	{
		$patientId = Yii::app()->user->id;

		// Find NEXT Upcoming Appointment
		$nextAppt = Appointment::model()->find(array(
			'condition' => 'patient_account_id=:pid AND schedule_datetime > NOW() AND appointment_status_id!=5',
			'params' => array(':pid' => $patientId),
			'order' => 'schedule_datetime ASC',
			'limit' => 1,
			'with' => array('doctorAccount.user')
		));

		$this->render('dashboard_patient', array(
			'nextAppt' => $nextAppt,
		));
	}

	/**
	 * Standard Error Handling
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Login Action
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logout Action
	 */
	public function actionLogout()
	{
		// --- LOG LOGOUT EVENT ---
		if (!Yii::app()->user->isGuest) {
			AuditHelper::log(
				'LOGOUT',
				'tbl_account',
				Yii::app()->user->id,
				'User logged out.'
			);
		}
		// -----------------------------

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
