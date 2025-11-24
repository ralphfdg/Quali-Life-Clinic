<?php
/* @var $model BirthHistory */
/* @var $patientID integer */
?>

<div class="p-3">
    <?php if ($model): ?>
        <h5 class="font-weight-bold text-primary mb-3">Birth Details</h5>
        <div class="row">
            <div class="col-lg-6">
                <?php $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array('class' => 'table table-bordered table-striped detail-view'), // ADDED STYLING
                    'attributes' => array(
                        'blood_type',
                        'term',
                        'type_of_delivery',
                    ),
                )); ?>
            </div>
             <div class="col-lg-6">
                 <?php $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'htmlOptions' => array('class' => 'table table-bordered table-striped detail-view'), // ADDED STYLING
                    'attributes' => array(
                        'birth_weight',
                        'birth_length',
                        'birth_head_circumference',
                        'birth_chest_circumference',
                        // ... and other measurements
                    ),
                )); ?>
            </div>
        </div>

        <p class="mt-3">
            <?php echo CHtml::link('<i class="fas fa-edit"></i> Edit Birth History', array('/birthHistory/update', 'id' => $model->id), array('class' => 'btn btn-sm btn-warning shadow-sm')); ?>
        </p>
    <?php else: ?>
        <div class="alert alert-info text-center py-4">
            <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
            <p>No Birth History record found for this patient.</p>
            <?php echo CHtml::link('<i class="fas fa-plus-circle"></i> Create Birth History', array('/birthHistory/create', 'account_id' => $patientID), array('class' => 'btn btn-info shadow-sm mt-2')); ?>
        </div>
    <?php endif; ?>
</div>