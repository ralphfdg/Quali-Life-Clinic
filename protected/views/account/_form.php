<?php
/* @var $this AccountController */
/* @var $account Account */ // Renamed $model to $account for clarity based on renderPartial call
/* @var $user User */ // New model for user details
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'account-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'user'), // Added SB Admin 2 form class
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary(array($account, $user), null, null, array('class' => 'alert alert-danger')); ?>

    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($account,'username'); ?>
            <?php echo $form->textField($account,'username',array('class'=>'form-control form-control-user', 'placeholder'=>'Username')); ?>
            <?php echo $form->error($account,'username'); ?>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($account,'password'); ?>
            <?php echo $form->passwordField($account,'password',array('class'=>'form-control form-control-user', 'placeholder'=>'Password', 'value'=>'')); ?>
            <?php if (!$account->isNewRecord): ?>
                <small class="form-text text-muted">Leave blank to keep current password.</small>
            <?php endif; ?>
            <?php echo $form->error($account,'password'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo CHtml::label('Retype Password *', 'retype_password'); ?>
            <?php echo CHtml::passwordField('retype_password', '', array('class'=>'form-control form-control-user', 'placeholder'=>'Retype Password')); ?>
            <?php // You might need custom validation for retype_password in your controller/model ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($account,'email_address'); ?>
            <?php echo $form->textField($account,'email_address',array('class'=>'form-control form-control-user', 'placeholder'=>'Email Address')); ?>
            <?php echo $form->error($account,'email_address'); ?>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'qualifier'); ?>
            <?php echo $form->textField($user,'qualifier',array('class'=>'form-control form-control-user', 'placeholder'=>'Qualifier (Jr, Sr, III)')); ?>
            <?php echo $form->error($user,'qualifier'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $form->labelEx($user,'lastname'); ?>
            <?php echo $form->textField($user,'lastname',array('class'=>'form-control form-control-user', 'placeholder'=>'Lastname *')); ?>
            <?php echo $form->error($user,'lastname'); ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'firstname'); ?>
            <?php echo $form->textField($user,'firstname',array('class'=>'form-control form-control-user', 'placeholder'=>'Firstname *')); ?>
            <?php echo $form->error($user,'firstname'); ?>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'middlename'); ?>
            <?php echo $form->textField($user,'middlename',array('class'=>'form-control form-control-user', 'placeholder'=>'Middlename')); ?>
            <?php echo $form->error($user,'middlename'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $form->labelEx($user,'dob'); ?>
            <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $user, // Use $user model for DOB
                'attribute' => 'dob',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => '1900:'.date('Y'), // Example year range
                ),
                'htmlOptions' => array(
                    'class' => 'form-control form-control-user', // SB Admin 2 class
                    'placeholder' => 'DOB *',
                ),
            ));
            ?>
            <?php echo $form->error($user,'dob'); ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'specialization'); ?>
            <?php echo $form->dropDownList($user, 'specialization',
                CHtml::listData(Specialization::model()->findAll(), 'name', 'name'), // Assuming Specialization model exists
                array('class'=>'form-control', 'prompt'=>'Please select one')
            ); ?>
            <?php echo $form->error($user,'specialization'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $form->labelEx($user,'ptr_number'); ?>
            <?php echo $form->textField($user,'ptr_number',array('class'=>'form-control form-control-user', 'placeholder'=>'Ptr Number *')); ?>
            <?php echo $form->error($user,'ptr_number'); ?>
        </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'license_number'); ?>
            <?php echo $form->textField($user,'license_number',array('class'=>'form-control form-control-user', 'placeholder'=>'License Number *')); ?>
            <?php echo $form->error($user,'license_number'); ?>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'license_expiration'); ?>
            <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $user, // Use $user model for License Expiration
                'attribute' => 'license_expiration',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => date('Y').':'.(date('Y')+20), // Future years for expiration
                ),
                'htmlOptions' => array(
                    'class' => 'form-control form-control-user',
                    'placeholder' => 'License Expiration *',
                ),
            ));
            ?>
            <?php echo $form->error($user,'license_expiration'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $form->labelEx($user,'maxicare_number'); ?>
            <?php echo $form->textField($user,'maxicare_number',array('class'=>'form-control form-control-user', 'placeholder'=>'Maxicare Number')); ?>
            <?php echo $form->error($user,'maxicare_number'); ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'s2_number'); ?>
            <?php echo $form->textField($user,'s2_number',array('class'=>'form-control form-control-user', 'placeholder'=>'S2 Number')); ?>
            <?php echo $form->error($user,'s2_number'); ?>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <?php echo $form->labelEx($user,'s2_expiration'); ?>
            <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $user, // Use $user model for S2 Expiration
                'attribute' => 's2_expiration',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => date('Y').':'.(date('Y')+20), // Future years for expiration
                ),
                'htmlOptions' => array(
                    'class' => 'form-control form-control-user',
                    'placeholder' => 'S2 Expiration',
                ),
            ));
            ?>
            <?php echo $form->error($user,'s2_expiration'); ?>
        </div>
        <div class="col-sm-4">
            <?php echo $form->labelEx($user,'address'); ?>
            <?php echo $form->textField($user,'address',array('class'=>'form-control form-control-user', 'placeholder'=>'Address')); ?>
            <?php echo $form->error($user,'address'); ?>
        </div>
    </div>
    
    <?php // The account_type_id is likely set in the controller for 'createDoctor'
          // If you need to expose these fields, uncomment and style them similarly.
          // For now, they are assumed to be managed by the controller logic.
    ?>
    <?php echo $form->hiddenField($account,'account_type_id'); ?>
    <?php echo $form->hiddenField($account,'status_id'); ?>


    <div class="row buttons mt-4">
        <div class="col-sm-12 text-center">
            <?php echo CHtml::link('Cancel', Yii::app()->request->urlReferrer, array('class' => 'btn btn-secondary btn-icon-split mr-2')); ?>
            <?php echo CHtml::submitButton($account->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success btn-icon-split')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div>

