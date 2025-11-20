<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo Yii::app()->createUrl('/site/index'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-clinic-medical"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Quali-Life</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item <?php echo (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo Yii::app()->createUrl('/site/index'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if (!Yii::app()->user->isGuest): ?>

                <?php if ($this->isSuperAdmin()): ?>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">Administration</div>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/account/admin', array('type'=>3)); ?>">
                            <i class="fas fa-fw fa-user-md"></i>
                            <span>Manage Doctors</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/account/admin', array('type'=>2)); ?>">
                            <i class="fas fa-fw fa-user-shield"></i>
                            <span>Manage Admins</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/account/admin', array('type'=>4)); ?>">
                            <i class="fas fa-fw fa-user-injured"></i>
                            <span>Manage Patients</span>
                        </a>
                    </li>

                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">System</div>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/auditLog/admin'); ?>">
                            <i class="fas fa-fw fa-list-alt"></i>
                            <span>Audit Log</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDev" aria-expanded="true" aria-controls="collapseDev">
                            <i class="fas fa-fw fa-cogs"></i>
                            <span>Developer</span>
                        </a>
                        <div id="collapseDev" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Dev Tools:</h6>
                                <a class="collapse-item" href="<?php echo Yii::app()->createUrl('/account/admin'); ?>">All Accounts</a>
                                <a class="collapse-item" href="<?php echo Yii::app()->createUrl('/specialization/admin'); ?>">Specializations</a>
                                <a class="collapse-item" href="<?php echo Yii::app()->createUrl('/gii'); ?>">Gii Tool</a>
                            </div>
                        </div>
                    </li>
                
                <?php elseif ($this->isDoctor()): ?>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">Practice</div>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/doctorSchedule/mySchedule'); ?>">
                            <i class="fas fa-fw fa-calendar-alt"></i>
                            <span>My Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/user/admin', array('role'=>'patient')); ?>">
                            <i class="fas fa-fw fa-users"></i>
                            <span>My Patients</span>
                        </a>
                    </li>

                <?php elseif ($this->isAdmin()): ?>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">Clinic Ops</div>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/appointment/calendar'); ?>">
                            <i class="fas fa-fw fa-calendar"></i>
                            <span>Appt. Calendar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/user/admin', array('role'=>'patient')); ?>">
                            <i class="fas fa-fw fa-address-book"></i>
                            <span>Patient Records</span>
                        </a>
                    </li>

                <?php elseif ($this->isPatient()): ?>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">My Health</div>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/appointment/book'); ?>">
                            <i class="fas fa-fw fa-plus-circle"></i>
                            <span>Book Appointment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/appointment/myAppointments'); ?>">
                            <i class="fas fa-fw fa-history"></i>
                            <span>History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/prescription/myPrescriptions'); ?>">
                            <i class="fas fa-fw fa-pills"></i>
                            <span>Prescriptions</span>
                        </a>
                    </li>
                <?php endif; ?>
            
            <?php else: ?>
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo Yii::app()->createUrl('/site/login'); ?>">
                        <i class="fas fa-fw fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </li>
            <?php endif; ?>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo !Yii::app()->user->isGuest ? CHtml::encode(Yii::app()->user->name) : 'Guest'; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo Yii::app()->theme->baseUrl; ?>/img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <?php if(!Yii::app()->user->isGuest): ?>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                <?php else: ?>
                                    <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('/site/login'); ?>">
                                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Login
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">

                    <?php echo $content; ?>

                </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->name); ?></span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('/site/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sb-admin-2.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/vendor/chart.js/Chart.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/demo/chart-pie-demo.js"></script>

</body>

</html>