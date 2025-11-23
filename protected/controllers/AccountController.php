<?php

class AccountController extends Controller
{
    public $layout='//layouts/column2';

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
            // Admins & Super Admins: Full Control
            array('allow',
                'actions'=>array('index','view','create','update','admin','delete'),
                'expression'=>'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()', 
            ),
            // Users: Edit Own Account Only
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

    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model (Doctor, Patient, or Admin).
     * Logic adapted from OldAccountController for better security.
     */
    public function actionCreate()
    {
        $model = new Account;
        $user = new User;

        // 1. Determine Scenario based on URL Type
        $typeId = isset($_GET['type']) ? (int)$_GET['type'] : 0;
        $scenario = 'createNewUser'; // Default
        if ($typeId == 3) $scenario = 'createNewDoctor';
        if ($typeId == 4) $scenario = 'createNewPatient';

        // Apply scenarios to models so specific validation rules trigger
        $model->setScenario($scenario);
        // $user->setScenario($scenario); // Only if User model has scenarios defined

        if (isset($_POST['Account'], $_POST['User'])) 
        {
            $model->attributes = $_POST['Account'];
            $user->attributes = $_POST['User'];
            
            // Enforce type from URL if present
            if ($typeId > 0) {
                $model->account_type_id = $typeId;
            }

            // 2. VALIDATE BOTH MODELS FIRST
            $valid = $model->validate();
            $valid = $user->validate() && $valid; 

            if ($valid) 
            {
                // 3. TRANSACTION START
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    if ($model->save(false)) // False because we already validated above
                    {
                        $user->account_id = $model->id; 
                        
                        if ($user->save(false)) 
                        {
                            $transaction->commit(); // Success!
                            
                            // --- AUDIT LOG ---
                            if(class_exists('AuditHelper')) {
                                AuditHelper::log('CREATE_ACCOUNT', 'tbl_account', $model->id, "Created user: " . $model->username);
                            }
                            
                            Yii::app()->user->setFlash('success', "Account successfully created!");
                            $this->redirect(array('view', 'id' => $model->id));
                        }
                    }
                    // If we reach here, something failed but didn't throw exception
                    throw new Exception('Failed to save User record.');

                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error', "Error creating account: " . $e->getMessage());
                    Yii::log("Create Account Error: " . $e->getMessage(), 'error');
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'user' => $user,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $user = $model->user;
        
        // Fallback if User profile is missing
        if($user === null) {
            $user = new User;
            $user->account_id = $model->id;
        }

        if(isset($_POST['Account'], $_POST['User']))
        {
            $model->attributes = $_POST['Account'];
            $user->attributes = $_POST['User'];
            
            // Password handling is done in Account::beforeSave() automatically
            
            $valid = $model->validate();
            $valid = $user->validate() && $valid;

            if($valid) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    if($model->save(false) && $user->save(false)) {
                        $transaction->commit();
                        Yii::app()->user->setFlash('success', "Account updated.");
                        $this->redirect(array('view','id'=>$model->id));
                    }
                } catch(Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error', "Update failed: " . $e->getMessage());
                }
            }
        }

        $this->render('update',array(
            'model'=>$model,
            'user'=>$user,
        ));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        // Soft Delete is safer (Set status to 2 = Inactive)
        $model->status_id = 2; 
        $model->save(false);

        // If request via AJAX, no redirect needed
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Account');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model=new Account('search');
        $model->unsetAttributes(); 
        
        if(isset($_GET['Account']))
            $model->attributes=$_GET['Account'];

        // Filter by type from URL (e.g. admin?type=3 for Doctors)
        if(isset($_GET['type']))
        {
            $model->account_type_id = (int)$_GET['type'];
        }

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function loadModel($id)
    {
        $model=Account::model()->with('user')->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}