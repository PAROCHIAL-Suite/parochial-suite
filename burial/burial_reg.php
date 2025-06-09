<?php
include '../config/connection.php';

// Get the last created date from the baptism table
$sql = "SELECT reg_no FROM burial WHERE stationID = '$STATION_CODE' ORDER BY created_on DESC LIMIT 1";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$lastCreated = $row['reg_no'];
} else {
	$lastCreated = "No records found";
}

// Insert a new burial record
if (isset($_POST['post_burial_frm'])) {
	$reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
	$date_of_death = mysqli_real_escape_string($conn, $_POST['date_of_death']);
	$date_of_burial = mysqli_real_escape_string($conn, $_POST['date_of_burial']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$cause_of_death = mysqli_real_escape_string($conn, $_POST['cause_of_death']);
	$source_of_info = mysqli_real_escape_string($conn, $_POST['source_of_info']);
	$grave_no = mysqli_real_escape_string($conn, $_POST['grave_no']);
	$minister_name = mysqli_real_escape_string($conn, $_POST['minister_name']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);




	$sql = "INSERT INTO burial (
        stationID, reg_no, date_of_death, date_of_burial, name, surname, dob, gender, address,
        cause_of_death, source_of_info, grave_no, minister_name, remarks
    ) VALUES (
        '$STATION_CODE', '$reg_no', '$date_of_death', '$date_of_burial', '$name', '$surname', '$dob', '$gender', '$address',
        '$cause_of_death', '$source_of_info', '$grave_no', '$minister_name', '$remarks'
    )";

	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('A new Burial record has been created.'); window.location.href=window.location.href;</script>";
		exit;
	} else {
		echo "<div style='color:red;'>ERROR: $sql<br>" . mysqli_error($conn) . "</div>";
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
	<title></title>
</head>

<body>
	<!-- Include the global navigation bar -->
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<!-- <a href="sacrament_search_index.php" class="" style="float: right; margin-right: 50px; ">
			<i class="fas fa-search"></i> Search - Baptism Reports
		</a> -->
		<h3>REGISTRATION OF BURIAL</h3>
	</div>
	<br>

	<!-- Error dialog include -->
	<?php include '../dialog/form_error_dialog.php'; ?>


	<div class="form-header">
		<div class="form-actions">
			<button type="submit" class="btn-primary" onclick="document.getElementById('post_bpt_frm').click()">
				<i class="fas fa-save"></i> Save
			</button>
			<button class="btn-secondary" onclick="location.reload()">
				<i class="fas fa-times"></i> Reset
			</button>
		</div>
		<div class="form-actions">
			<div class="">
				<label><b>Recent Transaction</b></label>
				<h4 style="color: var(--accent-color);"><span style="font-weight: normal; ">Reg. No.</span>
					<?php echo $lastCreated; ?></h4>
			</div>
		</div>
	</div>

	<form id="baptismFrom" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Registration Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Pries Name">REGISTRATION NUMBER</label>
					<input type="text" name="reg_no" placeholder="Number" required>
				</div>
				<div class="form-group">
					<label for="Pries Name">DATE OF DEATH</label>
					<input type="text" name="date_of_death" class="auto-format-date" placeholder="dd/mm/yyyy" required>
				</div>
				<div class="form-group">
					<label for="Pries Name">DATE OF BURIAL</label>
					<input type="text" name="date_of_burial" class="auto-format-date" placeholder="dd/mm/yyyy" required>
				</div>
			</div>

			<div class="form-section-header">
				<h3>Basic Information</h3>
			</div>
			<!-- NEW ROWS -->
			<div class="form-grid">
				<div class="form-group">
					<label for="Name">NAME</label>
					<input type="text" name="name">
				</div>
				<div class="form-group">
					<label for="Name">SURNAME</label>
					<input type="text" name="surname">
				</div>
				<div class="form-group">
					<label for="Name">DATE OF BIRTH</label>
					<input type="text" name="dob" class="auto-format-date" placeholder="dd/mm/yyyy">
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">GENDER</label>
					<select name="gender">
						<option value="" hidden required>Select</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<div class="form-group">
					<label for="Name">ADDRESS</label>
					<textarea id="address" rows="3" name="address"></textarea>
				</div>
				<div></div>
			</div>


			<div class="form-section-header">
				<h3> Information</h3>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">CASUE OF DEATH</label>
					<input type="text" name="cause_of_death">
				</div>
				<div class="form-group">
					<label for="Name">SOURCE OF INFORMATION</label>
					<textarea id="address" rows="3" name="source_of_info"
						placeholder="How do you got to know about the death news..."></textarea>
				</div>
				<div class="form-group">
					<label for="Name">GRAVE NO.</label>
					<input type="text" name="grave_no">
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">MINISTER'S NAME</label>
					<input type="text" name="minister_name">
				</div>
				<div class="form-group">
					<label for="Name">Remarks</label>
					<textarea id="address" rows="3" name="remarks"></textarea>
				</div>
				<div></div>
			</div>
		</div>

		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="post_burial_frm" id="post_bpt_frm">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>
	<br><br><br>
</body>

</html>