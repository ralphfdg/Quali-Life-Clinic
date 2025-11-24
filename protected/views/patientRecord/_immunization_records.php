<?php
/* @var $dataProvider CActiveDataProvider */
/* @var $patientID integer */
?>

<div class="p-3">
    <?php echo CHtml::link('<i class="fas fa-plus-circle"></i> Add New Immunization Record', array('/immunizationRecord/create', 'account_id' => $patientID), array('class' => 'btn btn-sm btn-success mb-3')); ?>
    
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'immunization-record-grid',
        'dataProvider' => $dataProvider,
        'template' => '{items}{pager}',
        'columns' => array(
            array(
                'name' => 'immunization_id',
                'value' => '$data->immunization->immunization', // Assuming ImmunizationRecord has relation 'immunization'
                'header' => 'Immunization',
            ),
            'date',
            'remarks',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{update}{delete}',
                'viewButtonUrl' => 'Yii::app()->createUrl("/immunizationRecord/view", array("id"=>$data->id))',
                'updateButtonUrl' => 'Yii::app()->createUrl("/immunizationRecord/update", array("id"=>$data->id))',
                'deleteButtonUrl' => 'Yii::app()->createUrl("/immunizationRecord/delete", array("id"=>$data->id))',
            ),
        ),
    )); ?>
</div>
