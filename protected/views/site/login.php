<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array('Login');

// NOTE: This view will use the "else" (guest) block in main.php layout, which does not show the sidebar.
?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    <p class="text-muted small">Please fill out the following form with your login credentials:</p>
                                </div>
                                
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'login-form',
                                    'enableClientValidation'=>true,
                                    'clientOptions'=>array(
                                        'validateOnSubmit'=>true,
                                    ),
                                    'htmlOptions'=>array('class'=>'user'), // Add SB Admin 2 class
                                )); ?>
                                
                                    <?php echo $form->errorSummary($model); ?>
                                    
                                    <div class="form-group">
                                        <?php echo $form->textField($model,'username', array('class'=>'form-control form-control-user', 'placeholder'=>'Enter Username...')); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->passwordField($model,'password', array('class'=>'form-control form-control-user', 'placeholder'=>'Password')); ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <?php echo $form->checkBox($model,'rememberMe', array('class'=>'custom-control-input', 'id'=>'customCheck')); ?>
                                            <?php echo $form->label($model,'rememberMe', array('class'=>'custom-control-label', 'for'=>'customCheck')); ?>
                                        </div>
                                    </div>
                                    
                                    <?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary btn-user btn-block')); ?>
                                    
                                <?php $this->endWidget(); ?>
                                <hr>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>