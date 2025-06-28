<?php
include '../config/connection.php';
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['add_priest'])) {
	// code...
	$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
	$designation = mysqli_real_escape_string($conn, $_REQUEST['designation']);
	$start_date = $_REQUEST['start_date'];

	$end_date = $_REQUEST['end_date'];

	$sql = "INSERT INTO priest (ID, stationID, name, designation, start_date, end_date) 
	        VALUES ('', '$STATION_CODE', '$name', '$designation', '$start_date', '$end_date')";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('A name had been added successfully!');</script>";
	} else {
		echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
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
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>ADD A PRIEST</h3>
	</div>
	<br>

	<!-- form to add new priest -->
	<form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Basic Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Pries Name">Priest Name</label>
					<input type="text" id="name" name="name" required>
				</div>
				<div class="form-group">
					<label for="status">Designation</label>
					<select id="designation" name="designation" required>
						<option value="" hidden>Select</option>
						<option>Parish Priest</option>
						<option>Asst. Parish Priest</option>
						<option>Parish Priest (In-Charge)</option>
					</select>
				</div>
				<div class="form-group">
					<label for="startYear">Start Year</label>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_date" required>
				</div>
				<div class="form-group">
					<label for="endYear">End Year</label>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="end_date">
				</div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="add_priest">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
		<br><br>
	</form>

	<!-- Disply 10 priest -->
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
								<th>NAME</th>
								<th>DESIGNATION</th>
								<th>START DATE</th>
								<th>END DATE</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$sql = "SELECT * FROM priest WHERE stationID = '$STATION_CODE' ORDER BY start_date DESC LIMIT 5";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								$id = $rows['ID'];
								?>
								<tr>
									<td><a href="edit_priest.php?id=<?php echo $rows['ID']; ?>">Edit</a></td>
									<td><?php echo $rows['name']; ?></td>
									<td><?php echo $rows['designation']; ?></td>
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