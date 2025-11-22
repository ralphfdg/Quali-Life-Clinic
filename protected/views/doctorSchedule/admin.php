<?php
/* @var $this DoctorScheduleController */
/* @var $model DoctorSchedule */

$this->breadcrumbs=array(
    'Doctor Schedules'=>array('index'),
    'Manage',
);

// We keep the menu array minimal for the default breadcrumb setup,
// but the key action buttons are moved into the card header below.


Yii::app()->clientScript->registerScript('search', "
// Toggle advanced search form (kept for legacy support, but hidden)
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
// AJAX update for the grid when the global search is used
$('.global-search-form form').submit(function(){
    $('#doctor-schedule-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<!-- SB Admin 2 Container -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Doctor Availability Schedule</h1>

    <!-- Card Wrapper for the Grid -->
    <div class="card shadow mb-4">
        
        <!-- Card Header: Contains the Title, Create Button, and Global Search -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Active Doctor Schedules</h6>
            
            <!-- Group for Action Buttons and Search (Aligned Right) -->
            <div class="d-flex align-items-center">
                
                <!-- NEW LOCATION for Create Button -->
                <?php echo CHtml::link('<i class="fas fa-plus"></i> Create New Schedule', 
                    array('create'), 
                    array('class'=>'btn btn-primary btn-sm mr-3')); // Added mr-3 for spacing
                ?>
                
                <!-- Global Search Bar -->
                <div class="global-search-form">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'action' => Yii::app()->createUrl($this->route),
                        'method' => 'get',
                        'htmlOptions' => array('class' => 'form-inline'),
                    )); ?>
                    <div class="input-group">
                        <?php 
                        // Assuming $model->globalSearch exists and is declared in the model
                        echo $form->textField($model, 'globalSearch', array(
                            'class' => 'form-control bg-light border-0 small',
                            'placeholder' => 'Search schedules...',
                        )); ?>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
                
            </div>
        </div>

        <!-- Card Body contains the grid -->
        <div class="card-body">

            <!-- Hidden Advanced Search Form -->
            <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
            </div>
            
            <div class="table-responsive">
                
                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'doctor-schedule-grid',
                    'dataProvider'=>$model->search(),
                    'filter'=>null, // Remove individual column filters
                    
                    'itemsCssClass'=>'table table-bordered table-hover', 
                    'pagerCssClass'=>'dataTables_paginate paging_simple_numbers', 
                    'summaryCssClass'=>'dataTables_info', 

                    'columns'=>array(
                        array(
                            'header' => 'ID',
                            'value' => '$data->id',
                            'htmlOptions' => array('style' => 'width: 40px;'),
                        ),
                        array(
                            'name'=>'doctor_account_id',
                            'header'=>'Doctor',
                            'value'=>'$data->doctorAccount->username', 
                        ),
                        array(
                            'name'=>'day_of_week',
                            'header'=>'Day',
                            'value' => 'CHtml::encode($data->day_of_week)', 
                        ),
                        'start_time',
                        'end_time',
                        array(
                            'name'=>'status_id',
                            'header'=>'Status',
                            'value'=>'$data->status->status', 
                            'htmlOptions' => array('style' => 'font-weight: bold;'),
                        ),
                        // Dropdown Actions Column (View, Edit, Delete)
                        array(
                            'header' => 'Actions',
                            'type' => 'raw',
                            'value' => '
                                \'<div class="dropdown no-arrow">\'.
                                    \'<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton\'.$data->id.\'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\'.
                                        \'Actions\'.
                                    \'</button>\'.
                                    \'<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuButton\'.$data->id.\'">\'.
                                        CHtml::link(\'<i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> View\', 
                                            Yii::app()->createUrl("doctorSchedule/view", array("id"=>$data->id)), 
                                            array("class"=>"dropdown-item")
                                        ).
                                        CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', 
                                            Yii::app()->createUrl("doctorSchedule/update", array("id"=>$data->id)), 
                                            array("class"=>"dropdown-item")
                                        ).
                                        \'<div class="dropdown-divider"></div>\'.
                                        CHtml::link(\'<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Delete\', 
                                            Yii::app()->createUrl("doctorSchedule/delete", array("id"=>$data->id)), 
                                            array(
                                                "class"=>"dropdown-item text-danger",
                                                "submit"=>array("delete","id"=>$data->id),
                                                "confirm"=>"Are you sure you want to delete this item?",
                                                "csrf"=>true
                                            )
                                        ).
                                    \'</div>\'.
                                \'</div>\'
                            ',
                            'htmlOptions' => array('style' => 'width: 100px; text-align: left;'),
                        ),
                    ),
                )); ?>
            
            </div>
        </div>
    </div>
</div>