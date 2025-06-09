<?php

include '../config/connection.php';

// Get user role from DB using ref from cookie
$user_role = '';
if (isset($_COOKIE['userID'])) {
	$ref = mysqli_real_escape_string($conn, $_COOKIE['userID']);
	$role_result = $conn->query("SELECT role FROM users WHERE ID = '$ref' LIMIT 1");
	if ($role_result && $role_row = $role_result->fetch_assoc()) {
		$user_role = strtolower($role_row['role']);
	}
}

// Handle multi-delete
$delete_success = '';
if (isset($_POST['delete_selected']) && !empty($_POST['delete_ids'])) {
	$ids = array_map('mysqli_real_escape_string', array_fill(0, count($_POST['delete_ids']), $conn), $_POST['delete_ids']);
	$ids_list = "'" . implode("','", $ids) . "'";
	$sql = "DELETE FROM confirmation WHERE reg_no IN ($ids_list) AND stationID = '$STATION_CODE'";
	if ($conn->query($sql)) {
		$delete_success = "Selected records deleted successfully.";
	} else {
		$delete_success = "Failed to delete selected records.";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Report - CONFIRMATION</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>CONFIRMATION RECORDS</h3>
	</div>

	<div class="form-header">
		<div class="form-actions"></div>
	</div>
	<?php include '../simpleSearchBox.php'; ?>

	<div class="container-widgets">
		<!-- Report Table Section -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 79%;">
				<div class="widget-content">

					<table class="data-table" id="table" style="width: 100%;">
						<thead>
							<tr>

								<th>ACTION</th>
								<th onclick="sortTable(1);">REG. NO.</th>
								<th onclick="sortTable(2);">NAME</th>
								<th onclick="sortTable(3);">D.O.B</th>
								<th onclick="sortTable(4);">DATE OF CONFIRMATION</th>
								<th onclick="sortTable(5);">PARISH PRIEST</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT * from confirmation WHERE stationID = '$STATION_CODE'";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>

									<td>
										<a href="edit_confirmation.php?id=<?php echo $rows['reg_no']; ?>">Edit</a> |
										<a href="notify.php?id=<?php echo $rows['id'] ?>">Notify</a>
									</td>
									<td style="text-align: center;"><?php echo $rows['reg_no']; ?></td>
									<td><?php echo $rows['name'] . " " . $rows['surname']; ?></td>
									<td><?php echo $rows['dob']; ?></td>
									<td><?php echo $rows['date_of_confirmation']; ?></td>
									<td><?php echo $rows['parish_priest']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
		<!-- End of Report Table Section -->
	</div>
	<script src="../js/export.js"></script>
	<script src="../js/search_script.js"></script>

</body>

</html>