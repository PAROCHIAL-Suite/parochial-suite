<?php

include '../config/connection.php';

$id = $_GET['id'] ?? '';
$message = "";

// Handle delete
if (isset($_GET['delete']) && $_GET['delete'] == 'confirmed') {
	$delete_id = $conn->real_escape_string($id);
	$delete_sql = "DELETE FROM confirmation WHERE reg_no = '$delete_id' AND stationID = '$STATION_CODE'";
	if ($conn->query($delete_sql) === TRUE) {
		echo "<script>
            alert('Record deleted successfully.');
            window.location.href = 'search.php';
        </script>";
		exit();
	} else {
		$message = "<div style='color:red;'>Error deleting record: {$conn->error}</div>";
	}
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_confirmation_form'])) {
	$reg_no = $conn->real_escape_string($_POST['reg_no']);
	$name = $conn->real_escape_string($_POST['name']);
	$surname = $conn->real_escape_string($_POST['surname']);
	$dob = $conn->real_escape_string($_POST['dob']);
	$gender = $conn->real_escape_string($_POST['gender']);
	$father_name = $conn->real_escape_string($_POST['father_name']);
	$mother_name = $conn->real_escape_string($_POST['mother_name']);
	$baptism_date = $conn->real_escape_string($_POST['baptism_date']);
	$baptism_reg = $conn->real_escape_string($_POST['baptism_reg']);
	$baptism_parish = $conn->real_escape_string($_POST['baptism_parish']);
	$p_address = $conn->real_escape_string($_POST['p_address']);
	$church_of_confirmation = $conn->real_escape_string($_POST['church_of_confirmation']);
	$date_of_confirmation = $conn->real_escape_string($_POST['date']);
	$sponsor = $conn->real_escape_string($_POST['sponsor']);
	$minister_name = $conn->real_escape_string($_POST['minister_name']);
	$parish_priest = $conn->real_escape_string($_POST['parish_priest']);

	$update_sql = "UPDATE confirmation SET
        name='$name',
        surname='$surname',
        dob='$dob',
        gender='$gender',
        father_name='$father_name',
        mother_name='$mother_name',
        baptism_date='$baptism_date',
        baptism_reg_no='$baptism_reg',
        baptism_parish='$baptism_parish',
        parish_address='$p_address',
        church_of_confirmation='$church_of_confirmation',
        date_of_confirmation='$date_of_confirmation',
        sponsor='$sponsor',
        minister='$minister_name',
        parish_priest='$parish_priest'
        WHERE reg_no='$reg_no' AND stationID='$STATION_CODE'
    ";

	if ($conn->query($update_sql) === TRUE) {
		echo "<script>
			alert('Record updated successfully!');
			window.location.href = 'search.php';
		</script>";
	} else {
		$message = "<div style='color:red;'>Error updating record: {$conn->error}</div>";
	}
}

// Fetch the record again for display
$sql = "SELECT * FROM confirmation WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
$result = $conn->query($sql);
$rows = $result ? $result->fetch_assoc() : null;
?>
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
	<?php if (!empty($message))
		echo $message; ?>
	<?php if ($rows) { ?>
		<form id="confirmation_form" method="post" action="">
			<div class="form-section">
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
						<input type="text" name="baptism_reg"
							value="<?php echo htmlspecialchars($rows['baptism_reg_no']); ?>">
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
						<input type="text" name="p_address"
							value="<?php echo htmlspecialchars($rows['parish_address']); ?>">
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
						<input type="text" name="parish_priest"
							value="<?php echo htmlspecialchars($rows['parish_priest']); ?>">
					</div>
					<div></div>
					<div></div>
				</div>
			</div>
			<div class="form-header">
				<div class="form-actions">
					<button type="submit" class="btn-primary" name="edit_confirmation_form" id="saveFrm">Save</button>
					<button type="button" class="btn-danger"
						onclick="if(confirm('Are you sure you want to delete this record?')){ window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo urlencode($id); ?>&delete=confirmed'; }"
						name="delete" id="delete_confirmation">
						<i class="fas fa-trash"></i> Delete
					</button>
				</div>
			</div>
		</form>
	<?php } else { ?>
		<div style="color:red;">Record not found.</div>
	<?php } ?>
	<br><br>
</body>

</html>