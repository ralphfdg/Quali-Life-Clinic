<?php
/* @var $this PrescriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'My Prescriptions',
);
?>

<h1 style="color: #2c3e50;"><i class="fas fa-pills"></i> My Prescriptions</h1>

<div class="prescription-list">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'prescription-grid',
    'dataProvider'=>$dataProvider,
    'itemsCssClass'=>'table table-bordered table-hover', // Uses Bootstrap styling if available
    'columns'=>array(
        
        // Date Column
        array(
            'name'=>'date_of_prescription',
            'header'=>'Date Issued',
            'value'=>'date("F j, Y", strtotime($data->date_of_prescription))',
            'htmlOptions'=>array('style'=>'width: 150px; font-weight: bold;'),
        ),

        // Doctor Column
        array(
            'header'=>'Prescribed By',
            'value'=>function($data) {
                if(isset($data->doctorAccount) && isset($data->doctorAccount->user)) {
                    return "Dr. " . $data->doctorAccount->user->lastname;
                }
                return "Unknown";
            },
        ),

        // Preview Column
        array(
            'header'=>'Medication Preview',
            'value'=>'substr($data->prescription, 0, 60) . (strlen($data->prescription) > 60 ? "..." : "")',
        ),

        // View Button
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}', // Only show the 'view' icon
            'buttons'=>array(
                'view'=>array(
                    'label'=>'View Digital Script',
                    'imageUrl'=>false, // Use text/icon instead of default image
                    'options'=>array('class'=>'btn btn-sm btn-primary', 'style'=>'color: white; text-decoration: none; padding: 3px 8px; border-radius: 3px;'),
                ),
            ),
        ),
    ),
)); ?>
</div>