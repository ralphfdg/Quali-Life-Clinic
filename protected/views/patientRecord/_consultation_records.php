<?php
/* @var $dataProvider CActiveDataProvider */
/* @var $patientID integer */
?>

<div class="p-3">
    <?php echo CHtml::link('<i class="fas fa-plus-circle"></i> Add New Consultation Record', 
        array('/consultationRecord/create', 'patient_account_id' => $patientID), // FIXED: Uses patient_account_id
        array('class' => 'btn btn-sm btn-info mb-3')); 
    ?>
    
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'consultation-record-grid',
        'dataProvider' => $dataProvider,
        'template' => '{items}{pager}',
        'columns' => array(
            'date_of_consultation', // FIXED: Correct column name
            'subjective',           // Showing key SOAP fields
            'assessment',           
            'plan',                 
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{update}',
                'viewButtonUrl' => 'Yii::app()->createUrl("/consultationRecord/view", array("id"=>$data->id))',
                'updateButtonUrl' => 'Yii::app()->createUrl("/consultationRecord/update", array("id"=>$data->id))',
            ),
        ),
    )); ?>
</div>