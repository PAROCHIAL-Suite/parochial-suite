<?php
include '../config/connection.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Report - Baptism</title>
</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>ADD A PRIEST</h3>
	</div>
	<br>
	<?php include '../simpleSearchBox.php'; ?>
	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 80%;">
				<div class="widget-content">
					<table class="data-table" id="table" style="width: 100%;">
						<thead>
							<tr>
								<th>ACTIONS</th>
								<th onclick="sortTable(1);">Patient Name</th>
								<th onclick="sortTable(2);">Age</th>
								<th onclick="sortTable(3);">Gender</th>
								<th onclick="sortTable(4);">Contact No.</th>
								<th>Address</th>
								<th onclick="sortTable(5);">Date</th>
								<th onclick="sortTable(6);">Priest Name</th>
								<th>Remarks</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT * FROM anointing_of_the_sick WHERE stationID = '$STATION_CODE' ORDER BY date DESC, id DESC";
							$result = $conn->query($sql);
							if ($result && $result->num_rows > 0) {
								while ($rows = $result->fetch_assoc()) {
									?>
									<tr>
										<td>
											<a href="edit_sick.php?id=<?php echo $rows['id']; ?>">Edit</a>

										</td>

										<td><?php echo htmlspecialchars($rows['patient_name']); ?></td>
										<td><?php echo htmlspecialchars($rows['age']); ?></td>
										<td><?php echo htmlspecialchars($rows['gender']); ?></td>
										<td><?php echo htmlspecialchars($rows['contact_no']); ?></td>
										<td><?php echo htmlspecialchars($rows['address']); ?></td>
										<td><?php echo htmlspecialchars($rows['date']); ?></td>
										<td><?php echo htmlspecialchars($rows['priest_name']); ?></td>
										<td><?php echo htmlspecialchars($rows['remarks']); ?></td>
									</tr>
								<?php }
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<script src="../js/export.js"></script>
	<script src="../js/search_script.js"></script>
</body>

</html>