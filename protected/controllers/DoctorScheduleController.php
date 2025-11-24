<?php

class DoctorScheduleController extends Controller
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
            // 1. Admins/Super Admins: Full CRUD
            array(
                'allow',
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete'),
                'expression' => '$user->isSuperAdmin() || $user->isAdmin()', // Using fixed syntax
            ),

            // 2. Doctors: View, Create, and Update ONLY their OWN Schedule
            array(
                'allow',
                'actions' => array('index', 'view', 'mySchedule', 'create', 'update'), // Doctor can now 'create' and 'update'
                'expression' => '$user->isDoctor()', // Using fixed syntax
            ),

            array('deny', 'users' => array('*')),
        );
    }


    public function actionCreate()
    {
        $model = new DoctorSchedule;

        if (isset($_POST['DoctorSchedule'])) {
            $model->attributes = $_POST['DoctorSchedule'];

            // SECURITY FIX: If Doctor is logged in, auto-assign their ID, ignoring the form's dropdown (if visible)
            if (Yii::app()->user->isDoctor()) {
                $model->doctor_account_id = Yii::app()->user->id;
            }

            if ($model->save()) {
                // --- AUDIT LOG ---
                if (class_exists('AuditHelper')) {
                    AuditHelper::log('CREATE_SCHEDULE', 'tbl_doctor_schedule', $model->id, "Created schedule for Doctor ID: " . $model->doctor_account_id);
                }
                // --- Redirect to their personal schedule view ---
                $this->redirect(array('mySchedule'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // SECURITY FIX: Deny non-admin users from editing schedules that are not their own
        if (Yii::app()->user->isDoctor() && $model->doctor_account_id != Yii::app()->user->id) {
            throw new CHttpException(403, 'You are not authorized to edit this schedule.');
        }

        if (isset($_POST['DoctorSchedule'])) {
            $model->attributes = $_POST['DoctorSchedule'];
            if ($model->save()) {

                // --- AUDIT LOG ---
                if (class_exists('AuditHelper')) {
                    $days = array(0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat');
                    $dayName = isset($days[$model->day_of_week]) ? $days[$model->day_of_week] : $model->day_of_week;

                    AuditHelper::log('UPDATE_SCHEDULE', 'tbl_doctor_schedule', $model->id, "Updated schedule for " . $dayName);
                }
                // --- Redirect to their personal schedule view ---
                $this->redirect(array('mySchedule'));
            }
        }

        $this->render('update', array('model' => $model));
    }



    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // Audit log for delete (Optional but recommended)
        if (class_exists('AuditHelper')) {
            AuditHelper::log('DELETE_SCHEDULE', 'tbl_doctor_schedule', $id, 'Deleted by Admin');
        }

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin()
    {
        $model = new DoctorSchedule('search');
        $model->unsetAttributes();
        if (isset($_GET['DoctorSchedule']))
            $model->attributes = $_GET['DoctorSchedule'];

        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id)
    {
        // FIX: EAGER LOAD doctorAccount.user
        $model = DoctorSchedule::model()->with('doctorAccount.user')->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**
     * Displays the logged-in doctor's own schedule.
     */
    public function actionMySchedule()
    {
        $doctorId = Yii::app()->user->id;

        $criteria = new CDbCriteria;

        // CRITICAL FIX: The security check using $model is REMOVED, as filtering is done here.
        // We ensure the doctor only sees their own records.
        $criteria->compare('doctor_account_id', $doctorId);

        $criteria->order = 'day_of_week ASC, start_time ASC'; // Sort for readability

        $dataProvider = new CActiveDataProvider('DoctorSchedule', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));

        $this->render('mySchedule', array(
            'dataProvider' => $dataProvider,
        ));
    }


}
