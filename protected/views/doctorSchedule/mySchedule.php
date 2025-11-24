<?php
/* @var $this DoctorScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Schedules',
	'My Schedule',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Weekly Schedule</h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-plus"></i> Add New Slot', array('create'), array('class'=>'btn btn-sm btn-primary shadow-sm')); ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-info">
        <h6 class="m-0 font-weight-bold text-info">Current Active Hours</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'my-schedule-grid',
                'dataProvider'=>$dataProvider,
                'itemsCssClass'=>'table table-hover',
                'summaryText'=>'',
                'emptyText'=>'<div class="text-center p-4 text-muted">You have not set any active schedule hours. Click "Add New Slot" to begin.</div>',
                
                'columns'=>array(
                    
                    // 1. Day (FIXED: Using closure for robust scoping)
                    array(
                        'name'=>'day_of_week',
                        'header'=>'Day',
                        'type'=>'raw',
                        'value'=>function($data) {
                            return '<strong class="text-primary">'.$data->getDayName().'</strong>';
                        },
                        'htmlOptions'=>array('width'=>'20%'),
                    ),

                    // 2. Start Time
                    array(
                        'name'=>'start_time',
                        'header'=>'Start Time',
                        'value'=>'date("g:i A", strtotime($data->start_time))',
                        'htmlOptions'=>array('width'=>'20%', 'class'=>'text-gray-900'),
                    ),

                    // 3. End Time
                    array(
                        'name'=>'end_time',
                        'header'=>'End Time',
                        'value'=>'date("g:i A", strtotime($data->end_time))',
                        'htmlOptions'=>array('width'=>'20%', 'class'=>'text-gray-900'),
                    ),

                    // 4. Status
                    array(
                        'name'=>'status_id',
                        'header'=>'Status',
                        'type'=>'raw',
                        'value'=>'($data->status_id == 1) ? "<span class=\"badge badge-success\">Active</span>" : "<span class=\"badge badge-danger\">Inactive</span>"',
                        'htmlOptions'=>array('style'=>'text-align:center; width:15%;'),
                    ),

                    // 5. ACTIONS (Consistent Dropdown - HTML is already safe)
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
                                    CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-warning"></i> Edit Slot\', 
                                        Yii::app()->createUrl("doctorSchedule/update", array("id"=>$data->id)), 
                                        array("class"=>"dropdown-item")
                                    ).
                                    \'<div class="dropdown-divider"></div>\'.
                                    // Delete
                                    CHtml::link(\'<i class="fas fa-trash fa-sm fa-fw mr-2 text-danger"></i> Delete Slot\', 
                                        "#", 
                                        array(
                                            "class"=>"dropdown-item text-danger",
                                            "submit"=>array("delete","id"=>$data->id),
                                            "confirm"=>"Are you sure you want to delete this schedule slot?",
                                            "csrf"=>true
                                        )
                                    ).
                                \'</div>\'.
                            \'</div>\'
                        ',
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>