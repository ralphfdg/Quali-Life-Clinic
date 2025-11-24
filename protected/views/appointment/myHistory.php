<?php
/* @var $this AppointmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Appointments' => array('index'),
    'My History',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Consultation History</h1>
    <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back to Dashboard', array('site/index'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-success">
        <h6 class="m-0 font-weight-bold text-success">Completed Appointments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'doctor-history-grid',
                'dataProvider' => $dataProvider,
                'itemsCssClass' => 'table table-bordered table-hover',
                'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
                'summaryText' => '',

                'columns' => array(
                    // 1. Date
                    array(
                        'header' => 'Date Completed',
                        'value' => 'date("M j, Y - g:i A", strtotime($data->schedule_datetime))',
                        'htmlOptions' => array('width' => '20%'),
                    ),

                    // 2. Patient Name
                    array(
                        'header' => 'Patient Name',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $name = isset($data->patientAccount->user) ? $data->patientAccount->user->firstname . " " . $data->patientAccount->user->lastname : "Unknown";
                            return '<span class="font-weight-bold text-gray-800">' . $name . '</span>';
                        },
                    ),

                    // 3. Diagnosis (Assessment)
                    array(
                        'header' => 'Diagnosis',
                        'value' => function ($data) {
                            if (!empty($data->consultationRecords)) {
                                // Return assessment truncated if too long
                                $text = $data->consultationRecords[0]->assessment;
                                return (strlen($text) > 50) ? substr($text, 0, 50) . '...' : $text;
                            }
                            return "-";
                        },
                        'htmlOptions' => array('class' => 'text-muted font-italic'),
                    ),

                    // 4. Action Button
                    array(
                        'header' => 'Record',
                        'type' => 'raw',
                        'value' => function ($data) {
                            if (!empty($data->consultationRecords)) {
                                $soapId = $data->consultationRecords[0]->id;
                                return CHtml::link(
                                    '<i class="fas fa-file-medical mr-1"></i> View SOAP',
                                    array('consultationRecord/view', 'id' => $soapId),
                                    array('class' => 'btn btn-sm btn-info shadow-sm')
                                );
                            }
                            return "<span class='badge badge-secondary'>Missing Record</span>";
                        },
                        'htmlOptions' => array('style' => 'text-align:center; width:15%;'),
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>