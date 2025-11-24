<?php
/* @var $this UserController */
/* @var $model User */

// Determine the title based on the role
$pageHeader = 'Manage Users';
$cardTitle = 'Active User List';
if (isset($_GET['role'])) {
    $pageHeader = 'Manage ' . ucfirst($_GET['role']) . 's';
    $cardTitle = ucfirst($_GET['role']) . ' List';
}

$this->breadcrumbs=array(
    'Users'=>array('index'),
    'Manage',
);

// Menu array is cleared/minimized as the primary actions are now buttons in the main content area.
// Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/your-custom-grid-style.css'); // Link custom styles here if needed

Yii::app()->clientScript->registerScript('search', "
// Toggle Advanced Search Form 
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
// AJAX update for the grid when the global search is used
$('.global-search-form form').submit(function(){
    $('#user-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<div class="container-fluid">
    
    <h1 class="h3 mb-2 text-gray-800"><?php echo $pageHeader; ?></h1>

    <div class="card shadow mb-4">
        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $cardTitle; ?></h6>
            
            <div class="d-flex align-items-center">
                
                <?php echo CHtml::link('<i class="fas fa-plus"></i> Create New User', 
                    array('create'), 
                    array('class'=>'btn btn-primary btn-sm mr-3')); // Added mr-3 for spacing
                ?>
                
                <div class="global-search-form">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'action' => Yii::app()->createUrl($this->route),
                        'method' => 'get',
                        'htmlOptions' => array('class' => 'form-inline'),
                    )); ?>
                    <div class="input-group">
                        <?php 
                        // NOTE: Assumes 'globalSearch' property exists on User model for global searching
                        echo $form->textField($model, 'globalSearch', array(
                            'class' => 'form-control bg-light border-0 small',
                            'placeholder' => 'Search users...',
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

        <div class="card-body">

            <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
            <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
            </div>
            
            <div class="table-responsive">
                
                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'user-grid',
                    'dataProvider'=>$model->search(),
                    // Set filter to null to remove the inline filter row (matching the Doctor Schedule UI)
                    'filter'=>null, 
                    
                    // Apply Bootstrap styling classes
                    'itemsCssClass'=>'table table-bordered table-hover', 
                    'pagerCssClass'=>'dataTables_paginate paging_simple_numbers', 
                    'summaryCssClass'=>'dataTables_info', 

                    'columns'=>array(
                        array(
                            'header' => 'ID',
                            'value' => '$data->id',
                            'htmlOptions' => array('style' => 'width: 40px;'),
                        ),
                        // The original columns are kept, but the filtering must be handled in the model's search()
                        'firstname',
                        'lastname',
                        'dob',
                        'gender',
                        // Custom Actions Column (Dropdown)
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
                                            Yii::app()->createUrl("user/view", array("id"=>$data->id)), 
                                            array("class"=>"dropdown-item")
                                        ).
                                        CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', 
                                            Yii::app()->createUrl("user/update", array("id"=>$data->id)), 
                                            array("class"=>"dropdown-item")
                                        ).
                                        \'<div class="dropdown-divider"></div>\'.
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