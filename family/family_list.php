<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Report - FAMILY</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>FAMILY RECORDS</h3>
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
								<th onclick="sortTable(1);">FAMILY ID</th>
								<th onclick="sortTable(2);">AREA CODE</th>
								<th onclick="sortTable(3);">FAMILY NAME</th>
								<th>ADDRESS</th>
								<th onclick="sortTable(5);">CREATED ON</th>


							</tr>
						</thead>
						<tbody>
							<?php
							include '../config/connection.php';
							$sql = " SELECT * FROM family_master_table WHERE stationID = '$STATION_CODE'";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td>
										<a href="edit_family.php?id=<?php echo $rows['family_ID']; ?>">Edit</a>
										<b>|</b>
										<a href="view_family.php?id=<?php echo $rows['family_ID']; ?>">View</a>
									</td>
									<td><?php echo $rows['family_ID']; ?></td>
									<td><?php echo $rows['area_code']; ?></td>
									<td><?php echo $rows['family_name']; ?></td>
									<td><?php echo $rows['address']; ?></td>
									<td><?php echo $rows['registered_on']; ?></td>

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