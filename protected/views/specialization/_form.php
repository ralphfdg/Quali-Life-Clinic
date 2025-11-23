<?php
/* @var $this SpecializationController */
/* @var $model Specialization */
/* @var $form CActiveForm */

// Hardcoded list of medical specializations for the dropdown
$specializationOptions = array(
    'General Medecine' => 'General Medecine',
    'Pediatrics' => 'Pediatrics',
    'Obstetrics and Gynecology' => 'Obstetrics and Gynecology',
    'Cardiology' => 'Cardiology',
    'Neurology' => 'Neurology',
);

// NOTE: We assume $specializationTally is available in this scope.
?>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-7">
            
            <div class="card shadow mb-4">
                
                <div class="card-header py-3"> 
                    <h3 class="panel-title m-0 font-weight-bold text-primary">
                        <i class="fa fa-tag"></i> Specialization Details
                    </h3>
                </div>
                
                <div class="card-body">
                
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'specialization-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('class'=>'form-horizontal'),
                    )); ?>

                    <p class="text-danger">Fields with <span class="required">*</span> are required.</p>
                    <?php echo $form->errorSummary($model, null, null, array('class' => 'alert alert-danger')); ?>

                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'specialization_name', array('class'=>'col-sm-4 control-label')); ?>
                        <div class="col-sm-8">
                            <?php 
                            echo $form->dropDownList($model, 'specialization_name', $specializationOptions, array(
                                'prompt'=>'Select Specialization', 
                                'class'=>'form-control'
                            )); 
                            ?>
                            <?php echo $form->error($model,'specialization_name', array('class'=>'help-block')); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'status_id', array('class'=>'col-sm-4 control-label')); ?>
                        <div class="col-sm-8">
                            <?php echo $form->dropDownList($model, 'status_id',
                                CHtml::listData(Status::model()->findAll(), 'id', 'status'),
                                array('prompt'=>'Select Status', 'class'=>'form-control')
                            ); ?>
                            <?php echo $form->error($model,'status_id', array('class'=>'help-block')); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create Specialization' : 'Save Changes', array(
                                'class'=>'btn btn-primary btn-md',
                                'style'=>'padding: 8px 20px; font-weight: 600;' 
                            )); ?>
                            
                            <?php echo CHtml::link('Cancel', array('admin'), array('class' => 'btn btn-default btn-md')); ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>
                
                </div>
            </div>
        </div>


        <div class="col-lg-5">
            <?php if (!empty($specializationTally)): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Specialization Distribution</h6>
                </div>
                <div class="card-body">

                    <?php 
                    $progressColors = ['bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-primary'];
                    $colorIndex = 0;
                    $totalSpecializations = array_sum(array_column($specializationTally, 'count'));

                    foreach ($specializationTally as $data):
                        $percent = ($totalSpecializations > 0) ? round(($data['count'] / $totalSpecializations) * 100) : 0;
                        $colorClass = $progressColors[$colorIndex % count($progressColors)];
                        $colorIndex++;
                    ?>

                        <h4 class="small font-weight-bold">
                            <?php echo CHtml::encode($data['specialization_name']); ?>
                            <span class="float-right"><?php echo $percent; ?>% (<?php echo $data['count']; ?>)</span>
                        </h4>

                        <div class="progress mb-4">
                            <div class="progress-bar <?php echo $colorClass; ?>" role="progressbar" style="width: <?php echo $percent; ?>%"
                                aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
            <?php else: ?>
                 <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="text-center">No specialization data available for the tally.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        </div> </div>

