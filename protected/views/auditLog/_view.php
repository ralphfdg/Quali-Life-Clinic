<?php
/* @var $this AuditLogController */
/* @var $data AuditLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::encode($data->action); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('target_entity')); ?>:</b>
	<?php echo CHtml::encode($data->target_entity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('target_id')); ?>:</b>
	<?php echo CHtml::encode($data->target_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('details')); ?>:</b>
	<?php echo CHtml::encode($data->details); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->ip_address); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	*/ ?>

</div>