<?php
include '../config/connection.php';
if (isset($_POST['add_member'])) {
	$group_name = $_POST['group_name'];
	$gender = $_POST['gender'];
	$contact_no = $_POST['contact_no'];
	$designation = $_POST['designation'];
	$nominated_elected = $_POST['nominated_elected'];
	$remarks = $_POST['remarks'];

	$group_id = $_POST['group_id'];

	$sql = "INSERT INTO council_member values('', '$STATION_CODE', '$group_id', '$group_name', '$gender', '$contact_no', '$designation', '$nominated_elected', '$remarks')";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('New group member created successfully');</script>";
		echo "<script>window.location.href='add_member.php?id=$group_id';</script>";
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
	<link rel="stylesheet" type="text/css" href="../css/parochialui.css">

	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php';
	$groupID = $_GET['id']; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%">
					<h3>ADD GROUP MEMBER</h3>
				</td>
			</tr>
		</table>
	</div>
	<br>

	<form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Group ID: <?php echo $groupID; ?></h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">GROUP ID</label>
					<input type="text" name="group_id" placeholder="" value="<?php echo $groupID; ?>" readonly>
				</div>
				<div></div>
				<div></div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">NAME</label>
					<input type="text" name="group_name" placeholder="" required>
				</div>

				<div class="form-group">
					<label for="">GENDER</label>
					<select name="gender">
						<option>Male</option>
						<option>Female</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">CONTACT NO.</label>
					<input type="text" name="contact_no">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">DESIGNATION</label>
					<select name="designation" required>
						<option hidden>--</option>
						<option selected>Member</option>
						<option>President</option>
						<option>Vice President</option>
						<option>Secretary</option>
						<option>Treserur</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">NOMINATED/ELECTED</label>
					<select name="nominated_elected">
						<option hidden>--</option>
						<option>Nomination</option>
						<option>Elected</option>
						<option>Ex Officio</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">REMARKS</label>
					<input type="text" name="remarks">
				</div>
			</div>

		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="add_member">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>


	</form>




	<br><br>
	<?php include '../simpleSearchBox.php'; ?>

	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 55%;">
				<div class="widget-content">
					<table class="data-table" id="table">
						<thead>
							<tr>
								<th width="5%">Tenure</th>
								<th width="10%">Group Name</th>
								<th width="10%">Name</th>
								<th width="10%">DESIGNATION</th>
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
								cm.name,
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
								cmt.stationID = '$STATION_CODE'  AND cg.ID = '$groupID' ORDER BY cg.ID DESC";

							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {

								?>
								<tr>
									<td><?php echo $rows['start_date'] . "-" . $rows['end_date']; ?></td>
									<td><?php echo $rows['group_name']; ?></td>
									<td><?php echo $rows['name']; ?></td>
									<td><?php echo $rows['designation']; ?></td>
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