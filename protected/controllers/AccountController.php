<?php

class AccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 */
	public function accessRules()
{
    return array(
        array('allow',
            'actions'=>array('index','view','create','update','admin','delete'),
            'expression'=>'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()', 
        ),
        array('allow',
            'actions'=>array('update', 'view'),
            'users'=>array('@'),
            'expression'=>'$user->id == $_GET["id"]',
        ),
        array('deny',
            'users'=>array('*'),
        ),
    );
}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
public function actionCreate()
{
    // 1. Initialize both models
    $model = new Account; // The Account model
    $user = new User;     // The User model (needed for doctor's personal and credential details)

    // Optional: Set a specific account type if needed (e.g., Doctor = 3)
    // $model->account_type_id = 3; 

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model); 
    // $this->performAjaxValidation($user); // Add user model to validation if implemented

    // 2. Handle POST Request (Check for both model's data)
    if (isset($_POST['Account'], $_POST['User'])) 
    {
        // Assign attributes from POST data
        $model->attributes = $_POST['Account'];
        $user->attributes = $_POST['User'];
        
        // Ensure the password is required/validated only for new records
        // This is necessary because Yii doesn't automatically handle the "retype password" field.
        
        // 3. Validate Both Models
        if ($model->validate() && $user->validate()) 
        {
            // 4. TRANSACTION: Use a transaction to ensure both records are saved or neither are.
            $transaction = Yii::app()->db->beginTransaction();
            try {
                // Save User model first (User table must exist before Account table can reference it)
                if ($user->save(false)) // We use (false) here to skip re-validation after the block above
                {
                    // Link the newly created User ID to the Account model
                    $model->user_id = $user->id; 
                    
                    // Save the Account model
                    if ($model->save(false)) 
                    {
                        $transaction->commit(); // Both saves successful, commit the transaction
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
                
                // If either save failed before commit, the exception handles rollback.
                throw new Exception('Failed to save User or Account model.'); 

            } catch (Exception $e) {
                $transaction->rollback(); // Revert changes if anything failed
                Yii::log("Error saving models: " . $e->getMessage(), 'error');
                // You may want to add user-friendly error messages here.
            }
        }
    }

    // 5. Render the view, passing both models
    $this->render('create', array(
        'model' => $model, // Pass Account model (as 'model' for create.php)
        'user' => $user,   // Pass User model (NEW: needed for form fields)
    ));
}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Account');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		if(isset($_GET['type']))
		{
			$model->account_type_id = (int)$_GET['type'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
