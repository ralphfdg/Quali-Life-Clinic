<?php
/* @var $this SpecializationController */
/* @var $model Specialization */

$this->breadcrumbs = array(
    'Specializations' => array('index'),
    'Manage',
);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Specializations</h1>
    <?php echo CHtml::link('<i class="fas fa-plus"></i> Add Specialization', array('create'), array('class' => 'btn btn-sm btn-primary shadow-sm')); ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 border-left-primary">
        <h6 class="m-0 font-weight-bold text-primary">List of Specializations</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'specialization-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,

                // Bootstrap Styling
                'itemsCssClass' => 'table table-bordered table-hover',
                'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
                'summaryCssClass' => 'dataTables_info',
                'filterCssClass' => 'filter-class',

                'columns' => array(
                    // 1. Name
                    array(
                        'name' => 'specialization_name',
                        'type' => 'raw',
                        'value' => 'CHtml::link(CHtml::encode($data->specialization_name), array("update", "id"=>$data->id), array("class"=>"font-weight-bold text-primary"))',
                    ),

                    // 2. Doctor Count
                    array(
                        'header' => 'Doctors Assigned',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $count = User::model()->count('specialization_id=:id', array(':id' => $data->id));
                            if ($count > 0) {
                                return '<span class="badge badge-info">' . $count . ' Doctors</span>';
                            }
                            return '<span class="text-muted small">None</span>';
                        },
                        'htmlOptions' => array('width' => '20%', 'style' => 'text-align:center;'),
                    ),

                    // 3. Status
                    array(
                        'name' => 'status_id',
                        'type' => 'raw',
                        'value' => '($data->status_id == 1) 
                            ? "<span class=\"badge badge-success\">Active</span>" 
                            : "<span class=\"badge badge-danger\">Inactive</span>"',
                        'filter' => array(1 => 'Active', 2 => 'Inactive'),
                        'htmlOptions' => array('style' => 'text-align:center; width:15%;'),
                    ),

                    // 4. ACTIONS (Unified Dropdown Style)
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
                                        Yii::app()->createUrl("specialization/update", array("id"=>$data->id)), 
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
                                            "confirm"=>"Are you sure you want to delete this item?",
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