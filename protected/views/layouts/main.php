<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <style>
        /* ... existing Primary/Secondary colors ... */

        /* --- FIX FOR EXPLODING FIELDS --- */

        /* 1. Force Input Fields to stay normal size */
        input.error,
        select.error,
        textarea.error {
            border: 1px solid #e74a3b !important;
            /* Just red border */
            background-color: #fff !important;
            /* Keep white background */
            color: #6e707e !important;
            /* Keep text gray */
            width: 100% !important;
            /* Force width to container */
            padding: .375rem .75rem !important;
            /* Standard Bootstrap padding */
            font-size: 1rem !important;
            /* Standard Font size */
            height: auto !important;
            /* Prevent height explosion */
            box-shadow: none !important;
            /* Remove weird shadows */
        }

        /* 2. Stop Labels from turning into huge red text */
        label.error {
            color: #858796 !important;
            /* Keep standard gray label color */
            font-size: 100% !important;
            /* Stop font growing */
            font-weight: 400 !important;
            display: inline-block !important;
            margin-bottom: .5rem;
        }

        /* 3. The actual Error Text (The message below the input) */
        .errorMessage {
            color: #e74a3b !important;
            /* Red text */
            font-size: 0.8rem !important;
            /* Small text */
            margin-top: 0.25rem !important;
            display: block !important;
            line-height: 1.2 !important;
            /* Tight line height */
        }

        /* 4. Hide the Global Error Summary if it messes up the top of the form */
        /* Optional: Uncomment if you prefer only field-level errors */
        /* .errorSummary { display: none !important; } */

        /* --- PRIMARY COLOR (Green: #02700d) --- */

        /* Sidebar & Backgrounds */
        .bg-gradient-primary {
            background-color: #02700d;
            background-image: linear-gradient(180deg, #02700d 10%, #025d0b 100%);
            background-size: cover;
        }

        /* Buttons */
        .btn-primary {
            background-color: #02700d;
            border-color: #02700d;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #025d0b !important;
            border-color: #025d0b !important;
        }

        /* Text & Icons */
        .text-primary {
            color: #02700d !important;
        }

        /* Card Borders */
        .border-left-primary {
            border-left: .25rem solid #02700d !important;
        }

        /* --- SECONDARY COLOR (Gold: #d0be02) --- */

        /* Backgrounds */
        .bg-gradient-secondary {
            background-color: #d0be02;
            background-image: linear-gradient(180deg, #d0be02 10%, #bba002 100%);
        }

        /* Buttons */
        .btn-secondary {
            background-color: #d0be02;
            border-color: #d0be02;
            color: #fff;
            /* White text for contrast */
        }

        .btn-secondary:hover {
            background-color: #bba002 !important;
            border-color: #bba002 !important;
        }

        /* Text */
        .text-secondary {
            color: #d0be02 !important;
        }

        /* Card Borders */
        .border-left-secondary {
            border-left: .25rem solid #d0be02 !important;
        }

        /* Pagination Active State */
        .page-item.active .page-link {
            background-color: #02700d;
            border-color: #02700d;
        }

        /* --- DANGER (Deep Red) --- */
        .btn-danger {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .btn-danger:hover {
            background-color: #a93226 !important;
            border-color: #a93226 !important;
        }

        .text-danger {
            color: #c0392b !important;
        }

        .border-left-danger {
            border-left: .25rem solid #c0392b !important;
        }

        /* --- WARNING (Burnt Orange) --- */
        /* We use Orange here because your Secondary color is already Yellow/Gold */
        .btn-warning {
            background-color: #f39c12;
            border-color: #f39c12;
            color: #fff;
            /* White text for readability */
        }

        .btn-warning:hover {
            background-color: #e67e22 !important;
            border-color: #e67e22 !important;
            color: #fff;
        }

        .text-warning {
            color: #f39c12 !important;
        }

        .border-left-warning {
            border-left: .25rem solid #f39c12 !important;
        }

        /* --- INFO (Medical Teal) --- */
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496 !important;
            border-color: #138496 !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .border-left-info {
            border-left: .25rem solid #17a2b8 !important;
        }
    </style>
</head>

<body id="page-top">

    <?php
    // --- DYNAMIC SIDEBAR LOGIC WITH ICONS ---
    $sidebarMenu = array();

    // 1. SUPER ADMIN MENU
    if ($this->isSuperAdmin()) {
        $sidebarMenu = array(
            'Manage Secretaries' => array(
                'icon' => 'fa-user-nurse', // Nurse/Admin Icon
                'items' => array(
                    array('label' => 'Add Secretary', 'url' => array('/account/create', 'type' => 2)),
                    array('label' => 'List Secretaries', 'url' => array('/account/admin', 'type' => 2)),
                )
            ),

            'Manage Doctors' => array(
                'icon' => 'fa-user-md', // Doctor Icon
                'items' => array(
                    array('label' => 'Add Doctor', 'url' => array('/account/create', 'type' => 3)),
                    array('label' => 'List Doctors', 'url' => array('/account/admin', 'type' => 3)),
                )
            ),


            'Manage Patients' => array(
                'icon' => 'fa-users', // Users Group Icon
                'items' => array(
                    array('label' => 'Add Patient', 'url' => array('/account/create', 'type' => 4)),
                    array('label' => 'List Patients', 'url' => array('/account/admin', 'type' => 4)),
                )
            ),

            array('label' => 'Generate Report', 'icon' => 'fa-chart-line', 'url' => array('/report/index')),
            array('label' => 'Audit Log', 'icon' => 'fa-clipboard-list', 'url' => array('/auditlog/admin')),

            // Settings
            array('label' => 'Settings', 'divider' => true),
            array('label' => 'My Account', 'icon' => 'fa-user-circle', 'url' => array('/account/view', 'id' => Yii::app()->user->id)),

            // Config
            array('label' => 'System Config', 'itemOptions' => array('class' => 'sidebar-header'), 'url' => false),
            array('label' => 'Manage Schedules', 'icon' => 'fa-calendar-alt', 'url' => array('/doctorSchedule/admin')),
            array('label' => 'Specializations', 'icon' => 'fa-stethoscope', 'url' => array('/specialization/admin')),
        );
    }

    // 2. ADMIN (SECRETARY) MENU
    else if ($this->isAdmin()) {
        $sidebarMenu = array(
            array('label' => 'Secretary Controls', 'itemOptions' => array('class' => 'sidebar-header')),
            array('label' => 'Appointment Calendar', 'icon' => 'fa-calendar-check', 'url' => array('/appointment/calendar')),
            'Manage Doctors' => array(
                'icon' => 'fa-user-md', // Doctor Icon
                'items' => array(
                    array('label' => 'Add Doctor', 'url' => array('/account/create', 'type' => 3)),
                    array('label' => 'List Doctors', 'url' => array('/account/admin', 'type' => 3)),
                )
            ),
            'Manage Patients' => array(
                'icon' => 'fa-users', // Users Group Icon
                'items' => array(
                    array('label' => 'Add Patient', 'url' => array('/account/create', 'type' => 4)),
                    array('label' => 'List Patients', 'url' => array('/account/admin', 'type' => 4)),
                )
            ),
            array('label' => 'My Account', 'icon' => 'fa-user-circle', 'url' => array('/account/view', 'id' => Yii::app()->user->id)),
        );
    }

    // 3. DOCTOR MENU
    else if ($this->isDoctor()) {
        $sidebarMenu = array(
            array('label' => 'Doctor Menu', 'itemOptions' => array('class' => 'sidebar-header')),
            array('label' => 'Appointments', 'icon' => 'fa-list-alt', 'url' => array('/appointment/myQueue')),
            array('label' => 'History', 'icon' => 'fa-history', 'url' => array('/appointment/myHistory')),
            array('label' => 'My Schedule', 'icon' => 'fa-clock', 'url' => array('/doctorSchedule/mySchedule')),
            'Manage Patients' => array(
                'icon' => 'fa-users', // Users Group Icon
                'items' => array(
                    array('label' => 'Add Patient', 'url' => array('/account/create', 'type' => 4)),
                    array('label' => 'List Patients', 'url' => array('/account/admin', 'type' => 4)),
                )
            ),
            array('label' => 'My Account', 'icon' => 'fa-user-circle', 'url' => array('/account/update', 'id' => Yii::app()->user->id)),

        );
    }

    // 4. PATIENT MENU
    else if ($this->isPatient()) {
        $sidebarMenu = array(
            array('label' => 'Patient Menu', 'itemOptions' => array('class' => 'sidebar-header')),
            array('label' => 'Dashboard', 'icon' => 'fa-home', 'url' => array('/site/index')),
            array('label' => 'Book Now', 'icon' => 'fa-calendar-plus', 'url' => array('/appointment/book')),
            array('label' => 'My Appointments', 'icon' => 'fa-calendar-alt', 'url' => array('/appointment/myAppointments')),
            array('label' => 'Prescriptions', 'icon' => 'fa-file-prescription', 'url' => array('/prescription/myPrescriptions')),
            array('label' => 'My Account', 'icon' => 'fa-user', 'url' => array('/account/view', 'id' => Yii::app()->user->id)),
        );
    }

    if (!Yii::app()->user->isGuest && !empty($sidebarMenu)):
    ?>

        <div id="wrapper">

            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php">
                    <div class="sidebar-brand-icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" style="height: 40px; width: 40px; border-radius:50%; background:white;">
                    </div>
                    <div class="sidebar-brand-text mx-3">Quali-Life</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/index">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <hr class="sidebar-divider">

                <?php
                $navId = 0;
                foreach ($sidebarMenu as $key => $item):
                    $navId++;

                    // --- CASE A: COLLAPSIBLE MENU (e.g. Manage Doctors) ---
                    // We check if it has an 'items' key
                    if (is_array($item) && isset($item['items'])) {
                        $label = $key;
                        $icon = isset($item['icon']) ? $item['icon'] : 'fa-folder'; // Default icon if missing

                        echo '<li class="nav-item">';
                        echo CHtml::link('<i class="fas fa-fw ' . $icon . '"></i> <span>' . $label . '</span>', '#collapse' . $navId, array(
                            'class' => 'nav-link collapsed',
                            'data-toggle' => 'collapse',
                            'data-target' => '#collapse' . $navId,
                            'aria-expanded' => 'true',
                            'aria-controls' => 'collapse' . $navId,
                        ));

                        echo '<div id="collapse' . $navId . '" class="collapse" data-parent="#accordionSidebar">';
                        echo '<div class="bg-white py-2 collapse-inner rounded">';

                        foreach ($item['items'] as $subItem) {
                            $url = is_array($subItem['url']) ? $this->createUrl($subItem['url'][0], array_slice($subItem['url'], 1)) : $subItem['url'];
                            echo CHtml::link($subItem['label'], $url, array('class' => 'collapse-item'));
                        }

                        echo '</div></div></li>';
                    }

                    // --- CASE B: HEADERS & DIVIDERS ---
                    else if (is_array($item) && (isset($item['divider']) || isset($item['itemOptions']))) {
                        if (isset($item['divider'])) {
                            echo '<hr class="sidebar-divider">';
                            echo '<div class="sidebar-heading">' . $item['label'] . '</div>';
                        } else {
                            echo '<hr class="sidebar-divider">';
                            echo '<div class="sidebar-heading">' . strip_tags($item['label']) . '</div>';
                        }
                    }

                    // --- CASE C: STANDARD SINGLE LINK ---
                    else if (isset($item['url']) && $item['url'] !== false) {
                        $icon = isset($item['icon']) ? $item['icon'] : 'fa-circle'; // Default icon
                        $url = is_array($item['url']) ? $this->createUrl($item['url'][0], array_slice($item['url'], 1)) : $item['url'];

                        echo '<li class="nav-item">';
                        echo CHtml::link('<i class="fas fa-fw ' . $icon . '"></i> <span>' . $item['label'] . '</span>', $url, array('class' => 'nav-link'));
                        echo '</li>';
                    }
                endforeach;
                ?>

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
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo Yii::app()->user->getState('displayName'); ?></span>
                                    <img class="img-profile rounded-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/undraw_profile.svg">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <?php
                                    echo CHtml::link('<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> My Account', array('/account/view', 'id' => Yii::app()->user->id), array('class' => 'dropdown-item'));
                                    echo '<div class="dropdown-divider"></div>';
                                    echo CHtml::link('<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout', '#logoutModal', array('class' => 'dropdown-item', 'data-toggle' => 'modal', 'data-target' => '#logoutModal'));
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="container-fluid">


                        <?php
                        foreach (Yii::app()->user->getFlashes() as $key => $message) {
                            echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
                        }
                        ?>

                        <?php echo $content; ?>
                    </div>
                </div>

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; <?php echo date('Y'); ?> Quali-Life. All Rights Reserved.</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <?php echo CHtml::link('Logout', array('/site/logout'), array('class' => 'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="container" id="page">
            <?php echo $content; ?>
        </div>
    <?php endif; ?>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sb-admin-2.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/chart.js/Chart.min.js"></script>

</body>

</html>