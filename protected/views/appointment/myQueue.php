<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Appointments'=>array('index'),
    'My Queue',
);

// Refresh page every 60 seconds to check for new bookings
Yii::app()->clientScript->registerMetaTag('60', null, 'refresh');
?>

<h1>Doctor's Queue - <?php echo date('F j, Y'); ?></h1>

<div class="queue-container">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'doctor-queue-grid',
    'dataProvider'=>$dataProvider,
    'itemsCssClass'=>'table table-bordered table-striped', // Bootstrap classes if you have them
    'columns'=>array(
        
        // Time Column
        array(
            'header'=>'Time',
            'value'=>'date("g:i A", strtotime($data->schedule_datetime))',
            'htmlOptions'=>array('style'=>'width: 100px; font-weight:bold;'),
        ),

        // Patient Name (Using the relation)
        array(
            'header'=>'Patient Name',
            'name'=>'patientAccount.user.lastname',
            'value'=>'$data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname',
        ),

        // Current Status
        array(
            'name'=>'appointment_status_id',
            'header'=>'Status',
            'value'=>'$data->appointmentStatus->status_name',
            'cssClassExpression'=> '
                ($data->appointment_status_id == 2) ? "status-arrived" : 
                (($data->appointment_status_id == 3) ? "status-consult" : "")
            ',
        ),

        // ACTION BUTTONS
        array(
            'header'=>'Actions',
            'type'=>'raw',
            'value'=>function($data) {
                $buttons = "";
                
                // If Scheduled (1) -> Show "Mark Arrived"
                if($data->appointment_status_id == 1) {
                    $buttons .= CHtml::link("Patient Arrived", array("appointment/updateStatus", "id"=>$data->id, "status"=>2), array("class"=>"btn-action btn-green"));
                }

                // If Arrived (2) -> Show "Start Consultation"
                if($data->appointment_status_id == 2) {
                    $buttons .= CHtml::link("Start Consult", array("appointment/updateStatus", "id"=>$data->id, "status"=>3), array("class"=>"btn-action btn-orange"));
                }

                // If In Consultation (3) -> Show "Complete"
                if($data->appointment_status_id == 3) {
                    $buttons .= CHtml::link("Complete", array("appointment/updateStatus", "id"=>$data->id, "status"=>4), array("class"=>"btn-action btn-blue"));
                }

                // Always show "Cancel" unless completed
                if($data->appointment_status_id != 4 && $data->appointment_status_id != 5) {
                     $buttons .= " " . CHtml::link("Cancel", array("appointment/updateStatus", "id"=>$data->id, "status"=>5), array("class"=>"btn-action btn-red", "confirm"=>"Are you sure you want to cancel?"));
                }

                return $buttons;
            },
        ),
    ),
)); ?>
</div>

<style>
    /* Simple CSS to make the Queue look good */
    .btn-action {
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 4px;
        color: white !important;
        font-size: 12px;
        margin-right: 5px;
        display: inline-block;
    }
    .btn-green { background-color: #28a745; } /* Arrived */
    .btn-orange { background-color: #ffc107; color: black !important; } /* Consult */
    .btn-blue { background-color: #007bff; } /* Complete */
    .btn-red { background-color: #dc3545; } /* Cancel */

    /* Highlight rows based on status */
    .status-arrived { background-color: #e6ffea !important; }
    .status-consult { background-color: #fff3cd !important; }
</style>