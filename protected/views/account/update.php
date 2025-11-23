<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $user User */

$this->breadcrumbs = array(
    'Accounts' => array('index'),
    $model->username => array('view', 'id' => $model->id),
    'Update',
);

// Check if editing self
$isMe = (Yii::app()->user->id == $model->id);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <?php echo $isMe ? 'Edit My Profile' : 'Update Account: <span class="text-primary">' . CHtml::encode($model->username) . '</span>'; ?>
    </h1>
    <div>
        <?php echo CHtml::link('<i class="fas fa-eye"></i> View', array('view', 'id' => $model->id), array('class' => 'btn btn-sm btn-info shadow-sm')); ?>

        <?php if (!$isMe): ?>
            <?php echo CHtml::link('<i class="fas fa-arrow-left"></i> Back', array('admin'), array('class' => 'btn btn-sm btn-secondary shadow-sm')); ?>
        <?php endif; ?>
    </div>
</div>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'user' => $user
));
?>