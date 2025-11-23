<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array('Login');
?>

<style>
    /* Green Background */
    body {
        background-color: #02700d; 
        background-image: linear-gradient(180deg, #02700d 10%, #025d0b 100%);
        background-size: cover;
        height: 100vh;
    }
    #page { margin-top: 50px; }
    .footer-text { color: rgba(255,255,255,0.8); }

    /* --- FIX 1: STOP INPUT SHRINKING --- */
    /* This forces the form group to behave like a normal block, preventing flex squeezing */
    .form-group {
        display: block !important; 
        position: relative;
        margin-bottom: 1.5rem;
    }

    /* This forces the input to hold its shape no matter what text is added */
    .form-control-user {
        width: 100% !important;
        flex-shrink: 0 !important; 
    }

    /* --- FIX 2: POSITION ERROR MESSAGE --- */
    /* This makes the error text red, small, and ensures it sits BELOW the input */
    .errorMessage {
        color: #e74a3b !important; /* Red */
        font-size: 0.8rem;
        margin-top: 5px;
        display: block; /* Forces it to a new line */
        width: 100%;
    }

    /* Eye Icon Styling */
    .password-toggle {
        position: absolute;
        right: 20px;
        top: 15px; /* Adjust based on input height */
        cursor: pointer;
        color: #6e707e;
        z-index: 10;
    }
</style>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" 
                                             alt="Logo" 
                                             style="width: 100px; height: auto;">
                                    </div>
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'login-form',
                                    'enableClientValidation'=>true,
                                    'clientOptions'=>array(
                                        'validateOnSubmit'=>true,
                                    ),
                                    'htmlOptions'=>array('class'=>'user'),
                                )); ?>
                                    
                                    <?php if($model->hasErrors() && empty($model->username) && empty($model->password)): ?>
                                        <div class="alert alert-danger p-2 small">
                                            Please correct the errors below.
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <?php echo $form->textField($model,'username', array('class'=>'form-control form-control-user', 'placeholder'=>'Enter Username...')); ?>
                                        <?php echo $form->error($model,'username', array('class'=>'errorMessage')); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->passwordField($model,'password', array('class'=>'form-control form-control-user', 'placeholder'=>'Password', 'id'=>'password-field')); ?>
                                        
                                        <span class="fas fa-eye password-toggle" onclick="togglePassword()"></span>
                                        
                                        <?php echo $form->error($model,'password', array('class'=>'errorMessage')); ?>
                                    </div>
                                    
                                    <?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary btn-user btn-block')); ?>
                                    
                                <?php $this->endWidget(); ?>
                                
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?php echo $this->createUrl('site/index'); ?>">
                                        <i class="fas fa-arrow-left"></i> Back to Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center footer-text small">
                 &copy; <?php echo date('Y'); ?> Quali-Life Clinic
            </div>

        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var input = document.getElementById("password-field");
        var icon = document.querySelector(".password-toggle");
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>