<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Appointments'=>array('index'),
    'My History',
);
?>

<h1>Appointment History (Completed)</h1>

<div class="history-container">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'doctor-history-grid',
    'dataProvider'=>$dataProvider,
    'itemsCssClass'=>'table table-bordered table-hover',
    'columns'=>array(
        
        // Date Column
        array(
            'header'=>'Date Completed',
            'value'=>'date("F j, Y - g:i A", strtotime($data->schedule_datetime))',
        ),

        // Patient Name
        array(
            'header'=>'Patient Name',
            'value'=>'$data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname',
        ),

        // Diagnosis Preview (Safe check if record exists)
        array(
            'header'=>'Diagnosis (Assessment)',
            'value'=>function($data) {
                if (!empty($data->consultationRecords)) {
                    // Grab the first record linked to this appointment
                    return $data->consultationRecords[0]->assessment;
                }
                return "No Record";
            },
        ),

        // ACTION BUTTON: View SOAP Note
        array(
            'header'=>'Actions',
            'type'=>'raw',
            'value'=>function($data) {
                // Only show button if a Consultation Record exists
                if (!empty($data->consultationRecords)) {
                    $soapId = $data->consultationRecords[0]->id;
                    
                    return CHtml::link(
                        '<i class="fas fa-file-medical"></i> View Details', 
                        array('consultationRecord/view', 'id'=>$soapId), 
                        array('class'=>'btn btn-sm btn-info', 'style'=>'color:white')
                    );
                }
                return "<span class='text-muted'>No details</span>";
            },
        ),
    ),
)); ?>
</div>