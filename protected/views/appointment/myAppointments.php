<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array('Appointments');

// Determine if the viewer is the Doctor
$isDoctor = Yii::app()->user->isDoctor();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">My Upcoming Appointments</h1>
	<?php if (!$isDoctor): // Only patients need to see the 'Book New' link 
	?>
		<?php echo CHtml::link('<i class="fas fa-plus"></i> Book New', array('book'), array('class' => 'btn btn-sm btn-primary shadow-sm')); ?>
	<?php endif; ?>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-primary">
		<h6 class="m-0 font-weight-bold text-primary">Scheduled Visits (Today or Later)</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'my-appointments-grid',
				'dataProvider' => $dataProvider,
				'itemsCssClass' => 'table table-hover',
				'summaryText' => '',
				'columns' => array(

					// 1. Date & Time
					array(
						'name' => 'schedule_datetime',
						'header' => 'Date & Time',
						'value' => 'date("M j, Y - g:i A", strtotime($data->schedule_datetime))',
						'htmlOptions' => array('style' => 'font-weight:bold; color:#4e73df; width: 20%;'),
					),

					// 2. Dynamic Name Column (Patient for Doctor, Doctor for Patient)
					array(
						'header' => $isDoctor ? 'Patient Name' : 'Doctor Name',
						'value' => function ($data) use ($isDoctor) {
							if ($isDoctor) {
								$user = isset($data->patientAccount->user) ? $data->patientAccount->user : null;
								return $user ? $user->firstname . ' ' . $user->lastname : 'Unknown Patient';
							} else {
								$user = isset($data->doctorAccount->user) ? $data->doctorAccount->user : null;
								return $user ? 'Dr. ' . $user->lastname : 'Unknown Doctor';
							}
						},
						'htmlOptions' => array('width: 25%;'),
					),

					// 3. Status Badge
					array(
						'name' => 'appointment_status_id',
						'header' => 'Status',
						'type' => 'raw',
						'value' => function ($data) {
							// ... (Status badge logic remains the same) ...
							$s = $data->appointment_status_id;
							$label = isset($data->appointmentStatus) ? $data->appointmentStatus->status_name : 'Unknown';
							$badge = 'secondary';
							if ($s == 1) $badge = 'primary';
							if ($s == 2) $badge = 'success';
							if ($s == 3) $badge = 'warning';
							if ($s == 4) $badge = 'dark';
							if ($s == 5) $badge = 'danger';

							return '<span class="badge ' . $badge . ' p-2">' . $label . '</span>';
						},
						'htmlOptions' => array('style' => 'text-align:center; width: 15%;'),
					),

					// 4. Actions
					array(
						'header' => 'Actions',
						'type' => 'raw',
						'value' => function ($data) use ($isDoctor) {
							$btn = CHtml::link(
								'<i class="fas fa-eye"></i>',
								array('view', 'id' => $data->id),
								array('class' => 'btn btn-sm btn-info mr-1', 'title' => 'View Details')
							);

							// Only Patient can cancel
							if (!$isDoctor && $data->appointment_status_id == 1) {
								$btn .= CHtml::link(
									'<i class="fas fa-times"></i> Cancel',
									array('cancel', 'id' => $data->id),
									array(
										'class' => 'btn btn-sm btn-danger ml-1',
										'confirm' => 'Are you sure you want to cancel this appointment?',
										'title' => 'Cancel Appointment'
									)
								);
							}
							return $btn;
						},
						'htmlOptions' => array('style' => 'text-align:center; width: 20%;'),
					),
				),
			)); ?>
		</div>
	</div>
</div>