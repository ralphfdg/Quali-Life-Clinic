<?php
/* @var $this SiteController */
/* @var $totalDoctors integer */
/* @var $totalPatients integer */
/* @var $totalAppointmentsMonth integer */
/* @var $earningsData array */
/* @var $specializationTally array */

$this->pageTitle=Yii::app()->name . ' - Super Admin Dashboard';
?>

<h1>Super Admin Dashboard</h1>

<hr>
<h3>Key Stats (Month)</h3>

<div style="display: flex; justify-content: space-around;">
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $totalDoctors; ?></h2>
		<p>Total Doctors</p>
	</div>
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $totalPatients; ?></h2>
		<p>Total Patients</p>
	</div>
	<div style="text-align: center; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
		<h2><?php echo $totalAppointmentsMonth; ?></h2>
		<p>Total Appointments (This Month)</p>
	</div>
</div>

<hr>
<h3>Earnings Report (Last 30 Days)</h3>
<p>
	<?php
	// This will render a simple chart.
	// We are formatting the data for Yii's CChartWidget (you may need to install it)
	// For simplicity, we'll just show the raw data for now.
	
	if (!empty($earningsData)) {
		echo "<ul>";
		foreach($earningsData as $data) {
			echo "<li>" . $data['day'] . ": $" . number_format($data['total'], 2) . "</li>";
		}
		echo "</ul>";
	} else {
		echo "<p>No earnings data for the last 30 days.</p>";
	}
	?>
</p>

<hr>
<h3>Doctor Specialization Tally</h3>
<?php
if (!empty($specializationTally)) {
	echo "<ul>";
	foreach($specializationTally as $data) {
		echo "<li>" . $data['specialization_name'] . ": " . $data['count'] . "</li>";
	}
	echo "</ul>";
} else {
	echo "<p>No doctors with specializations found.</p>";
}
?>