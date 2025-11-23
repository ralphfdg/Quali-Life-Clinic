<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */
/* @var $countTotal integer */
/* @var $countWaiting integer */

$this->pageTitle = Yii::app()->name . ' - Patient Queue';
$today = date('F j, Y'); // e.g. November 24, 2025
?>

<div class="row mb-4">
    <div class="col-md-8">
        <h1 class="h3 mb-0 text-gray-800">Patient Queue <small class="text-muted h6 ml-2"><?php echo $today; ?></small></h1>
    </div>
    <div class="col-md-4 text-right">
        <a href="<?php echo $this->createUrl('appointment/calendar'); ?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-calendar-plus fa-sm text-white-50 mr-1"></i> Appointment Calendar
        </a>
    </div>
</div>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Today</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countTotal; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Waiting Room</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countWaiting; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Today's Schedule</h6>
        <span class="small text-muted"><i class="fas fa-sync fa-spin mr-1"></i> Live updating...</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'queue-grid',
                'dataProvider'=>$dataProvider,
                'itemsCssClass'=>'table table-hover', // Clean bootstrap table
                'summaryText'=>'', // Hide "Displaying 1-10 of..."
                'emptyText'=>'<div class="text-center p-4 text-muted">No appointments scheduled for today.</div>',
                'columns'=>array(
                    
                    // Time Column
                    array(
                        'header'=>'Time',
                        'value'=>'date("g:i A", strtotime($data->schedule_datetime))',
                        'htmlOptions'=>array('style'=>'font-weight:bold; width:15%; color:#4e73df;'),
                    ),

                    // Patient Name & Details
                    array(
                        'header'=>'Patient',
                        'type'=>'raw',
                        'value'=>function($data) {
                            $name = isset($data->patientAccount->user) 
                                ? $data->patientAccount->user->firstname . ' ' . $data->patientAccount->user->lastname 
                                : "Unknown";
                            $phone = isset($data->patientAccount->user) 
                                ? $data->patientAccount->user->mobile_number 
                                : "";
                            
                            return '<div>'.$name.'</div><div class="small text-muted"><i class="fas fa-phone fa-xs"></i> '.$phone.'</div>';
                        },
                    ),

                    // Doctor
                    array(
                        'header'=>'Doctor',
                        'value'=>'isset($data->doctorAccount->user) ? "Dr. ".$data->doctorAccount->user->lastname : "-"',
                    ),

                    // Status with Badges
                    array(
                        'header'=>'Status',
                        'type'=>'raw',
                        'value'=>function($data) {
                            $status = $data->appointment_status_id;
                            $label = isset($data->appointmentStatus) ? $data->appointmentStatus->status_name : "Unknown";
                            
                            // Color Logic
                            $badge = 'badge-secondary';
                            if($status == 1) $badge = 'badge-primary'; // Scheduled
                            if($status == 2) $badge = 'badge-success'; // Arrived
                            if($status == 3) $badge = 'badge-warning'; // In Consultation
                            if($status == 4) $badge = 'badge-dark';    // Completed
                            
                            return '<span class="badge '.$badge.' p-2" style="font-size:0.85rem;">'.$label.'</span>';
                        },
                        'htmlOptions'=>array('style'=>'text-align:center;'),
                    ),

                    // Action Buttons (Check In / Cancel)
                    array(
                        'header'=>'Actions',
                        'type'=>'raw',
                        'value'=>function($data) {
                            // Check In Button (Only if Scheduled)
                            if($data->appointment_status_id == 1) {
                                return CHtml::link('<i class="fas fa-check mr-1"></i> Check In', 
                                    array('appointment/updateStatus', 'id'=>$data->id, 'status'=>2), 
                                    array('class'=>'btn btn-sm btn-success shadow-sm')
                                );
                            }
                            // Cancel Button (If not Completed/Canceled)
                            if($data->appointment_status_id < 3) {
                                return CHtml::link('<i class="fas fa-times"></i>', 
                                    array('appointment/cancel', 'id'=>$data->id), 
                                    array(
                                        'class'=>'btn btn-sm btn-outline-danger ml-1', 
                                        'title'=>'Cancel Appointment',
                                        'confirm'=>'Are you sure you want to cancel this appointment?'
                                    )
                                );
                            }
                            return '<span class="text-muted small">-</span>';
                        },
                        'htmlOptions'=>array('style'=>'text-align:center; width: 20%;'),
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>

<script>
    setTimeout(function(){
        window.location.reload(1);
    }, 60000);
</script>