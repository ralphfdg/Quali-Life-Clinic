<?php
/* @var $dataProvider CActiveDataProvider */
/* @var $patientID integer */
?>

<div class="p-3">
    <?php
    echo CHtml::link(
        '<i class="fas fa-plus-circle"></i> Add New Immunization Record',
        array('/immunizationRecord/create', 'account_id' => $patientID),
        array('class' => 'btn btn-sm btn-success shadow-sm mb-3')
    );
    ?>

    <div class="table-responsive">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'immunization-record-grid',
            'dataProvider' => $dataProvider,
            'template' => '{items}{pager}',
            'itemsCssClass' => 'table table-bordered table-hover', // ADDED STYLING
            'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
            'summaryCssClass' => 'dataTables_info',
            'columns' => array(
                array(
                    'name' => 'immunization_id',
                    'value' => '$data->immunization->immunization',
                    'header' => 'Immunization',
                    'htmlOptions' => array('width' => '30%'),
                ),
                'date',
                'remarks',
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{view}{update}',
                    'viewButtonUrl' => 'Yii::app()->createUrl("/immunizationRecord/view", array("id"=>$data->id))',
                    'updateButtonUrl' => 'Yii::app()->createUrl("/immunizationRecord/update", array("id"=>$data->id))',
                    'buttons' => array(
                        'view' => array('options' => array('class' => 'btn btn-sm btn-info mr-1')),
                        'update' => array('options' => array('class' => 'btn btn-sm btn-warning')),
                    ),
                    'htmlOptions' => array('width' => '100px', 'class' => 'button-column'),
                ),
            ),
        )); ?>
    </div>
</div>