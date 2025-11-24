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

        // 2. Load the Records (or CActiveDataProviders for lists)
        // Birth History is typically a single record
        $birthHistory = BirthHistory::model()->findByAttributes(array('account_id' => $id));

        // Immunization Records (list)
        $immunizationDataProvider = new CActiveDataProvider('ImmunizationRecord', array(
            'criteria' => array(
                'condition' => 'account_id = :accountID',
                'params' => array(':accountID' => $id),
                'order' => 'date DESC',
            ),
            'pagination' => array('pageSize' => 10),
        ));

        // CORRECTED for your ConsultationRecord model
        // Consultation Records (list)
        $consultationDataProvider = new CActiveDataProvider('ConsultationRecord', array(
            'criteria' => array(
                // FIXED: Use the correct column name from your model
                'condition' => 'patient_account_id = :accountID',
                'params' => array(':accountID' => $id),
                // FIXED: Use the correct date column from your model
                'order' => 'date_of_consultation DESC',
            ),
            'pagination' => array('pageSize' => 10),
        ));

        $this->render('view', array(
            'account' => $account,
            'birthHistory' => $birthHistory,
            'immunizationDataProvider' => $immunizationDataProvider,
            'consultationDataProvider' => $consultationDataProvider,
        ));
    }
}
