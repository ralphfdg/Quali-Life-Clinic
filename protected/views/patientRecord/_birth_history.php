<?php
/* @var $model BirthHistory */
/* @var $patientID integer */
?>

<div class="p-3">
    <?php if ($model): ?>
        <h5 class="font-weight-bold text-primary">Birth Details</h5>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'blood_type',
                'term',
                'type_of_delivery',
                'birth_weight',
                'birth_length',
                // ... add other attributes from BirthHistory model
            ),
        )); ?>
        <p class="mt-3">
            <?php echo CHtml::link('<i class="fas fa-edit"></i> Edit Birth History', array('/birthHistory/update', 'id' => $model->id), array('class' => 'btn btn-sm btn-warning')); ?>
        </p>
    <?php else: ?>
        <div class="alert alert-info text-center">
            No Birth History record found for this patient.
            <p class="mt-2">
                <?php echo CHtml::link('<i class="fas fa-plus-circle"></i> Create Birth History', array('/birthHistory/create', 'account_id' => $patientID), array('class' => 'btn btn-sm btn-info')); ?>
            </p>
        </div>
    <?php endif; ?>
</div>