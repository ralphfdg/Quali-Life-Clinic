<?php
/* @var $this AccountController */
/* @var $model Account */

// Determine Title based on the filter
$typeId = (int)$model->account_type_id;
$title = 'Manage Accounts';
$addLabel = 'Add Account';

if ($typeId == 3) {
    $title = 'Manage Doctors';
    $addLabel = 'Add Doctor';
} elseif ($typeId == 4) {
    $title = 'Manage Patients';
    $addLabel = 'Add Patient';
} elseif ($typeId == 2) {
    $title = 'Manage Secretaries';
    $addLabel = 'Add Secretary';
}

$this->breadcrumbs = array(
    'Accounts' => array('index'),
    'Manage',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    <?php
    if ($typeId > 0) {
        echo CHtml::link('<i class="fas fa-plus"></i> ' . $addLabel, array('create', 'type' => $typeId), array('class' => 'btn btn-sm btn-primary shadow-sm'));
    }
    ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-primary">
        <h6 class="m-0 font-weight-bold text-primary">List of Records</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'account-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,

                // Bootstrap Classes
                'itemsCssClass' => 'table table-bordered table-hover',
                'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
                'summaryCssClass' => 'dataTables_info',
                'filterCssClass' => 'filter-class',

                'columns' => array(
                    // 1. Username
                    array(
                        'name' => 'username',
                        'type' => 'raw',
                        'value' => 'CHtml::link($data->username, array("view", "id"=>$data->id), array("class"=>"font-weight-bold text-primary"))',
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 2. Full Name
                    array(
                        'header' => 'Full Name',
                        'type' => 'text',
                        'value' => 'isset($data->user) ? $data->user->firstname . " " . $data->user->lastname : "No Profile"',
                    ),

                    // 3. Specialization (Visible only for Doctors)
                    array(
                        'header' => 'Specialization',
                        'visible' => ($typeId == 3),
                        'value' => '(isset($data->user) && isset($data->user->specializationInfo)) ? $data->user->specializationInfo->specialization_name : "General"',
                        'htmlOptions' => array('width' => '20%'),
                    ),

                    // 4. Contact
                    array(
                        'header' => 'Contact',
                        'value' => 'isset($data->user) ? $data->user->mobile_number : "-"',
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 5. Status Badge
                    array(
                        'name' => 'status_id',
                        'type' => 'raw',
                        'value' => '($data->status_id == 1) 
                            ? "<span class=\"badge badge-success\">Active</span>" 
                            : "<span class=\"badge badge-danger\">Inactive</span>"',
                        'filter' => array(1 => 'Active', 2 => 'Inactive'),
                        'htmlOptions' => array('style' => 'text-align:center; width:10%;'),
                    ),

                    // 6. YOUR CUSTOM ACTION DROPDOWN
                    array(
                        'header' => 'Actions',
                        'type' => 'raw',
                        'htmlOptions' => array('style' => 'width: 100px; text-align: center; overflow:visible;'), // overflow:visible is key for dropdowns!
                        'value' => '
                            \'<div class="dropdown no-arrow">\'.
                                \'<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton\'.$data->id.\'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\'.
                                    \'Actions\'.
                                \'</button>\'.
                                \'<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuButton\'.$data->id.\'">\'.
                                    
                                    // View
                                    CHtml::link(\'<i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> View Details\', 
                                        Yii::app()->createUrl("account/view", array("id"=>$data->id)), 
                                        array("class"=>"dropdown-item")
                                    ).
                                    
                                    // Edit
                                    CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit Record\', 
                                        Yii::app()->createUrl("account/update", array("id"=>$data->id)), 
                                        array("class"=>"dropdown-item")
                                    ).
                                    
                                    // Divider
                                    \'<div class="dropdown-divider"></div>\'.
                                    
                                    // Delete
                                    CHtml::link(\'<i class="fas fa-trash fa-sm fa-fw mr-2 text-danger"></i> Delete\', 
                                        "#", 
                                        array(
                                            "class"=>"dropdown-item text-danger",
                                            "submit"=>array("delete","id"=>$data->id),
                                            "confirm"=>"Are you sure you want to delete this user?",
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