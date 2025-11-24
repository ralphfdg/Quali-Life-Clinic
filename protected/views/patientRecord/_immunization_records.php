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
            'itemsCssClass' => 'table table-bordered table-hover',
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
                // START: NEW ACTIONS COLUMN (Dropdown)
                array(
                    'header' => 'Actions',
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width: 60px; text-align: center; overflow:visible;'),
                    'value' => '
                        \'<div class="dropdown no-arrow">\'.
                        \'<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\'.
                            \'<i class="fas fa-cog"></i>\'.
                        \'</button>\'.
                        \'<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">\'.
                            CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', Yii::app()->createUrl("/immunizationRecord/update", array("id"=>$data->id)), array("class"=>"dropdown-item")).
                        \'</div>\'.
                        \'</div>\'
                    ',
                ),
                // END: NEW ACTIONS COLUMN
            ),
        )); ?>
    </div>
</div>