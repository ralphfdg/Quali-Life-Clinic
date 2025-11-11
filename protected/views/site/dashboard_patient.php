<?php
/* @var $this SiteController */
/* @var $upcomingAppointment Appointment */

$this->pageTitle=Yii::app()->name . ' - Dashboard';
?>

<h1>My Dashboard</h1>

<hr>
<h3>My Upcoming Appointment</h3>

<?php if ($upcomingAppointment): ?>
	<div style="padding: 20px; border: 1px solid #007bff; border-radius: 8px; background-color: #f8f9fa;">
		<h4>You have an upcoming appointment!</h4>
		<p>
			<strong>Date:</strong> 
			<?php echo date("F j, Y", strtotime($upcomingAppointment->schedule_datetime)); ?>
		</p>
		<p>
			<strong>Time:</strong> 
			<?php echo date("g:i A", strtotime($upcomingAppointment->schedule_datetime)); ?>
		</p>
		<p>
			<strong>Doctor:</strong> 
			Dr. <?php echo CHtml::encode($upcomingAppointment->doctorAccount->user->firstname . " " . $upcomingAppointment->doctorAccount->user->lastname); ?>
		</p>
		<p>
			<?php echo CHtml::link('View All My Appointments', array('/appointment/myAppointments')); ?>
		</p>
	</div>
<?php else: ?>
	<p>You have no upcoming scheduled appointments.</p>
	<p>
		<?php echo CHtml::link('Click here to Book a New Appointment', array('/appointment/book')); ?>
	</p>
<?php endif; ?>