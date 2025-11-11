<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><div id="mainmenu">
		<?php 
		// Main top-level menu
		$topMenuItems = array();
		if (Yii::app()->user->isGuest) {
			$topMenuItems[] = array('label'=>'Home', 'url'=>array('/site/index'));
			$topMenuItems[] = array('label'=>'Login', 'url'=>array('/site/login'));
		} else {
			$topMenuItems[] = array('label'=>'Dashboard', 'url'=>array('/site/index'));
			
			// Add "My Account" link for all logged-in users
			// This assumes you will create a controller/action for this
			// $topMenuItems[] = array('label'=>'My Account', 'url'=>array('/user/myAccount')); 
			
			$topMenuItems[] = array('label'=>'Logout ('.Yii::app()->user->getState('displayName').')', 'url'=>array('/site/logout'));
		}
		
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$topMenuItems,
		)); 
		?>
	</div><?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><?php endif?>

	<?php
	// --- DYNAMIC SIDEBAR LOGIC ---
	// This generates the sidebar menu items based on the user's role
	
	$sidebarMenu = array();
	
	if ($this->isSuperAdmin())
	{
		$sidebarMenu = array(
			array('label'=>'🏥 Super Admin Menu', 'itemOptions'=>array('class'=>'sidebar-header')),
			array('label'=>'Dashboard', 'url'=>array('/site/index')),
			array('label'=>'Manage Doctors', 'url'=>array('/user/admin', 'role'=>'doctor')), // We'll customize this later
			array('label'=>'Manage Admins', 'url'=>array('/user/admin', 'role'=>'admin')), // We'll customize this later
			array('label'=>'Manage Patients', 'url'=>array('/user/admin', 'role'=>'patient')), // We'll customize this later
			array('label'=>'Generate Report', 'url'=>array('/report/index')), // Needs new controller
			array('label'=>'Audit Log', 'url'=>array('/auditLog/admin')),
			array('label'=>'My Account', 'url'=>array('/account/update', 'id'=>Yii::app()->user->id)),
			
			array('label'=>'Gii CRUD (Dev)', 'itemOptions'=>array('class'=>'sidebar-header')),
			array('label'=>'Manage Accounts', 'url'=>array('/account/admin')),
			array('label'=>'Manage Users', 'url'=>array('/user/admin')),
			array('label'=>'Manage Schedules', 'url'=>array('/doctorSchedule/admin')),
			array('label'=>'Manage Billing', 'url'=>array('/billing/admin')),
			array('label'=>'Manage Specializations', 'url'=>array('/specialization/admin')),
		);
	}
	else if ($this->isAdmin())
	{
		$sidebarMenu = array(
			array('label'=>'📋 Admin Menu', 'itemOptions'=>array('class'=>'sidebar-header')),
			array('label'=>'Dashboard (Patient Queue)', 'url'=>array('/site/index')),
			array('label'=>'Appointment Calendar', 'url'=>array('/appointment/calendar')), // Needs new action
			array('label'=>'Manage Patients', 'url'=>array('/user/admin', 'role'=>'patient')), // Needs customization
			array('label'=>'View Doctors', 'url'=>array('/user/admin', 'role'=>'doctor', 'viewOnly'=>true)), // Needs customization
			array('label'=>'My Account', 'url'=>array('/account/update', 'id'=>Yii::app()->user->id)),
		);
	}
	else if ($this->isDoctor())
	{
		$sidebarMenu = array(
			array('label'=>'🧑‍⚕️ Doctor Menu', 'itemOptions'=>array('class'=>'sidebar-header')),
			array('label'=>'Dashboard (My Queue)', 'url'=>array('/site/index')),
			array('label'=>'My Schedule', 'url'=>array('/doctorSchedule/mySchedule')), // Needs new action
			array('label'=>'Patient List', 'url'=>array('/user/admin', 'role'=>'patient')), // Needs customization
		);
	}
	else if ($this->isPatient())
	{
		$sidebarMenu = array(
			array('label'=>'👤 Patient Menu', 'itemOptions'=>array('class'=>'sidebar-header')),
			array('label'=>'Dashboard', 'url'=>array('/site/index')),
			array('label'=>'Book Appointment', 'url'=>array('/appointment/book')), // Needs new action
			array('label'=>'My Appointments', 'url'=>array('/appointment/myAppointments')), // Needs new action
			array('label'=>'My Prescriptions', 'url'=>array('/prescription/myPrescriptions')), // Needs new action
			array('label'=>'My Profile', 'url'=>array('/user/myProfile')), // Needs new action
		);
	}
	
	// --- END DYNAMIC SIDEBAR LOGIC ---
	?>
	
	<?php if (!empty($sidebarMenu)): // If we have a sidebar menu, use column 2 layout ?>
		<div class="span-19">
			<div id="content">
				<?php echo $content; ?>
			</div></div>
		<div class="span-5 last">
			<div id="sidebar">
			<?php
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$sidebarMenu,
					'htmlOptions'=>array('class'=>'operations'),
				));
			?>
			</div></div>
	<?php else: // Otherwise, use column 1 layout (e.g., for Guest homepage, Login page) ?>
		<div id="content">
			<?php echo $content; ?>
		</div><?php endif; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by QualiLife.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div></div></body>
</html>