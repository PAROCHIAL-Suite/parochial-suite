<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Report - Members</title>
</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>MEMBERS RECORDS</h3>
	</div>
	<br>
	<?php include '../simpleSearchBox.php'; ?>

	<div class="container-widgets">
		<!-- Report Table Section -->
		<div class=" widget-row">
			<div class="widget table-widget" style="max-height: 80%;">
				<div class="widget-content">
					<table class="data-table" id="table" style="width: 100%;">
						<thead>
							<tr>
								<th>ACTION</th>
								<th onclick="sortTable(1);">Area</th>
								<th onclick="sortTable(2);">Status</th>
								<th onclick="sortTable(3);">Name</th>
								<th onclick="sortTable(4);">Gender</th>
								<th onclick="sortTable(5);">Address</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT * from family_members WHERE stationID = '$STATION_CODE' ORDER BY family_ID ASC";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td><a href="edit_member.php?id=<?php echo $rows['ID']; ?>">Edit</a>
										<!--|-->
										<!--<a href="view_member.php?famID=<?php echo $rows['family_ID']; ?>">View</a>-->
									</td>

									<td><?php echo $rows['area_code']; ?></td>

									<td><?php echo $rows['status']; ?></td>
									<td><?php echo $rows['name'] . " " . $rows['surname'];
									; ?></td>
									<td><?php echo $rows['gender']; ?></td>
									<td><?php echo $rows['address']; ?></td>

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