<?php
/* @var $this ReportController */
/* @var $data Appointment[] */
?>

<div class="container mt-5">

    <div class="row mb-4 border-bottom pb-3">
        <div class="col-2 text-center">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" style="width: 80px; height: auto;">
        </div>
        <div class="col-8 text-center">
            <h2 class="font-weight-bold mb-0 text-uppercase text-gray-900">Quali-Life Medical Clinic</h2>
            <p class="mb-0 text-gray-600">11930, Ubas St, Mabalacat City, Pampanga</p>
            <p class="small text-gray-600">Contact: 0923 940 6809</p>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="text-center mb-4">
        <h4 class="font-weight-bold text-uppercase">Patient Visit History</h4>
        <p class="text-muted">
            Period: <strong><?php echo date('M j, Y', strtotime($startDate)); ?></strong>
            to <strong><?php echo date('M j, Y', strtotime($endDate)); ?></strong>
        </p>
    </div>

    <?php if ($patientId > 0 && !empty($data)): ?>

        <?php
        // Safely get the patient user profile
        $pUser = null;
        if (isset($data[0]->patientAccount->user)) {
            $pUser = $data[0]->patientAccount->user;
        }
        ?>

        <?php if ($pUser): ?>
            <div class="card mb-4 border-0">
                <div class="card-body bg-light p-3 rounded">
                    <div class="row">
                        <div class="col-6">
                            <strong>Patient Name:</strong>
                            <?php echo CHtml::encode($pUser->firstname . ' ' . $pUser->lastname); ?>
                        </div>
                        <div class="col-3">
                            <strong>Age:</strong>
                            <?php echo date_diff(date_create($pUser->dob), date_create('today'))->y; ?>
                        </div>
                        <div class="col-3">
                            <strong>Gender:</strong>
                            <?php echo ($pUser->gender == 1 ? 'Male' : 'Female'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th width="15%">Date</th>
                <th width="20%">Doctor</th>
                <th>Diagnosis / Assessment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted p-4">No records found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td>
                            <?php echo date('M j, Y', strtotime($row->schedule_datetime)); ?><br>
                            <small class="text-muted"><?php echo date('g:i A', strtotime($row->schedule_datetime)); ?></small>
                        </td>

                        <td>
                            <?php echo isset($row->doctorAccount->user) ? "Dr. " . $row->doctorAccount->user->lastname : 'Unknown'; ?>
                        </td>

                        <td>
                            <?php
                            // Check for SOAP Notes safely
                            if (!empty($row->consultationRecords) && isset($row->consultationRecords[0])) {
                                echo CHtml::encode($row->consultationRecords[0]->assessment);
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            $status = isset($row->appointmentStatus) ? $row->appointmentStatus->status_name : '-';
                            echo ($row->appointment_status_id == 4) ? '<span class="text-success font-weight-bold">Completed</span>' : $status;
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="row mt-5 no-print">
        <div class="col-12 text-center small text-muted">
            Generated on <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>

</div>