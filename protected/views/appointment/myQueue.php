<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Appointments' => array('index'),
    'My Queue',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Patient Queue <small class="text-muted h6 ml-2"><?php echo date('F j, Y'); ?></small></h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-history"></i> View History', array('myHistory'), array('class' => 'btn btn-sm btn-info shadow-sm')); ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-success">
        <h6 class="m-0 font-weight-bold text-success">Today's Patients</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'doctor-queue-grid',
                'dataProvider' => $dataProvider,
                'itemsCssClass' => 'table table-hover', // Standardized Bootstrap styling
                'summaryText' => '', // Hide summary
                'emptyText' => '<div class="text-center p-4 text-muted">No patients scheduled for today.</div>',

                'columns' => array(

                    // 1. Time Column
                    array(
                        'header' => 'Time',
                        'value' => 'date("g:i A", strtotime($data->schedule_datetime))',
                        'htmlOptions' => array('style' => 'font-weight:bold; width:10%; color:#4e73df;'),
                    ),

                    // 2. Patient Name & Details (Name, Age, Gender)
                    array(
                        'header' => 'Patient Name',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $user = isset($data->patientAccount->user) ? $data->patientAccount->user : null;
                            if (!$user) return "Unknown";

                            $name = $user->firstname . ' ' . $user->lastname;
                            $age = date_diff(date_create($user->dob), date_create('today'))->y;

                            return '<div class="font-weight-bold">' . $name . '</div>'
                                . '<div class="small text-muted">' . $age . ' yrs old</div>';
                        },
                        'htmlOptions' => array('width' => '30%'),
                    ),

                    // 3. Current Status (Badges)
                    array(
                        'header' => 'Status',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $s = $data->appointment_status_id;
                            $label = isset($data->appointmentStatus) ? $data->appointmentStatus->status_name : "Unknown";

                            // Color Logic based on IDs
                            if ($s == 1) $badge = 'badge-primary';   // Scheduled
                            if ($s == 2) $badge = 'badge-success';   // Arrived
                            if ($s == 3) $badge = 'badge-warning';   // In Consultation
                            if ($s == 4) $badge = 'badge-dark';      // Completed
                            if ($s == 5) $badge = 'badge-danger';    // Canceled

                            return '<span class="badge ' . $badge . ' p-2">' . $label . '</span>';
                        },
                        'htmlOptions' => array('style' => 'text-align:center; width:15%;'),
                    ),

                    // 4. ACTION BUTTONS (Start Consult / Continue)
                    array(
                        'header' => 'Action',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $isConsulting = $data->appointment_status_id == 3;
                            $isArrived = $data->appointment_status_id == 2;

                            if ($isArrived || $isConsulting) {
                                $buttonClass = $isConsulting ? 'btn-primary' : 'btn-success';
                                $buttonText = $isConsulting ? 'Continue SOAP' : 'Start Consultation';

                                // Link calls updateStatus (sets status=3) -> Controller redirects to SOAP form
                                return CHtml::link(
                                    '<i class="fas fa-stethoscope mr-1"></i> ' . $buttonText,
                                    array('appointment/updateStatus', 'id' => $data->id, 'status' => 3),
                                    array('class' => 'btn btn-sm ' . $buttonClass . ' shadow-sm btn-block')
                                );
                            }

                            // Completed
                            if ($data->appointment_status_id == 4) {
                                return '<button class="btn btn-sm btn-light btn-block text-muted" disabled><i class="fas fa-check"></i> Done</button>';
                            }

                            // Scheduled
                            if ($data->appointment_status_id == 1) {
                                return '<button class="btn btn-sm btn-secondary btn-block" disabled>Not Arrived</button>';
                            }
                            return '-';
                        },
                        'htmlOptions' => array('style' => 'width:25%; text-align:center;'),
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>