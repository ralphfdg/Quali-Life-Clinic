<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name . ' - Welcome';
?>

<div class="row justify-content-center mt-5 mb-5">
	<div class="col-lg-8 text-center">
		<div class="mb-4">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png"
				alt="Quali-Life logo"
				class="img-fluid"
				style="width: 150px; height: auto;">
		</div>

		<h1 class="display-4 text-gray-900 mb-3">Welcome to Quali-Life Medical and Lying Clinic</h1>

		<p class="lead text-gray-600 mb-5">
			Your trusted partner in health. We provide quality healthcare with a personal touch.<br>
			Book appointments, view records, and manage your health online.
		</p>

		<?php echo CHtml::link(
			'<i class="fas fa-sign-in-alt mr-2"></i> Login to Book Appointment',
			array('site/login'),
			array('class' => 'btn btn-primary btn-lg shadow-sm px-5 py-3', 'style' => 'border-radius: 50px;')
		); ?>
	</div>
</div>

<hr class="mb-5">

<div class="row">

	<div class="col-md-4 mb-4">
		<div class="card shadow h-100 py-2 border-left-primary">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							Visit Us
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">11930, Ubas St</div>
						<p class="text-muted small mt-1 mb-0">Mabalacat City, Pampanga</p>
					</div>
					<div class="col-auto">
						<i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 mb-4">
		<div class="card shadow h-100 py-2 border-left-success">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Call Us
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">0923 940 6809</div>
						<p class="text-muted small mt-1 mb-0">Mon-Sat: 8:00 AM - 5:00 PM</p>
					</div>
					<div class="col-auto">
						<i class="fas fa-phone fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 mb-4">
		<div class="card shadow h-100 py-2 border-left-info">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
							Services
						</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">Specialist Care</div>
						<p class="text-muted small mt-1 mb-0">Pediatrics, Cardiology, & more.</p>
					</div>
					<div class="col-auto">
						<i class="fas fa-user-md fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>