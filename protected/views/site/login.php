<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>

<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array('class'=>'user'), // Adds the 'user' class for rounded inputs
)); ?>

    <div class="form-group">
        <?php echo $form->textField($model,'username', array(
            'class'=>'form-control form-control-user',
            'placeholder'=>'Enter Username or Email...',
            'aria-describedby'=>'emailHelp'
        )); ?>
        <?php echo $form->error($model,'username', array('class'=>'text-danger small pl-3')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->passwordField($model,'password', array(
            'class'=>'form-control form-control-user',
            'placeholder'=>'Password'
        )); ?>
        <?php echo $form->error($model,'password', array('class'=>'text-danger small pl-3')); ?>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox small">
            <?php echo $form->checkBox($model,'rememberMe', array('class'=>'custom-control-input', 'id'=>'customCheck')); ?>
            <label class="custom-control-label" for="customCheck">Remember Me</label>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>
    </div>

    <?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary btn-user btn-block')); ?>

    <hr>
    
    <a href="#" class="btn btn-google btn-user btn-block">
        <i class="fab fa-google fa-fw"></i> Login with Google
    </a>
    <a href="#" class="btn btn-facebook btn-user btn-block">
        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
    </a>

<?php $this->endWidget(); ?>

<hr>
<div class="text-center">
    <a class="small" href="#">Forgot Password?</a>
</div>
<div class="text-center">
    <a class="small" href="#">Create an Account!</a>
</div>