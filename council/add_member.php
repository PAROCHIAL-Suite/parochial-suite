<?php

include '../config/connection.php';

// Get group ID from URL
$groupID = isset($_GET['id']) ? $_GET['id'] : '';

// Handle form submission
if (isset($_POST['add_member'])) {
	// Sanitize inputs
	$group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
	$group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
	$designation = mysqli_real_escape_string($conn, $_POST['designation']);
	$nominated_elected = mysqli_real_escape_string($conn, $_POST['nominated_elected']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
	$apc_member = mysqli_real_escape_string($conn, $_POST['apc_member']);

	// Prevent duplicate: check if same member already exists in this group
	$dup_sql = "SELECT * FROM council_member 
        WHERE groupID = '$group_id' 
        AND name = '$group_name' 
        AND designation = '$designation'
        AND stationID = '$STATION_CODE'
        LIMIT 1";
	$dup_result = $conn->query($dup_sql);

	if ($dup_result && $dup_result->num_rows > 0) {
		echo "<script>alert('This member already exists in this group.');</script>";
	} else {
		$sql = "INSERT INTO council_member 
            (stationID, groupID, name, gender, contact_no, designation, nominated_elected, remarks, apc_member) 
            VALUES 
            ('$STATION_CODE', '$group_id', '$group_name', '$gender', '$contact_no', '$designation', '$nominated_elected', '$remarks', '$apc_member')";
		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('New group member created successfully');</script>";
			echo "<script>window.location.href='add_member.php?id=$group_id';</script>";
			exit;
		} else {
			echo "<script>alert('Error: " . addslashes(mysqli_error($conn)) . "');</script>";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialui.css">
	<title>Add Group Member</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
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

	<form id="addNewPriestForm"
		action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . urlencode($groupID); ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Group ID: <?php echo htmlspecialchars($groupID); ?></h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">GROUP ID</label>
					<input type="text" name="group_id" value="<?php echo htmlspecialchars($groupID); ?>" readonly>
				</div>
				<div class="form-group">
					<label for="">APC Member</label>
					<select name="apc_member" required>
						<option hidden>--</option>
						<option value="No" selected>No</option>
						<option value="Yes">Yes</option>
					</select>
				</div>
				<div></div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">NAME</label>
					<input type="text" name="group_name" required>
				</div>
				<div class="form-group">
					<label for="">GENDER</label>
					<select name="gender">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
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
						<option value="Member" selected>Member</option>
						<option value="President">President</option>
						<option value="Vice President">Vice President</option>
						<option value="Secretary">Secretary</option>
						<option value="Treserur">Treserur</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">NOMINATED/ELECTED</label>
					<select name="nominated_elected">
						<option hidden>--</option>
						<option value="Nomination">Nomination</option>
						<option value="Elected">Elected</option>
						<option value="Ex Officio">Ex Officio</option>
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
				<button type="button" class="btn-secondary" onclick="location.reload()">
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
									<td><?php echo htmlspecialchars($rows['start_date'] . "-" . $rows['end_date']); ?></td>
									<td><?php echo htmlspecialchars($rows['group_name']); ?></td>
									<td><?php echo htmlspecialchars($rows['name']); ?></td>
									<td><?php echo htmlspecialchars($rows['designation']); ?></td>
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