<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to QualiLife Clinic</h1>

<p>
This is the main home page for your clinic.
</p>
<p>
A simple page with clinic info, address, and contact number.
</p>

<ul>
	<li><strong>Address:</strong> 123 Health St, Medical City, 12345</li>
	<li><strong>Contact:</strong> (012) 345-6789</li>
</ul>

<p>
If you are a patient, please <?php echo CHtml::link('Login', array('site/login')); ?> to book an appointment.
</p>