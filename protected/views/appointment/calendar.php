<?php
/* @var $this AppointmentController */

$this->breadcrumbs = array(
	'Appointments' => array('index'),
	'Calendar',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Appointment Calendar</h1>
	<div>
		<?php echo CHtml::link('<i class="fas fa-plus"></i> Book Appointment', array('book'), array('class' => 'btn btn-sm btn-primary shadow-sm')); ?>
	</div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 border-left-primary">
		<h6 class="m-0 font-weight-bold text-primary">Schedule Overview</h6>
	</div>
	<div class="card-body p-0">
		<div id="calendar" style="min-height: 700px;"></div>

	</div>
</div>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			themeSystem: 'bootstrap', // Attempt bootstrap styling
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,listWeek' // Changed 'timeGridDay' to 'listWeek' for better utility
			},
			height: 'auto', // Let it expand naturally
			contentHeight: 700,
			navLinks: true, // Click day numbers to switch views
			editable: false, // Read-only for safety
			dayMaxEvents: true, // Allow "more" link when too many events

			events: {
				url: '<?php echo $this->createUrl("appointment/calendarEvents"); ?>',
				failure: function() {
					alert('there was an error while fetching events!');
				}
			},

			// Tooltip on Hover
			eventMouseEnter: function(info) {
				var props = info.event.extendedProps;
				var content = 'Patient: ' + props.patientName + '\nStatus: ' + props.status;
				info.el.setAttribute('title', content);
				// Optional: Change cursor
				info.el.style.cursor = 'pointer';
			},

			// Click Event
			eventClick: function(info) {
				if (info.event.url) {
					// Allow default behavior (follow link)
					return;
				}
			}
		});

		calendar.render();
	});
</script>

<style>
	/* Container Padding override */
	.fc {
		padding: 20px;
	}

	/* Header Buttons (Green) */
	.fc-button-primary {
		background-color: #02700d !important;
		border-color: #02700d !important;
	}

	.fc-button-primary:hover {
		background-color: #025d0b !important;
		border-color: #025d0b !important;
	}

	.fc-button-primary:disabled {
		background-color: #02700d !important;
		opacity: 0.6;
	}

	/* Today Button (Gold/Secondary) */
	.fc-today-button {
		background-color: #d0be02 !important;
		border-color: #d0be02 !important;
		color: #fff !important;
		font-weight: bold;
	}

	/* Title Styling */
	.fc-toolbar-title {
		font-size: 1.5rem !important;
		color: #5a5c69;
	}

	/* Day Headers */
	.fc-col-header-cell {
		background-color: #f8f9fc;
		padding: 10px 0 !important;
		color: #4e73df;
		/* Bootstrap Blue text */
	}

	/* Events */
	.fc-event {
		border: none;
		border-radius: 3px;
		padding: 2px 4px;
		font-size: 0.85rem;
	}
</style>