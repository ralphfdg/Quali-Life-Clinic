<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 * * This action now routes to the correct dashboard based on user role.
	 */
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest)
		{
			// Render the public guest homepage
			$this->layout = '//layouts/column1'; // Use a single column for guest page
			$this->render('index_guest');
		}
		else
		{
			// User is logged in, determine which dashboard to show
			$this->layout = '//layouts/main'; // Ensure the main layout with sidebar is used
			$role = Yii::app()->user->getState("role");

			switch ($role)
			{
				case 'super admin':
					$this->renderDashboardSuperAdmin();
					break;
				case 'admin':
					$this->renderDashboardAdmin();
					break;
				case 'doctor':
					$this->renderDashboardDoctor();
					break;
				case 'patient':
					$this->renderDashboardPatient();
					break;
				default:
					// Fallback for any other case
					$this->render('index_guest');
			}
		}
	}

	/**
	 * Renders the Super Admin Dashboard
	 */
	private function renderDashboardSuperAdmin()
	{
		// 1. Key Stats
		$totalDoctors = Account::model()->count('account_type_id=3'); // 3 = doctor
		$totalPatients = Account::model()->count('account_type_id=4'); // 4 = patient
		
		// Total Appointments (Month)
		$monthStart = date('Y-m-01 00:00:00');
		$monthEnd = date('Y-m-t 23:59:59');
		$totalAppointmentsMonth = Appointment::model()->count(
			'schedule_datetime BETWEEN :start AND :end',
			array(':start' => $monthStart, ':end' => $monthEnd)
		);
		
		// 2. Earnings Report (Last 30 days)
		$earningsData = Yii::app()->db->createCommand()
			->select('DATE(date_paid) as day, SUM(amount) as total')
			->from('tbl_billing')
			->where('date_paid >= CURDATE() - INTERVAL 30 DAY')
			->group('DATE(date_paid)')
			->order('day ASC')
			->queryAll();
		
		// 3. Doctor Specialization Tally
		$specializationTally = Yii::app()->db->createCommand()
			->select('s.specialization_name, COUNT(u.id) as count')
			->from('tbl_user u')
			->join('tbl_specialization s', 'u.specialization_id = s.id')
			->join('tbl_account a', 'u.account_id = a.id')
			->where('a.account_type_id = 3') // 3 = doctor
			->group('s.specialization_name')
			->queryAll();

		$this->render('dashboard_superadmin', array(
			'totalDoctors' => $totalDoctors,
			'totalPatients' => $totalPatients,
			'totalAppointmentsMonth' => $totalAppointmentsMonth,
			'earningsData' => $earningsData,
			'specializationTally' => $specializationTally,
		));
	}

	/**
	 * Renders the Admin (Secretary) Dashboard
	 */
	/**
	 * Renders the Admin (Secretary) Dashboard
	 */
	private function renderDashboardAdmin()
	{
		// 1. Patient Queue (Today's Appointments)
		$todayStart = date('Y-m-d 00:00:00');
		$todayEnd = date('Y-m-d 23:59:59');
		
		$patientQueue = new CActiveDataProvider('Appointment', array(
			'criteria' => array(
				'condition' => 'schedule_datetime BETWEEN :start AND :end',
				'params' => array(':start' => $todayStart, ':end' => $todayEnd),
				'with' => array(
					// We must alias the user tables to avoid "Not unique table/alias: 'user'" error
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
					'appointmentStatus'
				),
				'order' => 'schedule_datetime ASC',
			),
			'pagination' => false,
		));

		// 2. Quick Stats
		$totalAppointmentsToday = $patientQueue->getTotalItemCount();
		
		// 2 = Arrived, 3 = In Consultation
		$patientsWaiting = Appointment::model()->count(
			'schedule_datetime BETWEEN :start AND :end AND appointment_status_id IN (2, 3)',
			array(':start' => $todayStart, ':end' => $todayEnd)
		);
		
		$this->render('dashboard_admin', array(
			'patientQueue' => $patientQueue,
			'totalAppointmentsToday' => $totalAppointmentsToday,
			'patientsWaiting' => $patientsWaiting,
		));
	}

	/**
	 * Renders the Doctor Dashboard
	 */
	private function renderDashboardDoctor()
	{
		$doctorId = Yii::app()->user->id;
		
		// 1. My Patient Queue
		$todayStart = date('Y-m-d 00:00:00');
		$todayEnd = date('Y-m-d 23:59:59');

		$myPatientQueue = new CActiveDataProvider('Appointment', array(
			'criteria' => array(
				'condition' => 'doctor_account_id = :docId AND schedule_datetime BETWEEN :start AND :end',
				'params' => array(
					':docId' => $doctorId,
					':start' => $todayStart, 
					':end' => $todayEnd
				),
				'with' => array('patientAccount.user', 'appointmentStatus'),
				'order' => 'schedule_datetime ASC',
			),
			'pagination' => false,
		));

		// 2. Quick Stats
		$totalAppointmentsToday = $myPatientQueue->getTotalItemCount();
		
		// 2 = Arrived, 3 = In Consultation
		$patientsWaiting = Appointment::model()->count(
			'doctor_account_id = :docId AND schedule_datetime BETWEEN :start AND :end AND appointment_status_id IN (2, 3)',
			array(
				':docId' => $doctorId,
				':start' => $todayStart, 
				':end' => $todayEnd
			)
		);
		
		$this->render('dashboard_doctor', array(
			'myPatientQueue' => $myPatientQueue,
			'totalAppointmentsToday' => $totalAppointmentsToday,
			'patientsWaiting' => $patientsWaiting,
		));
	}

	/**
	 * Renders the Patient Dashboard
	 */
	private function renderDashboardPatient()
	{
		$patientId = Yii::app()->user->id;
		
		// 1. Upcoming Appointment
		$upcomingAppointment = Appointment::model()->with('doctorAccount.user')->find(
			'patient_account_id = :patientId AND schedule_datetime > NOW() AND appointment_status_id = 1', // 1 = Scheduled
			array(':patientId' => $patientId),
			array('order' => 'schedule_datetime ASC')
		);
		
		$this->render('dashboard_patient', array(
			'upcomingAppointment' => $upcomingAppointment,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/column1'; // Use single column layout for login
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the dashboard
			if($model->validate() && $model->login())
				$this->redirect(array('/site/index')); // Redirect to main index, which will route to dashboard
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}