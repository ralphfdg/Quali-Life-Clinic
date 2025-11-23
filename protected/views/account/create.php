<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $user User */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<h1>Create <?php 
    $type = (isset($_GET['type']) && $_GET['type']==3) ? 'Doctor' : ((isset($_GET['type']) && $_GET['type']==4) ? 'Patient' : 'Account');
    echo $type; 
?></h1>

<?php 
// --- THE FIX IS HERE ---
// Make sure 'user' points to $user, NOT $model
$this->renderPartial('_form', array(
    'model'=>$model, 
    'user'=>$user 
)); 
?>