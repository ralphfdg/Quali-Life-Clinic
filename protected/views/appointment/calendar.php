<?php
/* @var $this AppointmentController */

$this->breadcrumbs=array(
	'Appointments'=>array('index'),
	'Calendar',
);

$this->menu=array(
	array('label'=>'List Appointments', 'url'=>array('index')),
	array('label'=>'Create Appointment', 'url'=>array('create')),
	array('label'=>'Manage Appointments', 'url'=>array('admin')),
);
?>

<h1>Appointment Calendar</h1>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

<div id="calendar" style="margin-top: 20px;"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');

	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay'
		},
		height: 650,
		events: '<?php echo $this->createUrl("appointment/calendarEvents"); ?>', // Fetch JSON data
		
		// When hovering over an event
		eventMouseEnter: function(info) {
			var props = info.event.extendedProps;
			var content = 'Status: ' + props.status + '\nPatient: ' + props.patientName;
			info.el.setAttribute('title', content);
		},
		
		// When clicking an event (optional override, otherwise it follows the URL)
		eventClick: function(info) {
			// You can prevent default and open a modal here if you want
			// info.jsEvent.preventDefault(); 
		}
	});

	calendar.render();
});
</script>

<style>
	/* Fix for buttons in some Yii themes */
	.fc-button {
		background-image: none;
	}
</style>