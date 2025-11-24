<?php
/* @var $this AccountController */
/* @var $model Account */

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

$this->breadcrumbs = array('Accounts' => array('index'), 'Manage');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    <?php if ($typeId > 0): ?>
        <?php echo CHtml::link('<i class="fas fa-plus"></i> ' . $addLabel, array('create', 'type' => $typeId), array('class' => 'btn btn-sm btn-primary shadow-sm')); ?>
    <?php endif; ?>
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
                        'htmlOptions' => array('width' => '12%'),
                    ),

                    // 2. Full Name
                    array(
                        'header' => 'Full Name',
                        'type' => 'text',
                        'value' => 'isset($data->user) ? ($data->user->firstname . " " . $data->user->lastname . ($data->user->qualifier ? " " . $data->user->qualifier : "")) : "No Profile"',
                    ),

                    // 3. Specialization (ADDED BACK - Visible ONLY for Doctors)
                    array(
                        'header' => 'Specialization',
                        'visible' => ($typeId == 3), // Check if we are on the Doctor page
                        'value' => '(isset($data->user) && isset($data->user->specializationInfo)) ? $data->user->specializationInfo->specialization_name : "General"',
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 4. Account Type (Visible only if viewing All Accounts)
                    array(
                        'name' => 'account_type_id',
                        'header' => 'Type',
                        'value' => 'isset($data->accountType) ? $data->accountType->type : $data->account_type_id',
                        'filter' => CHtml::listData(AccountType::model()->findAll(), 'id', 'type'),
                        'visible' => ($typeId == 0),
                        'htmlOptions' => array('width' => '10%'),
                    ),

                    // 5. Email
                    array(
                        'name' => 'email_address',
                        'header' => 'Email',
                        'htmlOptions' => array('width' => '15%'),
                    ),

                    // 6. Age
                    array(
                        'header' => 'Age',
                        'value' => 'isset($data->user) ? date_diff(date_create($data->user->dob), date_create("today"))->y : "-"',
                        'htmlOptions' => array('width' => '5%', 'style' => 'text-align:center;'),
                    ),

                    // 7. Contact
                    array(
                        'header' => 'Contact',
                        'value' => 'isset($data->user) ? $data->user->mobile_number : "-"',
                        'htmlOptions' => array('width' => '12%'),
                    ),

                    // 8. Status
                    array(
                        'name' => 'status_id',
                        'type' => 'raw',
                        'value' => '($data->status_id == 1) ? "<span class=\"badge badge-success\">Active</span>" : "<span class=\"badge badge-danger\">Inactive</span>"',
                        'filter' => array(1 => 'Active', 2 => 'Inactive'),
                        'htmlOptions' => array('style' => 'text-align:center; width:8%;'),
                    ),

                    // 9. Action Dropdown
                    array(
                        'header' => 'Actions',
                        'type' => 'raw',
                        'htmlOptions' => array('style' => 'width: 60px; text-align: center; overflow:visible;'),
                        'value' => '
                            \'<div class="dropdown no-arrow">\'.
                                \'<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton\'.$data->id.\'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\'.
                                    \'<i class="fas fa-cog"></i>\'.
                                \'</button>\'.
                                \'<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuButton\'.$data->id.\'">\'.
                                    CHtml::link(\'<i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> View\', Yii::app()->createUrl("account/view", array("id"=>$data->id)), array("class"=>"dropdown-item")).
                                    CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', Yii::app()->createUrl("account/update", array("id"=>$data->id)), array("class"=>"dropdown-item")).
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