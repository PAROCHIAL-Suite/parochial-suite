<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Group Member</title>
</head>

<body>
	<?php
	include "../config/connection.php";
	$memberID = $_GET['mem_id'];
	$grpID = isset($_GET['groupID']) ? $_GET['groupID'] : '';
	$sql = "SELECT * FROM council_member WHERE ID = '$memberID' AND stationID = '$STATION_CODE'";
	$result = $conn->query($sql);
	$name = $gender = $designation = $contact_no = $remarks = $elected_nominated = '';
	if ($rows = $result->fetch_assoc()) {
		$name = $rows['name'];
		$gender = $rows['gender'];
		$designation = $rows['designation'];
		$contact_no = $rows['contact_no'];
		$remarks = $rows['remarks'];
		$elected_nominated = $rows['nominated_elected'];
	}

	if (isset($_POST['delete_member'])) {
		$memberID = $_GET['mem_id'];
		$sql = "DELETE FROM council_member WHERE ID = '$memberID' AND stationID = '$STATION_CODE'";
		if ($conn->query($sql)) {
			echo "<script>alert('Member deleted successfully.'); window.location.href='member_list.php';</script>";
			exit;
		} else {
			echo "<script>alert('Error deleting member: " . addslashes($conn->error) . "');</script>";
		}
	}


	include '../nav/global_nav.php';
	?>
	<br><br>
	<div class="pageName">
		<h3>EDIT COUNCIL MEMBERS</h3>
	</div>
	<br>
	<div class="container-widgets">
		<div>
			<div>

				<form class="parochial-form" method="post"
					action="edit_c_member.php?mem_id=<?php echo $memberID; ?>&group=<?php echo $grpID; ?>">

					<div class="form-section">
						<div class="widget-header">
							<h3>Edit Group Member <span
									style="font-size:0.7em;color:var(--accent-color);">#<?php echo htmlspecialchars($memberID); ?></span>
							</h3>
						</div>

						<div class="form-grid">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>"
									required>
							</div>
							<div class="form-group">
								<label for="gender">Gender</label>
								<select name="gender" id="gender" required>
									<option value="" disabled <?php if (!$gender)
										echo 'selected'; ?>>Select</option>
									<option value="Male" <?php if ($gender == "Male")
										echo "selected"; ?>>Male</option>
									<option value="Female" <?php if ($gender == "Female")
										echo "selected"; ?>>Female
									</option>
								</select>
							</div>
							<div class="form-group">
								<label for="contact_no">Contact No.</label>
								<input type="text" name="contact_no" id="contact_no"
									value="<?php echo htmlspecialchars($contact_no); ?>">
							</div>
						</div>
						<div class="form-grid">
							<div class="form-group">
								<label for="designation">Designation</label>
								<select name="designation" id="designation" required>
									<option value="" disabled <?php if (!$designation)
										echo 'selected'; ?>>Select
									</option>
									<option value="Member" <?php if ($designation == "Member")
										echo "selected"; ?>>Member
									</option>
									<option value="President" <?php if ($designation == "President")
										echo "selected"; ?>>
										President</option>
									<option value="Vice President" <?php if ($designation == "Vice President")
										echo "selected"; ?>>Vice President</option>
									<option value="Secretary" <?php if ($designation == "Secretary")
										echo "selected"; ?>>
										Secretary</option>
									<option value="Treserur" <?php if ($designation == "Treserur")
										echo "selected"; ?>>
										Treserur</option>
									<option value="Ex Officio" <?php if ($designation == "Ex Officio")
										echo "selected"; ?>>Ex Officio</option>
								</select>
							</div>
							<div class="form-group">
								<label for="elected_nominated">Nominated/Elected</label>
								<select name="nominated_elected" id="nominated_elected" required>
									<option value="" disabled <?php if (!$elected_nominated)
										echo 'selected'; ?>>Select
									</option>
									<option value="Nomination" <?php if ($elected_nominated == "Nomination")
										echo "selected"; ?>>Nomination</option>
									<option value="Elected" <?php if ($elected_nominated == "Elected")
										echo "selected"; ?>>Elected</option>
									<option value="Ex Officio" <?php if ($elected_nominated == "Ex Officio")
										echo "selected"; ?>>Ex Officio</option>
								</select>
							</div>
							<div class="form-group">
								<label for="remarks">Remarks</label>
								<input type="text" name="remarks" id="remarks"
									value="<?php echo htmlspecialchars($remarks); ?>">
							</div>
						</div>
					</div>
					<div class="form-header">
						<div class="form-actions">
							<button type="submit" class="btn-primary" name="add_group_member" id="saveFrm">
								<i class="fas fa-save"></i> Update
							</button>


							<button type="button" class="btn-danger " onclick="confirmDelete();"
								style="text-align: center; width: 80px;">
								Delete
							</button>
						</div>
					</div>
				</form>

				<!-- Add this form just before </form> to handle deletion -->
				<form id="deleteMemberForm" method="post" action="">
					<input type="hidden" name="delete_member" value="1">
				</form>

				<script>
					function confirmDelete() {
						if (confirm('Are you sure you want to delete this member? This action cannot be undone.')) {
							document.getElementById('deleteMemberForm').submit();
						}
					}
				</script>
			</div>
		</div>
	</div>
</body>

</html>