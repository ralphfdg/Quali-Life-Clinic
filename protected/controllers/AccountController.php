<?php

class AccountController extends Controller
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
			array(
				'allow',
				'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete'),
				'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()',
			),
			array(
				'allow',
				'actions' => array('update', 'view'),
				'users' => array('@'),
				'expression' => '$user->id == $_GET["id"]',
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	public function actionCreate()
	{
		$model = new Account;
		$user = new User;

		// Auto-select type from URL (e.g. ?type=3 for Doctor)
		$typeId = isset($_GET['type']) ? (int)$_GET['type'] : 0;
		if ($typeId > 0) {
			$model->account_type_id = $typeId;
		}

		// NOTE: We rely on the default 'insert' scenario here.
		// This matches the rules in Account.php we just updated.

		if (isset($_POST['Account'], $_POST['User'])) {
			$model->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];

			// FIX: Assign dummy ID to User so it passes "required" check
			$user->account_id = 0;

			// --- TRIGGER VALIDATION MANUALLY ---
			$valid = $model->validate();
			$valid = $user->validate() && $valid;
			// -----------------------------------

			if ($valid) {
				$transaction = Yii::app()->db->beginTransaction();
				try {
					// 1. Save Account
					if ($model->save(false)) {
						// 2. Assign Real ID to User
						$user->account_id = $model->id;

						// 3. Save User
						if ($user->save(false)) {
							$transaction->commit();

							// Optional Audit Log
							if (class_exists('AuditHelper')) {
								AuditHelper::log('CREATE_ACCOUNT', 'tbl_account', $model->id, "Created: " . $model->username);
							}

							Yii::app()->user->setFlash('success', "Account created successfully!");
							$this->redirect(array('view', 'id' => $model->id));
						}
					}
					// If save returns false despite validation passing (rare DB error)
					throw new Exception('Database error: Failed to save records.');
				} catch (Exception $e) {
					$transaction->rollback();
					Yii::app()->user->setFlash('error', "Error: " . $e->getMessage());
				}
			}
		}

		$this->render('create', array(
			'model' => $model,
			'user' => $user,
		));
	}

	// ... (Keep actionUpdate, actionDelete, actionAdmin, etc. unchanged) ...
	// (Paste the rest of your controller methods here)

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$user = $model->user ? $model->user : new User; // Handle missing profile

		if (isset($_POST['Account'], $_POST['User'])) {
			$model->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];

			$valid = $model->validate();
			$valid = $user->validate() && $valid;

			if ($valid) {
				if ($model->save(false) && $user->save(false)) {
					Yii::app()->user->setFlash('success', "Updated successfully.");
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}
		$this->render('update', array('model' => $model, 'user' => $user));
	}

	public function loadModel($id)
    {
        // Use the NEW relation name here
        $model = Account::model()->with('user.specializationInfo')->findByPk($id);
        
        if($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
            
        return $model;
    }

	public function actionAdmin()
	{
		$model = new Account('search');
		$model->unsetAttributes();
		if (isset($_GET['Account'])) $model->attributes = $_GET['Account'];
		if (isset($_GET['type'])) $model->account_type_id = (int)$_GET['type'];
		$this->render('admin', array('model' => $model));
	}

	public function actionView($id)
	{
		// We use loadModel() to fetch the data securely
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete(); // Or soft delete logic
		if (!isset($_GET['ajax'])) $this->redirect(array('admin'));
	}
}
