<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'account-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    
    // Apply Bootstrap/SB Admin 2 table classes
    'itemsCssClass'=>'table table-bordered', 
    'pagerCssClass'=>'dataTables_paginate paging_simple_numbers', 
    'summaryCssClass'=>'dataTables_info', 
    'filterCssClass'=>'filter-class', 

    'columns'=>array(
        'id',
        'username',
        'email_address',
        array(
            'name'=>'account_type_id',
            'header'=>'Account Type',
            'value'=>'$data->accountType->type',
            'filter'=>CHtml::listData(AccountType::model()->findAll(), 'id', 'type'),
        ),
        array(
            'name'=>'status_id',
            'header'=>'Status',
            'value'=>'$data->status->status',
            'filter'=>CHtml::listData(Status::model()->findAll(), 'id', 'status'),
        ),
        'date_created',
        // MODIFICATION: Replaced CButtonColumn with a Custom Dropdown Actions Column
        array(
            'header' => 'Actions',
            'type' => 'raw',
            'value' => '
                // Custom Bootstrap Dropdown Button
                \'<div class="dropdown no-arrow">\'.
                    \'<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton\'.$data->id.\'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\'.
                        \'Actions\'.
                    \'</button>\'.
                    \'<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuButton\'.$data->id.\'">\'.
                        // View Button
                        CHtml::link(\'<i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> View\', 
                            Yii::app()->createUrl("account/view", array("id"=>$data->id)), 
                            array("class"=>"dropdown-item")
                        ).
                        // Edit Button
                        CHtml::link(\'<i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edit\', 
                            Yii::app()->createUrl("account/update", array("id"=>$data->id)), 
                            array("class"=>"dropdown-item")
                        ).
                        // Separator
                        \'<div class="dropdown-divider"></div>\'.
                        // Delete Button
                        CHtml::link(\'<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Delete\', 
                            Yii::app()->createUrl("account/delete", array("id"=>$data->id)), 
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
            'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
        ),
    ),
)); ?>