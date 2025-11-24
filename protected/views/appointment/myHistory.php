<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Appointments' => array('index'),
    'My History',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Appointment Records</h1>
    <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to Dashboard', array('site/index'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-info">
        <h6 class="m-0 font-weight-bold text-info">All Assigned Appointments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'doctor-history-grid',
                'dataProvider' => $dataProvider,
                'itemsCssClass' => 'table table-bordered table-hover',
                'summaryText' => '',

                'columns' => array(
                    // 1. Date
                    array(
                        'header' => 'Date & Time',
                        'value' => 'date("M j, Y - g:i A", strtotime($data->schedule_datetime))',
                        'htmlOptions' => array('width' => '20%'),
                    ),

                    // 2. Patient Name
                    array(
                        'header' => 'Patient Name',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $name = isset($data->patientAccount->user) ? $data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname : "Unknown";
                            return '<span class="font-weight-bold text-gray-800">' . $name . '</span>';
                        },
                        'htmlOptions' => array('width' => '20%'),
                    ),

                    // 3. Status (NEW: Must be visible to see non-completed ones)
                    array(
                        'header' => 'Status',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $s = $data->appointment_status_id;
                            $label = isset($data->appointmentStatus) ? $data->appointmentStatus->status_name : "Unknown";

                            $badge = 'badge-secondary';
                            if ($s == 1) $badge = 'badge-primary';   // Scheduled
                            if ($s == 4) $badge = 'badge-success';   // Completed
                            if ($s < 4 && $s > 1) $badge = 'badge-warning'; // In Progress

                            return '<span class="badge ' . $badge . ' p-2">' . $label . '</span>';
                        },
                        'htmlOptions' => array('width' => '15%', 'style' => 'text-align:center;'),
                    ),

                    // 4. Diagnosis (Assessment)
                    array(
                        'header' => 'Diagnosis',
                        'type' => 'raw', // <-- FIX: Ensures HTML is rendered, not escaped
                        'value' => function ($data) {
                            if (!empty($data->consultationRecords) && isset($data->consultationRecords[0])) {
                                $text = $data->consultationRecords[0]->assessment;
                                // Return assessment, truncated if too long
                                return (strlen($text) > 80) ? CHtml::encode(substr($text, 0, 80)) . '...' : CHtml::encode($text);
                            }
                            // Clean placeholder text (will now render as HTML)
                            return "<span class='text-muted font-italic'>— Record Not Yet Created —</span>";
                        },
                        'htmlOptions' => array('width' => '30%'),
                    ),

                    // 5. Action Button
                    array(
                        'header' => 'Record',
                        'type' => 'raw',
                        'value' => function ($data) {
                            // If completed, show View SOAP
                            if ($data->appointment_status_id == 4 && !empty($data->consultationRecords)) {
                                $soapId = $data->consultationRecords[0]->id;
                                return CHtml::link(
                                    '<i class="fas fa-file-medical mr-1"></i> View SOAP',
                                    array('consultationRecord/view', 'id' => $soapId),
                                    array('class' => 'btn btn-sm btn-success shadow-sm')
                                );
                            }
                            // If not completed (e.g. Scheduled, Arrived, or In Consultation)
                            if ($data->appointment_status_id < 4) {
                                return CHtml::link(
                                    '<i class="fas fa-calendar-alt mr-1"></i> View Appt',
                                    array('view', 'id' => $data->id),
                                    array('class' => 'btn btn-sm btn-info shadow-sm')
                                );
                            }
                            return '-';
                        },
                        'htmlOptions' => array('style' => 'width:15%; text-align:center;'),
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>