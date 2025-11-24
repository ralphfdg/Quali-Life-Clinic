<?php
class PatientRecordController extends Controller
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
                'actions' => array('view'),
                'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin() || Yii::app()->controller->isDoctor()',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a unified view of all records for a specific patient account.
     * @param integer $id the ID of the Account (Patient)
     */
    public function actionView($id)
    {
        // 1. Load the Patient Account
        $account = Account::model()->with('user')->findByPk($id);
        if ($account === null || $account->account_type_id != 4) {
            throw new CHttpException(404, 'The requested patient record does not exist or is not a patient.');
        }

        // Birth History is typically a single record
        $birthHistory = BirthHistory::model()->findByAttributes(array('account_id' => $id));

        // Immunization Records (list) - NO status filter
        $immunizationDataProvider = new CActiveDataProvider('ImmunizationRecord', array(
            'criteria' => array(
                'condition' => 'account_id = :accountID', // NO status filter
                'params' => array(':accountID' => $id),
                'order' => 'date DESC',
            ),
            'pagination' => array('pageSize' => 10),
        ));

        // Consultation Records (list) - NO status filter (Uses your patient_account_id field)
        $consultationDataProvider = new CActiveDataProvider('ConsultationRecord', array(
            'criteria' => array(
                'condition' => 'patient_account_id = :accountID', // NO status filter
                'params' => array(':accountID' => $id),
                'order' => 'date_of_consultation DESC',
            ),
            'pagination' => array('pageSize' => 10),
        ));

        // --- NEW: Data Provider for Immunization Types (Definition List) ---
        $immunizationTypesDataProvider = new CActiveDataProvider('Immunization', array(
            'pagination' => array('pageSize' => 10),
            // 'criteria' => array('order' => 'immunization ASC'), // Optional sorting
        ));

        $this->render('view', array(
            'account' => $account,
            'birthHistory' => $birthHistory,
            'immunizationDataProvider' => $immunizationDataProvider,
            'consultationDataProvider' => $consultationDataProvider,
            'immunizationTypesDataProvider' => $immunizationTypesDataProvider, // Pass the new data provider
        ));
    }
}