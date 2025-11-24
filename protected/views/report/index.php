<?php
/* @var $this ReportController */
$this->breadcrumbs = array('Reports');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Generate Reports</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 border-left-info">
                <h6 class="m-0 font-weight-bold text-info">Patient Visit History</h6>
            </div>
            <div class="card-body">

                <form method="GET" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php" target="_blank">
                    
                    <input type="hidden" name="r" value="report/generate">

                    <div class="form-group">
                        <label>Date Range</label>
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-01'); ?>" required>
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text">to</span>
                            </div>
                            <input type="date" name="end_date" class="form-control" value="<?php echo date('Y-m-t'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Filter by Patient (Optional)</label>
                        <?php
                        // Get list of patients
                        $patients = Account::model()->with('user')->findAll('account_type_id=4');
                        $list = CHtml::listData($patients, 'id', function ($p) {
                            return isset($p->user) ? $p->user->lastname . ', ' . $p->user->firstname : $p->username;
                        });

                        echo CHtml::dropDownList('patient_id', '', $list, array(
                            'empty' => '-- All Patients --',
                            'class' => 'form-control'
                        ));
                        ?>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-info btn-block">
                        <i class="fas fa-print mr-2"></i> Generate PDF / Print
                    </button>

                </form>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Instructions</h6>
            </div>
            <div class="card-body">
                <p>Select a date range and an optional patient to generate a formal visit history report.</p>
                <ul>
                    <li>Leaving "Patient" blank will show a summary of <strong>all</strong> clinic visits.</li>
                    <li>The report will open in a new tab.</li>
                    <li>Your browser's <strong>Print Dialog</strong> will open automatically.</li>
                    <li>Select <strong>"Save as PDF"</strong> in the printer destination options to download the file.</li>
                </ul>
            </div>
        </div>
    </div>
</div>