<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Confirmation Record</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<h3>EDIT CONFIRMATION RECORD</h3>
	</div>
	<br>
	<?php
	include '../config/connection.php';
	$id = $_GET['id'];
	$sql = "SELECT * FROM confirmation WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
	$result = $conn->query($sql);
	if ($rows = $result->fetch_assoc()) {
		?>
		<form id="confirmation_form" method="post" action="edit_script.php?id=<?php echo $id; ?>" class="form-section">
			<div class="form-section-header">
				<h4>Details</h4>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>REGISTRATION NO.</label>
					<input type="text" name="reg_no" value="<?php echo htmlspecialchars($rows['reg_no']); ?>" readonly>
				</div>
				<div class="form-group">
					<label>NAME</label>
					<input type="text" name="name" value="<?php echo htmlspecialchars($rows['name']); ?>">
				</div>
				<div class="form-group">
					<label>SURNAME</label>
					<input type="text" name="surname" value="<?php echo htmlspecialchars($rows['surname']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>DATE OF BIRTH</label>
					<input type="text" name="dob" class="auto-format-date"
						value="<?php echo htmlspecialchars($rows['dob']); ?>" placeholder="dd/mm/yyyy">
				</div>
				<div class="form-group">
					<label>GENDER</label>
					<select name="gender">
						<option value="" hidden>Select</option>
						<option value="Male" <?php if ($rows['gender'] == "Male")
							echo "selected"; ?>>Male</option>
						<option value="Female" <?php if ($rows['gender'] == "Female")
							echo "selected"; ?>>Female</option>
					</select>
				</div>
				<div class="form-group">
					<label>FATHER'S NAME</label>
					<input type="text" name="father_name" value="<?php echo htmlspecialchars($rows['father_name']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>MOTHER'S NAME</label>
					<input type="text" name="mother_name" value="<?php echo htmlspecialchars($rows['mother_name']); ?>">
				</div>
				<div class="form-group">
					<label>BAPTISM DATE</label>
					<input type="text" class="auto-format-date" name="baptism_date"
						value="<?php echo htmlspecialchars($rows['baptism_date']); ?>">
				</div>
				<div class="form-group">
					<label>BAPTISM REGISTRATION NO.</label>
					<input type="text" name="baptism_reg" value="<?php echo htmlspecialchars($rows['baptism_reg_no']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>BAPTISM PARISH NAME</label>
					<input type="text" name="baptism_parish"
						value="<?php echo htmlspecialchars($rows['baptism_parish']); ?>">
				</div>
				<div class="form-group">
					<label>BAPTISM PARISH ADDRESS</label>
					<input type="text" name="p_address" value="<?php echo htmlspecialchars($rows['parish_address']); ?>">
				</div>
				<div class="form-group">
					<label>CHURCH OF CONFIRMATION</label>
					<input type="text" name="church_of_confirmation"
						value="<?php echo htmlspecialchars($rows['church_of_confirmation']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>DATE OF CONFIRMATION</label>
					<input type="text" class="auto-format-date" name="date"
						value="<?php echo htmlspecialchars($rows['date_of_confirmation']); ?>">
				</div>
				<div class="form-group">
					<label>SPONSOR</label>
					<input type="text" name="sponsor" value="<?php echo htmlspecialchars($rows['sponsor']); ?>">
				</div>
				<div class="form-group">
					<label>MINISTER'S NAME</label>
					<input type="text" name="minister_name" value="<?php echo htmlspecialchars($rows['minister']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>PARISH PRIEST</label>
					<input type="text" name="parish_priest" value="<?php echo htmlspecialchars($rows['parish_priest']); ?>">
				</div>
				<div></div>
				<div></div>
			</div>
			<div class="form-header">
				<div class="form-actions">
					<button type="submit" class="btn-primary" name="edit_eucharist_from" id="saveFrm">Save</button>
				</div>
			</div>
		</form>
	<?php } ?>
	<br><br>
</body>

</html>