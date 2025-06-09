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
		<h3>COUNCIL MEMBERS LIST</h3>
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
								<th width="8%">ACTION</th>
								<th width="10%">Tenure</th>
								<th width="10%">Group Name</th>
								<th width="10%">Name</th>
								<th width="5%">Gender</th>
								<th width="5%">Contact</th>
								<th width="10%">DESIGNATION</th>
								<th width="10%">Elected/Nominated</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include '../config/connection.php';
							$sql = "SELECT 
    cmt.ID AS term_id,
    cg.ID AS group_id,
    cm.ID AS member_id,
    cmt.start_date,
    cmt.end_date,
    cm.name, cm.contact_no, cm.nominated_elected, cm.gender,
    cm.designation,
    cg.ID as cgID,
    cg.group_name
FROM 
    council_master_table cmt
INNER JOIN 
    council_group cg ON cg.termID = cmt.ID AND cg.stationID = cmt.stationID
INNER JOIN 
    council_member cm ON cm.groupID = cg.ID AND cm.stationID = cg.stationID
WHERE 
    cmt.stationID = '$STATION_CODE'";

							$result = $conn->query($sql);
							if (!$result) {
								echo "<tr><td colspan='8' style='color:red;'>SQL Error: " . $conn->error . "</td></tr>";
							} else {
								while ($rows = $result->fetch_assoc()) {
									?>
									<tr>
										<td><a
												href="edit_member.php?mem_id=<?php echo $rows['member_id']; ?>&groupID=<?php echo $rows['group_id']; ?>">Edit</a>

										</td>
										<td><?php echo $rows['start_date'] . "-" . $rows['end_date']; ?></td>
										<td><?php echo $rows['group_name']; ?></td>
										<td><?php echo $rows['name']; ?></td>
										<td><?php echo $rows['gender']; ?></td>
										<td><?php echo $rows['contact_no']; ?></td>
										<td><?php echo $rows['designation']; ?></td>
										<td><?php echo $rows['nominated_elected']; ?></td>
									</tr>
									<?php
								}
							}

							?>
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