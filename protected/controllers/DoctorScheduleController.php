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
            array('allow',
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete'),
                'expression' => 'Yii::app()->controller->isSuperAdmin() || Yii::app()->controller->isAdmin()',
            ),
            array('allow',
                'actions' => array('index', 'view', 'mySchedule'),
                'expression' => 'Yii::app()->controller->isDoctor()',
            ),
            array('deny', 'users' => array('*')),
        );
    }

    // ... (Keep helper functions like allowAdminAccess, loadModel, etc.) ...

    public function actionCreate()
    {
        $model = new DoctorSchedule;

        if (isset($_POST['DoctorSchedule'])) {
            $model->attributes = $_POST['DoctorSchedule'];
            if ($model->save()) {
                
                // --- AUDIT LOG ---
                if(class_exists('AuditHelper')) {
                    AuditHelper::log(
                        'CREATE_SCHEDULE', 
                        'tbl_doctor_schedule', 
                        $model->id, 
                        "Created schedule for Doctor ID: " . $model->doctor_account_id
                    );
                }
                // -----------------

                $this->redirect(array('admin')); 
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['DoctorSchedule'])) {
            $model->attributes = $_POST['DoctorSchedule'];
            if ($model->save()) {
                
                // --- AUDIT LOG ---
                if(class_exists('AuditHelper')) {
                    $days = array(0=>'Sun', 1=>'Mon', 2=>'Tue', 3=>'Wed', 4=>'Thu', 5=>'Fri', 6=>'Sat');
                    $dayName = isset($days[$model->day_of_week]) ? $days[$model->day_of_week] : $model->day_of_week;
                    
                    AuditHelper::log(
                        'UPDATE_SCHEDULE', 
                        'tbl_doctor_schedule', 
                        $model->id, 
                        "Updated schedule for " . $dayName
                    );
                }
                // -----------------

                $this->redirect(array('admin')); 
            }
        }

        $this->render('update', array('model' => $model));
    }

    // ... (Keep actionDelete, actionAdmin, loadModel, etc.) ...
    
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        
        // Audit log for delete (Optional but recommended)
        if(class_exists('AuditHelper')) {
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
        $model = DoctorSchedule::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Displays the logged-in doctor's own schedule.
     */
    public function actionMySchedule()
    {
        // Get the ID of the currently logged-in doctor
        $doctorId = Yii::app()->user->id;

        $criteria = new CDbCriteria;
        // Filter: Only show records for this doctor
        $criteria->compare('doctor_account_id', $doctorId);
        
        // Order: Sunday (0) to Saturday (6), then by Start Time
        $criteria->order = 'day_of_week ASC, start_time ASC';

        $dataProvider = new CActiveDataProvider('DoctorSchedule', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));

        $this->render('mySchedule', array(
            'dataProvider' => $dataProvider,
        ));
    }
}