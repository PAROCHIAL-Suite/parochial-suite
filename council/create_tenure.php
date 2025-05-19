<?php
include '../config/connection.php';
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['create_tenure'])) {
	$s_dt = $_POST['start_dt'];
	$e_dt = $_POST['end_dt'];

	$sql = "INSERT INTO council_master_table VALUES('','$STATION_CODE', '$s_dt', '$e_dt')";

	if (mysqli_query($conn, $sql)) {
		// echo "<script>alert('Tenure created...');</script>";	
	} else {
		echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>CREATE NEW TENURE</h3>
	</div>
	<br>

	<!-- form to add new priest -->
	<form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Tenure Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Pries Name">START YEAR</label>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_dt" required>
				</div>

				<div class="form-group">
					<label for="startYear">END YEAR</label>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="end_dt" required>
				</div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="create_tenure">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
		<br><br>
	</form>


	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 55%;">
				<div class="widget-header">
					<h3>List From Past Few Years</h3>
				</div>
				<div class="widget-content">
					<table class="data-table">
						<thead>
							<tr>
								<th>ACTIONS</th>
								<th>START DATE</th>
								<th>END DATE</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include '../config/connection.php';
							$sql = "SELECT * FROM council_master_table WHERE stationID = '$STATION_CODE'";
							$result = $conn->query($sql);

							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td>
										<a
											href="add_group.php?id=<?php echo $rows['ID']; ?>&s_date=<?php echo $rows['start_date']; ?>&e_date=<?php echo $rows['end_date']; ?>">Add
											Groups</a>
										<!-- <b>|</b>
										<a href="editTenure.php?tID=<?php echo $rows['ID']; ?>">Edit</a> -->
									</td>
									<td><?php echo $rows['start_date']; ?></td>
									<td><?php echo $rows['end_date']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>

</html>