<?php

class ImmunizationRecordController extends Controller
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
            // Allow Admin/SuperAdmin/Doctor to Manage patient records.
            array(
                'allow',
                'actions' => array('create', 'view', 'update', 'delete', 'admin'),
                'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin() || Yii::app()->controller->isDoctor()',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a single ImmunizationRecord model.
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new ImmunizationRecord. Accepts patient account_id via GET.
     */
    public function actionCreate()
    {
        $model = new ImmunizationRecord;

        // Automatically link the record to the patient if account_id is passed
        if (isset($_GET['account_id'])) {
            $model->account_id = (int)$_GET['account_id'];
        }

        if (isset($_POST['ImmunizationRecord'])) {
            $model->attributes = $_POST['ImmunizationRecord'];
            if ($model->save())
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); // Redirect back to the consolidated view
        }

        $this->render('create', array(
            'model' => $model,
        ));
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
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); // Redirect back to the consolidated view
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     */
    public function actionDelete($id)
    {
        $account_id = $this->loadModel($id)->account_id;
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/patientRecord/view', 'id' => $account_id)); // Redirect back to the consolidated view
    }

    /**
     * Returns the data model based on the primary key given.
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = ImmunizationRecord::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}