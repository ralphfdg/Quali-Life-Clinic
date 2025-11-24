<?php
/* @var $this ConsultationRecordController */
/* @var $model ConsultationRecord */

$this->breadcrumbs=array(
	'Consultation Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ConsultationRecord', 'url'=>array('index')),
	array('label'=>'Create ConsultationRecord', 'url'=>array('create')),
	array('label'=>'Update ConsultationRecord', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete ConsultationRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConsultationRecord', 'url'=>array('admin')),
);
?>

<h1>View Consultation #<?php echo $model->id; ?></h1>

<div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 8px;">
    <h4 style="margin-top:0; color: #4e73df;">Medical Actions</h4>
    
    <?php 
    // Only show "Write Prescription" if the user is a Doctor
    if(Yii::app()->controller->isDoctor()) {
        echo CHtml::link(
            '<i class="fas fa-prescription"></i> Write Prescription', 
            array('prescription/create', 'consultation_id'=>$model->id), 
            array(
                'class'=>'btn btn-success', 
                'style'=>'padding: 10px 15px; color: white; text-decoration: none; background-color: #28a745; border-radius: 5px; font-weight: bold;'
            )
        ); 
    }
    ?>

    <?php 
    if(Yii::app()->controller->isDoctor()) {
        echo CHtml::link(
            'Back to Queue', 
            array('appointment/myQueue'), 
            array('class'=>'btn btn-secondary', 'style'=>'margin-left: 10px; color: #666; text-decoration: none;')
        );
    }
    ?>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        // Display Patient Name instead of ID
        array(
            'label'=>'Patient',
            'value'=> isset($model->patientAccount->user) ? $model->patientAccount->user->firstname . ' ' . $model->patientAccount->user->lastname : 'Unknown',
        ),
        // Display Doctor Name instead of ID
        array(
            'label'=>'Doctor',
            'value'=> isset($model->doctorAccount->user) ? 'Dr. ' . $model->doctorAccount->user->lastname : 'Unknown',
        ),
		'date_of_consultation',
		'subjective',
		'objective',
		'assessment',
		'plan',
		'notes',
	),
)); ?>

<br>
<h3>Prescriptions Issued</h3>
<?php 
    // Check if there are any prescriptions linked to this consultation
    $prescriptions = Prescription::model()->findAllByAttributes(array('consultation_id'=>$model->id));
    
    if($prescriptions) {
        echo "<ul style='list-style: none; padding: 0;'>";
        foreach($prescriptions as $p) {
            echo "<li style='background: #fff; border: 1px solid #ddd; padding: 10px; margin-bottom: 5px; border-left: 4px solid #28a745;'>";
            echo "<strong>" . date('F j, Y', strtotime($p->date_of_prescription)) . ":</strong> ";
            echo CHtml::link("View Prescription #{$p->id}", array('prescription/view', 'id'=>$p->id));
            echo "<br><small style='color: #666;'>" . substr($p->prescription, 0, 80) . "...</small>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='text-muted'>No prescriptions issued for this visit.</p>";
    }
?>