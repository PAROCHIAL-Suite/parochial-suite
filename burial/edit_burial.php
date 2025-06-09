<?php
include "../config/connection.php";

// Get reg_no from query string
$reg_no = isset($_GET['reg_no']) ? mysqli_real_escape_string($conn, $_GET['reg_no']) : '';
$message = "";

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_burial'])) {
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



	$update_sql = "UPDATE burial SET
        date_of_death='$date_of_death',
        date_of_burial='$date_of_burial',
        name='$name',
        surname='$surname',
        dob='$dob',
        gender='$gender',
        address='$address',
        cause_of_death='$cause_of_death',
        source_of_info='$source_of_info',
        grave_no='$grave_no',
        minister_name='$minister_name',
        remarks='$remarks'
        WHERE reg_no='$reg_no' AND stationID='$STATION_CODE'
    ";

	if ($conn->query($update_sql) === TRUE) {
		echo "<script>
			alert('Record updated successfully.');
			window.location.href = 'search.php';
		</script>";
	} else {
		$message = "<div style='color:red;'>Error updating record: {$conn->error}</div>";
	}
}

// Fetch the record for display
$burial = null;
if ($reg_no) {
	$sql = "SELECT * FROM burial WHERE reg_no = '$reg_no' AND stationID = '$STATION_CODE' LIMIT 1";
	$result = $conn->query($sql);
	if ($result && $result->num_rows > 0) {
		$burial = $result->fetch_assoc();
	}
}

// Handle delete (fix: use reg_no from query string)
if (isset($_GET['delete']) && $_GET['delete'] == 'confirmed' && $reg_no) {

	$delete_sql = "DELETE FROM burial WHERE reg_no = '$reg_no' AND stationID = '$STATION_CODE'";
	if ($conn->query($delete_sql) === TRUE) {
		echo "<script>
            alert('Record deleted successfully.');
            window.location.href = 'search.php';
        </script>";
		exit();
	} else {
		echo "<script>alert('ERROR: Unable to delete.'); </script>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Burial Record</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>EDIT BURIAL RECORD</h3>
	</div>
	<br>
	<?php if ($message)
		echo $message; ?>
	<?php if ($burial) { ?>
		<form method="POST" action="">
			<div class="form-section">
				<div class="form-section-header">
					<h3>Registration Information</h3>
				</div>
				<div class="form-grid">
					<div class="form-group">
						<label>REGISTRATION NUMBER</label>
						<input type="text" name="reg_no" value="<?php echo htmlspecialchars($burial['reg_no']); ?>"
							readonly>
					</div>
					<div class="form-group">
						<label>DATE OF DEATH</label>
						<input type="text" name="date_of_death" class="auto-format-date"
							value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($burial['date_of_death']))); ?>"
							required>
					</div>
					<div class="form-group">
						<label>DATE OF BURIAL</label>
						<input type="text" name="date_of_burial" class="auto-format-date"
							value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($burial['date_of_burial']))); ?>"
							required>
					</div>
				</div>
				<div class="form-section-header">
					<h3>Basic Information</h3>
				</div>
				<div class="form-grid">
					<div class="form-group">
						<label>NAME</label>
						<input type="text" name="name" value="<?php echo htmlspecialchars($burial['name']); ?>">
					</div>
					<div class="form-group">
						<label>SURNAME</label>
						<input type="text" name="surname" value="<?php echo htmlspecialchars($burial['surname']); ?>">
					</div>
					<div class="form-group">
						<label>DATE OF BIRTH</label>
						<input type="text" name="dob" class="auto-format-date"
							value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($burial['dob']))); ?>">
					</div>
				</div>
				<div class="form-grid">
					<div class="form-group">
						<label>GENDER</label>
						<select name="gender">
							<option value="" hidden>Select</option>
							<option value="Male" <?php if ($burial['gender'] == "Male")
								echo "selected"; ?>>Male</option>
							<option value="Female" <?php if ($burial['gender'] == "Female")
								echo "selected"; ?>>Female
							</option>
						</select>
					</div>
					<div class="form-group">
						<label>ADDRESS</label>
						<textarea id="address" rows="3"
							name="address"><?php echo htmlspecialchars($burial['address']); ?></textarea>
					</div>
					<div></div>
				</div>
				<div class="form-section-header">
					<h3>Information</h3>
				</div>
				<div class="form-grid">
					<div class="form-group">
						<label>CAUSE OF DEATH</label>
						<input type="text" name="cause_of_death"
							value="<?php echo htmlspecialchars($burial['cause_of_death']); ?>">
					</div>
					<div class="form-group">
						<label>SOURCE OF INFO</label>
						<input type="text" name="source_of_info"
							value="<?php echo htmlspecialchars($burial['source_of_info']); ?>">
					</div>
					<div class="form-group">
						<label>GRAVE NO</label>
						<input type="text" name="grave_no" value="<?php echo htmlspecialchars($burial['grave_no']); ?>">
					</div>
				</div>
				<div class="form-grid">
					<div class="form-group">
						<label>MINISTER NAME</label>
						<input type="text" name="minister_name"
							value="<?php echo htmlspecialchars($burial['minister_name']); ?>">
					</div>
					<div class="form-group">
						<label>REMARKS</label>
						<textarea name="remarks"><?php echo htmlspecialchars($burial['remarks']); ?></textarea>
					</div>
					<div></div>
				</div>
			</div>
			<div class="form-header">
				<div class="form-actions">
					<button type="submit" class="btn-primary" name="update_burial">Save</button>
					<button type="button" class="btn-danger"
						onclick="if(confirm('Are you sure you want to delete this record?')){ window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?reg_no=<?php echo urlencode($reg_no); ?>&delete=confirmed'; }"
						name="delete" id="delete_btsm_info">
						<i class="fas fa-trash"></i> Delete
					</button>
				</div>
			</div>

		</form>
	<?php } else { ?>
		<div style="color:red;">Record not found.</div>
	<?php } ?>
</body>

</html>