<?php

class BirthHistoryController extends Controller
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
            // Allow Admin/SuperAdmin/Doctor to Create, View, Update, and Delete patient records.
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
     * Creates a new model. Accepts patient account_id via GET.
     */
    public function actionCreate()
    {
        $model = new BirthHistory;

        // Automatically link the record to the patient if account_id is passed in the URL
        if (isset($_GET['account_id'])) {
            $model->account_id = (int)$_GET['account_id'];
        }

        if (isset($_POST['BirthHistory'])) {
            $model->attributes = $_POST['BirthHistory'];
            if ($model->save())
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); // Redirect back to the consolidated view
        }

        $this->render('create', array(
            'model' => $model,
        ));
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
                $this->redirect(array('/patientRecord/view', 'id' => $model->account_id)); // Redirect back to the consolidated view
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given.
     * Use this when navigating *directly* to the BirthHistory record ID.
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = BirthHistory::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    /**
     * Manages all models (useful if you want a filterable list view).
     */
    public function actionAdmin()
    {
        $model = new BirthHistory('search');
        $model->unsetAttributes();
        if (isset($_GET['BirthHistory']))
            $model->attributes = $_GET['BirthHistory'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
}