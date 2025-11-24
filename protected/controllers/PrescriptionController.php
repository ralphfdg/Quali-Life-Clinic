<?php

class PrescriptionController extends Controller
{
    /**
     * @var string the default layout for the views.
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
            // 1. Allow Patients to view and PRINT their own list and details
            array('allow',
                'actions'=>array('myPrescriptions', 'view', 'print'), // ADDED 'print'
                'expression'=>'Yii::app()->controller->isPatient()',
            ),
            // 2. Allow Doctors to Create, Update, View, and PRINT
            array('allow',
                'actions'=>array('create', 'update', 'index', 'view', 'print'), // ADDED 'print'
                'expression'=>'Yii::app()->controller->isDoctor()',
            ),
            // 3. Allow Admins & Super Admins to Manage
            array('allow',
                'actions'=>array('admin', 'delete', 'index', 'view', 'create', 'update', 'print'), // ADDED 'print'
                'expression'=>'Yii::app()->controller->isAdmin() || Yii::app()->controller->isSuperAdmin()',
            ),
            // Deny everyone else
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    /**
     * NEW ACTION: Print Prescription (Opens in separate tab with print layout)
     */
    public function actionPrint($id)
    {
        $model = $this->loadModel($id);

        // Security: If Patient, ensure they own this prescription
        if (Yii::app()->controller->isPatient() && $model->patient_account_id != Yii::app()->user->id) {
             throw new CHttpException(403, 'You are not authorized to print this prescription.');
        }

        // Use the dedicated Print Layout
        $this->layout = '//layouts/print';
        
        $this->render('print',array(
            'model'=>$model,
        ));
    }

    /**
     * Displays a particular model.
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Security: If Patient, ensure they own this prescription
        if (Yii::app()->controller->isPatient() && $model->patient_account_id != Yii::app()->user->id) {
             throw new CHttpException(403, 'You are not authorized to view this prescription.');
        }

        $this->render('view',array(
            'model'=>$model,
        ));
    }

    /**
     * Creates a new model.
     * LOGIC ADDED: Pre-fills data based on Consultation ID
     */
    public function actionCreate()
    {
        $model=new Prescription;

        // --- 1. PRE-FILL DATA (If coming from Consultation) ---
        if (isset($_GET['consultation_id'])) {
            $consultId = (int)$_GET['consultation_id'];
            $consult = ConsultationRecord::model()->findByPk($consultId);
            
            if ($consult) {
                $model->consultation_id = $consult->id;
                $model->patient_account_id = $consult->patient_account_id;
                $model->doctor_account_id = $consult->doctor_account_id;
                $model->date_of_prescription = date('Y-m-d');
                $model->status_id = 1; // Active
            }
        }
        // -----------------------------------------------------

        if(isset($_POST['Prescription']))
        {
            $model->attributes=$_POST['Prescription'];
            
            // Ensure the doctor ID is accurate (if logged in as doctor)
            if(Yii::app()->controller->isDoctor()) {
                $model->doctor_account_id = Yii::app()->user->id;
            }
            
            if($model->save()) {
                Yii::app()->user->setFlash('success', "Prescription created successfully.");
                
                // Redirect back to the Consultation View to keep the flow smooth
                if (!empty($model->consultation_id)) {
                    $this->redirect(array('consultationRecord/view','id'=>$model->consultation_id));
                } else {
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['Prescription']))
        {
            $model->attributes=$_POST['Prescription'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models (For Doctors/Admins)
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Prescription');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Prescription('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Prescription']))
            $model->attributes=$_GET['Prescription'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * NEW ACTION: Patient's Personal Prescription List
     */
    public function actionMyPrescriptions()
    {
        $patientId = Yii::app()->user->id;

        $dataProvider = new CActiveDataProvider('Prescription', array(
            'criteria'=>array(
                'condition'=>'patient_account_id=:pid',
                'params'=>array(':pid'=>$patientId),
                'with'=>array('doctorAccount.user'), // Load doctor name
                'order'=>'date_of_prescription DESC',
            ),
        ));

        $this->render('myPrescriptions',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     */
    public function loadModel($id)
    {
        $model=Prescription::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='prescription-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}