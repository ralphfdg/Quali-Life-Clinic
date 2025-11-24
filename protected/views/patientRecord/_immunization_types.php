<?php
/* @var $this PatientRecordController */
/* @var $dataProvider CActiveDataProvider */
/* @var $patientID integer the ID of the patient account to return to */
?>

<div class="p-3">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h6 class="font-weight-bold text-gray-700">Master List of Vaccines (Global)</h6>
        <?php
        // NOTE: The 'Create' link currently does not need the patient_id unless you want it to return 
        // directly to the patient record after creation, which would require changes to actionCreate 
        // in ImmunizationController. Keeping original logic here.
        echo CHtml::link(
            '<i class="fas fa-plus"></i> Create New Immunization Type',
            // Pass the current page URL as 'returnUrl'
            array('/immunization/create', 'returnUrl' => Yii::app()->request->url),
            array('class' => 'btn btn-sm btn-success shadow-sm')
        );
        ?>
    </div>
    <p class="small text-muted mb-3">These are the available vaccine types in the system. Changes here affect all patient immunization records.</p>

    <div class="table-responsive">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'immunization-types-grid',
            'dataProvider' => $dataProvider,
            // Custom CSS classes are applied below
            'itemsCssClass' => 'table table-bordered table-hover',
            'summaryCssClass' => 'dataTables_info',
            'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
            'columns' => array(
                // Vaccine Name - Display as a link
                array(
                    'name' => 'immunization',
                    'header' => 'Vaccine Name',
                    'type' => 'raw',
                    // MODIFIED: Added 'patient_id' parameter
                    'value' => 'CHtml::link($data->immunization, Yii::app()->createUrl("/immunization/view", array("id"=>$data->id, "patient_id" => ' . $patientID . ')), array("class"=>"font-weight-bold text-primary"))',
                    'htmlOptions' => array('width' => '25%'),
                ),
                'description',
                // Status (Styled using badges for consistency)
                array(
                    'name' => 'status_id',
                    'type' => 'raw',
                    'header' => 'Status',
                    'value' => '($data->status_id == 1) ? "<span class=\"badge badge-success\">Active</span>" : "<span class=\"badge badge-danger\">Inactive</span>"',
                    'htmlOptions' => array('style' => 'text-align:center; width:10%;'),
                ),
                // ACTIONS COLUMN (Dropdown - Fully Custom Styled)
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
                            // View Link MODIFIED: Added "patient_id" parameter
                            CHtml::link(\'<i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> View\', Yii::app()->createUrl("/immunization/view", array("id"=>$data->id, "patient_id" => ' . $patientID . ')), array("class"=>"dropdown-item")).
                            // Edit Link MODIFIED: Added "patient_id" parameter
                            CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', Yii::app()->createUrl("/immunization/update", array("id"=>$data->id, "patient_id" => ' . $patientID . ')), array("class"=>"dropdown-item")).
                        \'</div>\'.
                        \'</div>\'
                    ',
                ),
                // END: ACTIONS COLUMN
            ),
        )); ?>
    </div>
</div>