<?php
include '../config/connection.php';

$duplicate_error = '';

if (isset($_POST['create_unit_code'])) {
	$area_name = trim($_POST['area_name']);
	$given_name = trim($_POST['given_name']);
	$area_code = trim($_POST['area_code']);

	// Check for duplicate area_name or area_code for this station
	$check_sql = "SELECT COUNT(*) as cnt FROM area_mapping WHERE (area_name = '$area_name' OR area_code = '$area_code') AND stationID = '$STATION_CODE'";
	$check_result = $conn->query($check_sql);
	$check_row = $check_result->fetch_assoc();

	if ($check_row['cnt'] > 0) {
		$duplicate_error = "Area Name or Area Code already exists for this station.";
	} else {
		$sql = "INSERT INTO area_mapping VALUES('','$STATION_CODE', '$area_name', '$given_name', '$area_code')";
		if (!mysqli_query($conn, $sql)) {
			$duplicate_error = "ERROR: $sql. " . mysqli_error($conn);
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>

<body>


	<!-- Include the global navigation bar -->
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>Area Mapping</h3>
	</div>
	<br>


	<!-- Display any error message for duplicate entries -->
	<?php if (!empty($duplicate_error)): ?>
		<div class="ps-note warning" id="duplicateWarning"
			style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px;">
			<?php echo $duplicate_error; ?>
			<button type="button"
				style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#b71c1c;"
				onclick="
				document.getElementById('duplicateWarning').style.display='none';
				var form = document.getElementById('areaMappingForm');
				if(form) {
					form.reset();
				}
			" title="Close and reload form">&times;</button>
		</div>
	<?php endif; ?>





	<!-- Form for baptism registration -->
	<form id="areaMappingForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Create Area</h3>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="area Name">AREA NAME</label>
					<input type="text" name="area_name" placeholder="" required>
				</div>
				<div class="form-group">
					<label for="Given Name">PATRON SAINT NAME</label>
					<input type="text" name="given_name" placeholder="">
				</div>
				<div class="form-group">
					<label for="area code">AREA CODE</label>
					<input type="text" name="area_code" placeholder="" required>
				</div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="create_unit_code">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>

	<br> <br>
	<?php include '../simpleSearchBox.php'; ?>
	<!-- Disply 10 priest -->
	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 55%;">
				<div class="widget-header">
					<h3>List From Past Few Years</h3>
				</div>
				<div class="widget-content">
					<table class="data-table" id="table">
						<thead>
							<tr>
								<th>ACTIONS</th>
								<th>AREA NAME</th>
								<th>GIVEN NAME</th>
								<th>AREA CODE</th>

							</tr>
						</thead>
						<tbody>
							<?php
							include '../config/connection.php';
							$sql = "SELECT * FROM area_mapping WHERE stationID = '$STATION_CODE'";
							$result = $conn->query($sql);

							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td><a href="edit_unit.php?unitID=<?php echo $rows['ID']; ?>">Edit</a> </td>
									<td><?php echo $rows['area_name']; ?></td>
									<td><?php echo $rows['given_name']; ?></td>
									<td><?php echo $rows['area_code']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



	<script src="../js/search_script.js"></script>
</body>

</html>