<?php

class SpecializationController extends Controller
{
	public $layout = '//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			// Allow everyone to view (so dropdowns work)
			array(
				'allow',
				'actions' => array('index', 'view'),
				'users' => array('*'),
			),
			// Admins Manage
			array(
				'allow',
				'actions' => array('create', 'update', 'admin', 'delete'),
				'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()',
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model = new Specialization;

		if (isset($_POST['Specialization'])) {
			$model->attributes = $_POST['Specialization'];
			if ($model->save()) {

				// --- AUDIT LOG ---
				if (class_exists('AuditHelper')) {
					AuditHelper::log(
						'CREATE_SPECIALIZATION',
						'tbl_specialization',
						$model->id,
						"Added: " . $model->specialization_name
					);
				}
				// -----------------

				// Redirect to Admin List instead of View
				$this->redirect(array('admin'));
			}
		}

		$this->render('create', array('model' => $model));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['Specialization'])) {
			$model->attributes = $_POST['Specialization'];
			if ($model->save()) {

				// --- AUDIT LOG ---
				if (class_exists('AuditHelper')) {
					AuditHelper::log(
						'UPDATE_SPECIALIZATION',
						'tbl_specialization',
						$model->id,
						"Updated: " . $model->specialization_name
					);
				}
				// -----------------

				$this->redirect(array('admin'));
			}
		}

		$this->render('update', array('model' => $model));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$name = $model->specialization_name;

		// Optional: Check if used by doctors before deleting?
		// For now, we just delete and log.
		$model->delete();

		// --- AUDIT LOG ---
		if (class_exists('AuditHelper')) {
			AuditHelper::log('DELETE_SPECIALIZATION', 'tbl_specialization', $id, "Deleted: " . $name);
		}
		// -----------------

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Specialization');
		$this->render('index', array('dataProvider' => $dataProvider));
	}

	public function actionAdmin()
	{
		$model = new Specialization('search');
		$model->unsetAttributes();
		if (isset($_GET['Specialization']))
			$model->attributes = $_GET['Specialization'];

		$this->render('admin', array('model' => $model));
	}

	public function loadModel($id)
	{
		$model = Specialization::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'specialization-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
