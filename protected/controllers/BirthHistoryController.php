<?php

class BirthHistoryController extends Controller
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
     * Displays a single patient's BirthHistory model.
     * @param integer $id the ID of the BirthHistory model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     */
    public function actionCreate()
    {
        $model = new BirthHistory;

        if (isset($_GET['account_id'])) {
            $model->account_id = (int)$_GET['account_id'];
        }

        if (isset($_POST['BirthHistory'])) {
            $model->attributes = $_POST['BirthHistory'];
            if ($model->save())
                // Redirect back to the patient's consolidated records view
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); 
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * Updates a particular model.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['BirthHistory'])) {
            $model->attributes = $_POST['BirthHistory'];
            if ($model->save())
                // Redirect back to the patient's consolidated records view
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); 
        }

        $this->render('update', array('model' => $model));
    }

    public function loadModel($id)
    {
        $model = BirthHistory::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    // actionAdmin and performAjaxValidation methods would also be included here if used.
}