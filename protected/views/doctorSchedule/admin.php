<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs = array(
    'Doctor Schedules' => array('index'),
    'Manage',
);

// Helper array for Days
$days = array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Schedules</h1>
    <?php echo CHtml::link('<i class="fas fa-plus"></i> Add Schedule', array('create'), array('class' => 'btn btn-sm btn-primary shadow-sm')); ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-primary">
        <h6 class="m-0 font-weight-bold text-primary">Clinic Hours Configuration</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'doctor-schedule-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,

                // Bootstrap Styling
                'itemsCssClass' => 'table table-bordered table-hover',
                'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
                'summaryCssClass' => 'dataTables_info',
                'filterCssClass' => 'filter-class',

                'columns' => array(

                    // 1. Doctor Name
                    array(
                        'name' => 'doctor_account_id',
                        'header' => 'Doctor',
                        'value' => 'isset($data->doctorAccount->user) ? "Dr. " . $data->doctorAccount->user->lastname : "Unknown"',
                        'filter' => CHtml::listData(Account::model()->with('user')->findAll('account_type_id=3'), 'id', 'user.lastname'),
                    ),

                    // 2. Day of Week
                    array(
                        'name' => 'day_of_week',
                        'value' => function ($data) {
                            $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                            return isset($days[$data->day_of_week]) ? $days[$data->day_of_week] : '-';
                        },
                        'filter' => array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'),
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 3. Start Time
                    array(
                        'name' => 'start_time',
                        'value' => 'date("g:i A", strtotime($data->start_time))',
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 4. End Time
                    array(
                        'name' => 'end_time',
                        'value' => 'date("g:i A", strtotime($data->end_time))',
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 5. Status
                    array(
                        'name' => 'status_id',
                        'type' => 'raw',
                        'value' => '($data->status_id == 1) 
                            ? "<span class=\"badge badge-success\">Active</span>" 
                            : "<span class=\"badge badge-danger\">Inactive</span>"',
                        'filter' => array(1 => 'Active', 2 => 'Inactive'),
                        'htmlOptions' => array('style' => 'text-align:center; width:10%;'),
                    ),

                    // 6. ACTIONS (Consistent Dropdown)
                    array(
                        'header' => 'Actions',
                        'type' => 'raw',
                        'htmlOptions' => array('style' => 'width: 80px; text-align: center; overflow:visible;'),
                        'value' => '
                            \'<div class="dropdown no-arrow">\'.
                                \'<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton\'.$data->id.\'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\'.
                                    \'<i class="fas fa-cog"></i>\'.
                                \'</button>\'.
                                \'<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuButton\'.$data->id.\'">\'.
                                    // Edit
                                    CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', 
                                        Yii::app()->createUrl("doctorSchedule/update", array("id"=>$data->id)), 
                                        array("class"=>"dropdown-item")
                                    ).
                                    // Divider
                                    \'<div class="dropdown-divider"></div>\'.
                                \'</div>\'.
                            \'</div>\'
                        ',
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>