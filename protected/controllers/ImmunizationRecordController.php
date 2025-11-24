<?php

class ImmunizationRecordController extends Controller
{
    public $layout = '//layouts/column2';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            // Allow Admin/SuperAdmin/Doctor to Create, View, and Update.
            array(
                'allow',
                'actions' => array('create', 'view', 'update', 'admin'),
                'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin() || Yii::app()->controller->isDoctor()',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new ImmunizationRecord.
     */
    public function actionCreate()
    {
        $model = new ImmunizationRecord;
        if (isset($_GET['account_id'])) {
            $model->account_id = (int)$_GET['account_id'];
        }

        if (isset($_POST['ImmunizationRecord'])) {
            $model->attributes = $_POST['ImmunizationRecord'];
            if ($model->save())
                // Redirect back to the patient's consolidated records view
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); 
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * Updates a particular model.
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['ImmunizationRecord'])) {
            $model->attributes = $_POST['ImmunizationRecord'];
            if ($model->save())
                // Redirect back to the patient's consolidated records view
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); 
        }

        $this->render('update', array('model' => $model));
    }

    public function loadModel($id)
    {
        $model = ImmunizationRecord::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    // actionView, actionAdmin and performAjaxValidation methods would also be included here if used.
}