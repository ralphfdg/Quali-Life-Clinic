<?php
/* @var $model BirthHistory */
/* @var $patientID integer */
?>

<div class="p-3">
    <?php if ($model): ?>

        <div class="p-4 rounded border-left-primary" style="background-color: #f8f9fc;">

            <h5 class="text-primary font-weight-bold mb-4"><i class="fas fa-baby mr-2"></i> Birth History Details</h5>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Classification
                    </div>
                    <ul class="list-unstyled small text-gray-800">
                        <li><strong>Blood Type:</strong> <?php echo CHtml::encode($model->getBloodTypeLabel()); ?></li>
                        <li><strong>Term:</strong> <?php echo CHtml::encode($model->getTermLabel()); ?></li>
                        <li><strong>Delivery Type:</strong> <?php echo CHtml::encode($model->getDeliveryTypeLabel()); ?></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Weight & Length
                    </div>
                    <ul class="list-unstyled small text-gray-800">
                        <li><strong>Birth Weight:</strong> <?php echo CHtml::encode($model->getFormattedWeight()); ?></li>
                        <li><strong>Birth Length:</strong> <?php echo CHtml::encode($model->getFormattedLength()); ?></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Circumferences
                    </div>
                    <ul class="list-unstyled small text-gray-800">
                        <li><strong>Head Circ.:</strong> <?php echo CHtml::encode($model->getFormattedHeadCircumference()); ?></li>
                        <li><strong>Chest Circ.:</strong> <?php echo CHtml::encode($model->getFormattedChestCircumference()); ?></li>
                        <li><strong>Abdominal Circ.:</strong> <?php echo CHtml::encode($model->getFormattedAbdominalCircumference()); ?></li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="mt-3">
                <?php
                echo CHtml::link(
                    '<i class="fas fa-edit"></i> Edit Birth History',
                    array('/birthHistory/update', 'id' => $model->id),
                    array('class' => 'btn btn-sm btn-warning shadow-sm')
                );
                ?>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-info text-center py-4 rounded shadow-sm" style="border-left: 5px solid #36b9cc; background-color: #e7f7f8;">
            <i class="fas fa-exclamation-circle fa-2x mb-2 text-info"></i>
            <p class="mb-2 font-weight-bold text-gray-800">No Birth History record found for this patient.</p>
            <?php
            echo CHtml::link(
                '<i class="fas fa-plus-circle"></i> Create Birth History',
                array('/birthHistory/create', 'account_id' => $patientID),
                array('class' => 'btn btn-info shadow-sm mt-2')
            );
            ?>
        </div>
    <?php endif; ?>
</div>