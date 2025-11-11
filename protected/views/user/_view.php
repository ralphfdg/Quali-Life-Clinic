<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middlename')); ?>:</b>
	<?php echo CHtml::encode($data->middlename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qualifier')); ?>:</b>
	<?php echo CHtml::encode($data->qualifier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('specialization')); ?>:</b>
	<?php echo CHtml::encode($data->specialization); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specialization_id')); ?>:</b>
	<?php echo CHtml::encode($data->specialization_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ptr_number')); ?>:</b>
	<?php echo CHtml::encode($data->ptr_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license_number')); ?>:</b>
	<?php echo CHtml::encode($data->license_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license_expiration')); ?>:</b>
	<?php echo CHtml::encode($data->license_expiration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s2_number')); ?>:</b>
	<?php echo CHtml::encode($data->s2_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s2_expiration')); ?>:</b>
	<?php echo CHtml::encode($data->s2_expiration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maxicare_number')); ?>:</b>
	<?php echo CHtml::encode($data->maxicare_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_of_father')); ?>:</b>
	<?php echo CHtml::encode($data->name_of_father); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_dob')); ?>:</b>
	<?php echo CHtml::encode($data->father_dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_of_mother')); ?>:</b>
	<?php echo CHtml::encode($data->name_of_mother); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_dob')); ?>:</b>
	<?php echo CHtml::encode($data->mother_dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school')); ?>:</b>
	<?php echo CHtml::encode($data->school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_contact_number')); ?>:</b>
	<?php echo CHtml::encode($data->mother_contact_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_contact_number')); ?>:</b>
	<?php echo CHtml::encode($data->father_contact_number); ?>
	<br />

	*/ ?>

</div>