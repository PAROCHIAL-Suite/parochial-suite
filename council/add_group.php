<?php
require_once '../config/connection.php';
$id = $_GET['id'];
$s_date = $_GET['s_date'];
$e_date = $_GET['e_date'];

if (isset($_POST['create_group'])) {
	$group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
	$tenure_id = mysqli_real_escape_string($conn, $_POST['tenure_id']);
	$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

	$sql = "INSERT INTO council_group VALUES('','$tenure_id','$STATION_CODE','$group_name'
			)";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('New group created successfully');</script>";
		echo "<script>window.location.href='add_group.php?id=$tenure_id&s_date=$start_date&e_date=$end_date';</script>";
	} else {
		echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<script src="../print.js"></script>
	<title></title>

</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>CREATE NEW GROUP</h3>
	</div>
	<br>
	<!-- form to add new priest -->
	<form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>CREATE GROUP UNDER (<b><i><?php echo $s_date . "-" . $e_date; ?></i></b>)</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">GROUP NAME</label>
					<input type="text" name="group_name" placeholder="" required>
				</div>
				<div class="form-group">
					<label for="">TENURE ID</label>
					<input type="text" name="tenure_id" placeholder="" value="<?php echo $id; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="">START</label>
					<input type="text" name="start_date" placeholder="" value="<?php echo $s_date; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="">END</label>
					<input type="text" name="end_date" placeholder="" value="<?php echo $e_date; ?>" readonly>
				</div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="create_group">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>
	<br>
	<?php include '../simpleSearchBox.php'; ?>
	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 75%;">
				<div class="widget-content">
					<table class="data-table" id="table">
						<thead>
							<tr>
								<th>ACTIONS</th>
								<th>Tenure</th>
								<th>Name</th>

							</tr>
						</thead>
						<tbody>
							<?php

							include '../config/connection.php';
							$termID = $_GET['id'];
							$sql = "SELECT council_master_table.start_date, council_master_table.end_date,council_group.ID, council_group.group_name FROM council_master_table LEFT JOIN council_group ON council_master_table.ID = council_group.termID 
				WHERE council_group.termID = '$termID' AND council_master_table.stationID = '$STATION_CODE'";
							$result = $conn->query($sql);

							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td><a href="">Edit</a> <b>|</b>
										<a href="add_member.php?id=<?php echo $rows['ID']; ?>">Add Mmeber</a>
									</td>
									<td><?php echo $rows['start_date'] . "-" . $rows['end_date'];
									; ?></td>
									<td><?php echo $rows['group_name']; ?></td>

								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<script src="../js/search_script.js"></script>
	<script src="../js/export.js"></script>
</body>

</html>