<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Report - Baptism</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>BAPTISM RECORDS</h3>
	</div>
	<br>
	<?php include '../simpleSearchBox.php'; ?>

	<div class="container-widgets">
		<!-- Report Table Section -->
		<div class=" widget-row">
			<div class="widget table-widget" style="max-height: 82.7%;">
				<div class="widget-content">
					<table class="data-table" id="table" style="width: 100%;">
						<thead>
							<tr>
								<th>ACTION</th>
								<th onclick="sortTable(1);">REG. NO.</th>
								<th onclick="sortTable(2)">NAME<span class="sort-icon"></span></th>
								<th onclick="sortTable(3);">DATE OF BIRTH</th>
								<th onclick="sortTable(4);">FATHER'S NAME</th>
								<th onclick="sortTable(5);">MOTHER'S NAME</th>
								<th onclick="sortTable(6);">FATHER'S OCCUPATION</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include "../config/connection.php";

							$sql = "SELECT * FROM baptism WHERE stationID = '$STATION_CODE' ";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td>
										<a href="btsm_certificate.php?id=<?php echo $rows['reg_no']; ?>"
											class="btn-link">View</a>
										<b>|</b>
										<a href="btsm_edit.php?id=<?php echo $rows['reg_no']; ?>" class="btn-link">Edit</a>
									</td>
									<td><?php echo $rows['reg_no']; ?></td>
									<td><?php echo $rows['name'] . " " . $rows['surname']; ?></td>
									<td><?php echo $rows['dob']; ?></td>
									<td><?php echo $rows['father_name']; ?></td>
									<td><?php echo $rows['mother_name']; ?></td>
									<td><?php echo $rows['father_occupation']; ?></td>
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



	</script>
</body>

</html>