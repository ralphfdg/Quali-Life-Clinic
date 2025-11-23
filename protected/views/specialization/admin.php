<?php
/* @var $this SpecializationController */
/* @var $model Specialization */

// Breadcrumbs - as seen in the image, simplified for the breadcrumb bar
$this->breadcrumbs=array(
    'Home', // Assuming 'Home' is the base for breadcrumbs
    'Specializations', // Changed from 'Doctor Schedules' for context
    'Manage',
);

// We'll integrate the menu items into the panel-heading for the "Create" button

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#specialization-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="h3 mb-2 text-gray-800">Manage Specializations</h1>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-tags"></i> Active Specializations</h6>
                    
                    <div class="d-flex align-items-center">
                        
                        <?php echo CHtml::link('<i class="fas fa-plus"></i> Create New Specialization', 
                            array('create'), 
                            array('class'=>'btn btn-primary btn-sm mr-3')); 
                        ?>
                        
                        <div class="input-group" style="width: 250px; display: inline-flex; vertical-align: middle;">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search specializations..." id="search-input">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="search-button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <p class="text-muted">Displaying <?php echo $model->search()->getItemCount(); ?> results.</p>
                    
                    <div class="table-responsive">
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'specialization-grid',
                        'dataProvider'=>$model->search(),
                        'filter'=>$model,
                        'itemsCssClass' => 'table table-hover', 
                        'template'=>"{items}\n<div class='text-center'>{pager}</div>", 
                        'enableSorting' => true, 
                        'cssFile' => false, 
                        
                        'pagerCssClass'=>'dataTables_paginate paging_simple_numbers',
                        'pager' => array(
                            'class'=>'CLinkPager',
                            'header' => '',
                            'htmlOptions'=>array('class'=>'pagination'),
                            'selectedPageCssClass'=>'active',
                            'hiddenPageCssClass'=>'disabled',
                            'nextPageLabel' => 'Next &raquo;',
                            'prevPageLabel' => '&laquo; Previous',
                        ),
                        'summaryText' => '', 
                        'filterCssClass' => 'filter-container',
                        
                        'columns'=>array(
                            array(
                                'header' => 'ID',
                                'value' => '$data->id',
                                'htmlOptions' => array('style' => 'width: 40px;'),
                            ),
                            'specialization_name',
                            array(
                                'name'=>'status_id',
                                'header'=>'Status',
                                'value'=>'$data->status_id == 1 ? "active" : "inactive"', 
                                'filter'=>array(1=>'Active', 0=>'Inactive'),
                                'htmlOptions' => array('style' => 'font-weight: bold;'),
                            ),
                            // *** DROPDOWN ACTIONS COLUMN (Copied from Doctor Schedule code) ***
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
                                                Yii::app()->createUrl("specialization/view", array("id"=>$data->id)), 
                                                array("class"=>"dropdown-item")
                                            ).
                                            CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', 
                                                Yii::app()->createUrl("specialization/update", array("id"=>$data->id)), 
                                                array("class"=>"dropdown-item")
                                            ).
                                            \'<div class="dropdown-divider"></div>\'.
                                            CHtml::link(\'<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Delete\', 
                                                Yii::app()->createUrl("specialization/delete", array("id"=>$data->id)), 
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
                            // *** END DROPDOWN ACTIONS COLUMN ***
                        ),
                    )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Yii::app()->clientScript->registerScript('custom-search', "
// This script now handles the search input in the header
$('#search-button').click(function(){
    $('#specialization-grid').yiiGridView('update', {
        data: { 'Specialization[specialization_name]': $('#search-input').val() } // Assumes filtering by name
    });
    return false;
});
// Optional: Trigger search on 'Enter' key press
$('#search-input').keypress(function(e){
    if(e.which == 13){
        $('#search-button').click();
    }
});
"); ?>