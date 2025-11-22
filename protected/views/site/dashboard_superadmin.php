<?php

/* @var $this SiteController */

/* @var $totalDoctors integer */

/* @var $totalPatients integer */

/* @var $totalAppointmentsMonth integer */

/* @var $earningsData array */

/* @var $specializationTally array */



// NOTE: The $this->pageTitle is set in the calling index.php or controller.

// The <h1> and <hr> are removed, as they are now handled by the main.php layout.



// The $this->pageTitle should be set BEFORE this file is rendered, likely in SiteController::actionIndex()

?>



<div class="row">



    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-primary shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Doctors</div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalDoctors; ?></div>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-user-md fa-2x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-success shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Patients</div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPatients; ?></div>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-bed fa-2x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-info shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Appointments (This Month)</div>

                        <div class="row no-gutters align-items-center">

                            <div class="col-auto">

                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalAppointmentsMonth; ?></div>

                            </div>

                            <div class="col">

                                <div class="progress progress-sm mr-2">

                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-warning shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-comments fa-2x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="row">




    <div class="col-xl-4 col-lg-5">

        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">Doctor Specialization Tally</h6>

            </div>

            <div class="card-body">

                <?php

                if (!empty($specializationTally)):

                    $progressColors = ['bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-primary'];

                    $colorIndex = 0;

                    $totalSpecializations = array_sum(array_column($specializationTally, 'count'));



                    foreach ($specializationTally as $data):

                        // Calculate percentage for the progress bar

                        $percent = ($totalSpecializations > 0) ? round(($data['count'] / $totalSpecializations) * 100) : 0;

                        $colorClass = $progressColors[$colorIndex % count($progressColors)];

                        $colorIndex++;

                ?>

                        <h4 class="small font-weight-bold">

                            <?php echo CHtml::encode($data['specialization_name']); ?>

                            <span class="float-right"><?php echo $percent; ?>% (<?php echo $data['count']; ?>)</span>

                        </h4>

                        <div class="progress mb-4">

                            <div class="progress-bar <?php echo $colorClass; ?>" role="progressbar" style="width: <?php echo $percent; ?>%"

                                aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100"></div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <p>No doctors with specializations found.</p>

                <?php endif; ?>



                <hr class="sidebar-divider">

                <h6 class="font-weight-bold text-primary mb-3">Projects</h6>

                <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>

                <div class="progress progress-sm mb-2">

                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>

                </div>

            </div>

        </div>

    </div>

</div>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/chart-area-demo.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/chart-pie-demo.js"></script>