<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	// --- CUSTOM FUNCTIONS ADDED ---

	/**
	 * @return bool whether the current user is a Super Admin.
	 */
	public function isSuperAdmin()
	{
		return !Yii::app()->user->isGuest && Yii::app()->user->getState("role") === "super admin";
	}
	
	/**
	 * @return bool whether the current user is an Admin (Secretary).
	 */
	public function isAdmin()
	{
		return !Yii::app()->user->isGuest && Yii::app()->user->getState("role") === "admin";
	}
	
	/**
	 * @return bool whether the current user is a Doctor.
	 */
	public function isDoctor()
	{
		return !Yii::app()->user->isGuest && Yii::app()->user->getState("role") === "doctor";
	}
	
	/**
	 * @return bool whether the current user is a Patient.
	 */
	public function isPatient()
	{
		return !Yii::app()->user->isGuest && Yii::app()->user->getState("role") === "patient";
	}
}