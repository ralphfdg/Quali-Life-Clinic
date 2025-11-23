<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name . ' - Clinic Overview';
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
                    <div class="col-auto"><i class="fas fa-user-md fa-2x text-gray-300"></i></div>
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
                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Appts (This Month)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalApptMonth; ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar-alt fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Appts (Today)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalApptToday; ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Appointments Activity (30 Days)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area"><canvas id="myAreaChart"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Doctor Specialties</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2"><canvas id="myPieChart"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Inject Chart Data
    var chartLabels = <?php echo $chartLabels; ?>;
    var chartData = <?php echo $chartData; ?>;
    var pieLabels = <?php echo $pieLabels; ?>;
    var pieData = <?php echo $pieData; ?>;

    document.addEventListener("DOMContentLoaded", function() {
        // Line Chart
        new Chart(document.getElementById("myAreaChart"), {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: "Appointments",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    data: chartData,
                }],
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            }
        });

        // Pie Chart
        new Chart(document.getElementById("myPieChart"), {
            type: 'doughnut',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieData,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                }],
            },
            options: {
                maintainAspectRatio: false,
                cutoutPercentage: 80
            }
        });
    });
</script>