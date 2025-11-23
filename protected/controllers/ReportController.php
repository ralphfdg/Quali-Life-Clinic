<?php

class ReportController extends Controller
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
            array(
                'allow',
                'actions' => array('index', 'generate'),
                'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Step 1: The Filter Page
     * Select dates and patient to generate report for.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Step 2: The Printable Report
     * This renders a layout-less view optimized for printing.
     */
    public function actionGenerate()
    {
        // Get Inputs
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
        $endDate   = isset($_GET['end_date'])   ? $_GET['end_date']   : date('Y-m-t');
        $patientId = isset($_GET['patient_id']) ? (int)$_GET['patient_id'] : 0;

        // Build Query: Find Completed Appointments (Status = 4) or Consultations
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('date(t.schedule_datetime)', $startDate, $endDate);

        // If a specific patient is selected
        if ($patientId > 0) {
            $criteria->compare('t.patient_account_id', $patientId);
        }

        // Order by Date (Oldest to Newest for history)
        $criteria->order = 't.schedule_datetime ASC';

        // Load Relations
        $criteria->with = array(
            'patientAccount.user' => array('alias' => 'pUser'),
            'doctorAccount.user' => array('alias' => 'dUser'),
            'consultationRecords', // To get the diagnosis/notes
        );

        $data = Appointment::model()->findAll($criteria);

        // Use a special layout for printing (empty layout)
        $this->layout = '//layouts/print';

        $this->render('print_patient_history', array(
            'data' => $data,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'patientId' => $patientId
        ));
    }
}
