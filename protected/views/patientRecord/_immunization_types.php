<?php
/* @var $this PatientRecordController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="mb-3 text-right">
    <?php echo CHtml::link('<i class="fas fa-plus"></i> Create New Immunization Type', array('/immunization/create'), array('class' => 'btn btn-sm btn-success', 'target'=>'_blank')); ?>
</div>

<p class="small text-muted mb-2">These are the available vaccine types in the system.</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'immunization-types-grid',
    'dataProvider' => $dataProvider, // This gets $immunizationTypesDataProvider from the parent view
    'itemsCssClass' => 'table table-bordered table-hover',
    'summaryCssClass' => 'dataTables_info',
    'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
    'columns' => array(
        'id',
        array(
            'name' => 'immunization',
            'header' => 'Vaccine Name',
        ),
        array(
            'name' => 'description',
            'header' => 'Description',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Actions',
            'template' => '{view} {update}',
            'viewButtonUrl' => 'Yii::app()->createUrl("/immunization/view", array("id"=>$data->id))',
            'updateButtonUrl' => 'Yii::app()->createUrl("/immunization/update", array("id"=>$data->id))',
            'buttons' => array(
                'view' => array('options' => array('target' => '_blank')),
                'update' => array('options' => array('target' => '_blank')),
            ),
        ),
    ),
)); ?>