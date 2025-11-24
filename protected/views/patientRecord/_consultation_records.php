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
            'itemsCssClass' => 'table table-bordered table-hover', // ADDED STYLING
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
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{view}{update}',
                    'viewButtonUrl' => 'Yii::app()->createUrl("/consultationRecord/view", array("id"=>$data->id))',
                    'updateButtonUrl' => 'Yii::app()->createUrl("/consultationRecord/update", array("id"=>$data->id))',
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