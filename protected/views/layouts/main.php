<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.min.css" rel="stylesheet">
	
	</head>

<body id="page-top">

	<div id="wrapper">

		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $this->createUrl('/site/index'); ?>">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-user-md"></i>
				</div>
				<div class="sidebar-brand-text mx-3"><?php echo CHtml::encode(Yii::app()->name); ?></div>
			</a>

			<hr class="sidebar-divider my-0">

			<?php
			// --- DYNAMIC SIDEBAR LOGIC ---
			// Re-using your existing logic to define menu items
			$sidebarMenu = array();
			
			if ($this->isSuperAdmin()) {
				$sidebarMenu = array(
					array('label'=>'SUPER ADMIN', 'itemOptions'=>array('class'=>'sidebar-header')),
					array('label'=>'Dashboard', 'url'=>array('/site/index'), 'icon'=>'fa-tachometer-alt'),
					array('label'=>'Manage Doctors', 'url'=>array('/account/admin', 'type'=>3), 'icon'=>'fa-user-md'),
					array('label'=>'Manage Admins', 'url'=>array('/account/admin', 'type'=>2), 'icon'=>'fa-user-shield'),
					array('label'=>'Manage Patients', 'url'=>array('/account/admin', 'type'=>4), 'icon'=>'fa-procedures'),
					array('label'=>'Generate Report', 'url'=>array('/report/index'), 'icon'=>'fa-file-alt'),
					array('label'=>'Audit Log', 'url'=>array('/auditLog/admin'), 'icon'=>'fa-list'),
					
					array('label'=>'DEVELOPMENT', 'itemOptions'=>array('class'=>'sidebar-header')),
					array('label'=>'Accounts', 'url'=>array('/account/admin'), 'icon'=>'fa-users'),
					array('label'=>'Schedules', 'url'=>array('/doctorSchedule/admin'), 'icon'=>'fa-calendar'),
					array('label'=>'Billing', 'url'=>array('/billing/admin'), 'icon'=>'fa-file-invoice-dollar'),
					array('label'=>'Specializations', 'url'=>array('/specialization/admin'), 'icon'=>'fa-stethoscope'),
				);
			} else if ($this->isAdmin()) {
				$sidebarMenu = array(
					array('label'=>'ADMIN', 'itemOptions'=>array('class'=>'sidebar-header')),
					array('label'=>'Dashboard', 'url'=>array('/site/index'), 'icon'=>'fa-tachometer-alt'),
					array('label'=>'Calendar', 'url'=>array('/appointment/calendar'), 'icon'=>'fa-calendar-alt'),
					array('label'=>'Patients', 'url'=>array('/user/admin', 'role'=>'patient'), 'icon'=>'fa-procedures'),
					array('label'=>'Doctors', 'url'=>array('/user/admin', 'role'=>'doctor', 'viewOnly'=>true), 'icon'=>'fa-user-md'),
				);
			} else if ($this->isDoctor()) {
				$sidebarMenu = array(
					array('label'=>'DOCTOR', 'itemOptions'=>array('class'=>'sidebar-header')),
					array('label'=>'Dashboard', 'url'=>array('/site/index'), 'icon'=>'fa-tachometer-alt'),
					array('label'=>'My Schedule', 'url'=>array('/doctorSchedule/mySchedule'), 'icon'=>'fa-clock'),
					array('label'=>'Patients', 'url'=>array('/user/admin', 'role'=>'patient'), 'icon'=>'fa-procedures'),
				);
			} else if ($this->isPatient()) {
				$sidebarMenu = array(
					array('label'=>'PATIENT', 'itemOptions'=>array('class'=>'sidebar-header')),
					array('label'=>'Dashboard', 'url'=>array('/site/index'), 'icon'=>'fa-tachometer-alt'),
					array('label'=>'Book Appt', 'url'=>array('/appointment/book'), 'icon'=>'fa-calendar-plus'),
					array('label'=>'My Appts', 'url'=>array('/appointment/myAppointments'), 'icon'=>'fa-calendar-check'),
					array('label'=>'Prescriptions', 'url'=>array('/prescription/myPrescriptions'), 'icon'=>'fa-pills'),
				);
			}

			// --- RENDER SIDEBAR ITEMS ---
			foreach ($sidebarMenu as $item) {
				// Check if it is a header
				if (isset($item['itemOptions']['class']) && strpos($item['itemOptions']['class'], 'sidebar-header') !== false) {
					echo '<hr class="sidebar-divider">';
					echo '<div class="sidebar-heading">' . CHtml::encode($item['label']) . '</div>';
				} else {
					// Determine active state based on current route
					$isActive = false; // Simplified logic; you can use Yii's normalizeUrl to match strictly
					$url = isset($item['url']) ? CHtml::normalizeUrl($item['url']) : '#';
					$icon = isset($item['icon']) ? $item['icon'] : 'fa-folder'; // Default icon

					echo '<li class="nav-item ' . ($isActive ? 'active' : '') . '">';
					echo '<a class="nav-link" href="' . $url . '">';
					echo '<i class="fas fa-fw ' . $icon . '"></i>';
					echo '<span>' . CHtml::encode($item['label']) . '</span></a>';
					echo '</li>';
				}
			}
			?>

			<hr class="sidebar-divider d-none d-md-block">

			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<div id="content-wrapper" class="d-flex flex-column">

			<div id="content">

				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<ul class="navbar-nav ml-auto">
						
						<?php if (!Yii::app()->user->isGuest): ?>
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">
									<?php echo CHtml::encode(Yii::app()->user->getState('displayName', Yii::app()->user->name)); ?>
								</span>
								<img class="img-profile rounded-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/undraw_profile.svg">
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="<?php echo $this->createUrl('/account/update', array('id'=>Yii::app()->user->id)); ?>">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									My Account
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>
						<?php else: ?>
						<li class="nav-item">
							<a class="nav-link text-gray-600" href="<?php echo $this->createUrl('/site/login'); ?>">Login</a>
						</li>
						<?php endif; ?>

					</ul>

				</nav>
				<div class="container-fluid">
					<?php if(isset($this->breadcrumbs)):?>
						<?php $this->widget('zii.widgets.CBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							'htmlOptions'=>array('class'=>'breadcrumb'),
						)); ?>
					<?php endif?>

					<?php echo $content; ?>

				</div>
				</div>
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; <?php echo date('Y'); ?> by QualiLife. All Rights Reserved.</span>
					</div>
				</div>
			</footer>
			</div>
		</div>
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="<?php echo $this->createUrl('/site/logout'); ?>">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sb-admin-2.min.js"></script>

</body>
</html>