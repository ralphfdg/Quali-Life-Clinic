<?php
/* @var $dataProvider CActiveDataProvider */
/* @var $patientID integer */
?>

<div class="p-3">

    <div class="table-responsive">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'consultation-record-grid',
            'dataProvider' => $dataProvider,
            'template' => '{items}{pager}',
            'itemsCssClass' => 'table table-bordered table-hover',
            'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
            'summaryCssClass' => 'dataTables_info',
            'columns' => array(
                array(
                    'name' => 'date_of_consultation',
                    'htmlOptions' => array('width' => '15%'),
                ),
                'subjective',
                'assessment',
                'plan',
                // START: NEW ACTIONS COLUMN (Dropdown - View Only)
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
                            // Only include the View link, as requested
                            CHtml::link(\'<i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> View\', Yii::app()->createUrl("/consultationRecord/view", array("id"=>$data->id)), array("class"=>"dropdown-item")).
                        \'</div>\'.
                        \'</div>\'
                    ',
                ),
                // END: NEW ACTIONS COLUMN
            ),
        )); ?>
    </div>
</div>