<?php
include '../config/connection.php';

$id1 = $_GET['id'];
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Sanitize and fetch form data
	$reg_no = trim($_POST['reg_no']);
	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
	$dob = trim($_POST['dob']);
	$father_name = trim($_POST['father_name']);
	$mother_name = trim($_POST['mother_name']);
	$baptism_date = trim($_POST['baptism_date']);
	$baptism_reg = trim($_POST['baptism_reg']);
	$baptism_parish = trim($_POST['baptism_parish']);
	$p_address = trim($_POST['p_address']);
	$church_of_eucharist = trim($_POST['church_of_eucharist']);
	$date = trim($_POST['date']);
	$minister_name = trim($_POST['minister_name']);
	$parish_priest = trim($_POST['parish_priest']);

	// Prepare and execute update query
	$stmt = $conn->prepare(
		"UPDATE eucharist SET 
            name = ?, 
            surname = ?, 
            dob = ?, 
            father_name = ?, 
            mother_name = ?, 
			baptism_reg_no = ?, 
            baptism_date = ?,             
            baptism_parish = ?, 
            parish_address = ?, 
            church_of_comunion = ?, 
            date_of_communion = ?, 
            minister = ?, 
            parish_priest = ?,
            created_on = NOW()
        WHERE reg_no = ?"
	);

	if (!$stmt) {
		$message = "Prepare failed: " . $conn->error;
	} else {
		$stmt->bind_param(
			"ssssssssssssss",
			$name,
			$surname,
			$dob,
			$father_name,
			$mother_name,
			$baptism_date,
			$baptism_reg,
			$baptism_parish,
			$p_address,
			$church_of_eucharist,
			$date,
			$minister_name,
			$parish_priest,
			$reg_no
		);

		if ($stmt->execute()) {
			$message = "Record updated successfully!";
		} else {
			$message = "Update failed: " . $stmt->error;
		}
		$stmt->close();
	}
}

// Fetch the record again for display
$sql = "SELECT * FROM eucharist WHERE reg_no = '$id1' and stationID = '$STATION_CODE'";
$result = $conn->query($sql);
if ($rows = $result->fetch_assoc()) {
	?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
		<title>Edit Holy Communion Record</title>
	</head>

	<body>
		<?php include '../nav/global_nav.php'; ?>
		<br><br>
		<div class="pageName">
			<h3>EDIT HOLY COMMUNION RECORD</h3>
		</div>
		<br>
		<form id="eucharist_form" method="post" class="form-section">
			<div class="form-section-header">
				<h4>Certificate Details</h4>
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
					<label>FATHER'S NAME</label>
					<input type="text" name="father_name" value="<?php echo htmlspecialchars($rows['father_name']); ?>">
				</div>
				<div class="form-group">
					<label>MOTHER'S NAME</label>
					<input type="text" name="mother_name" value="<?php echo htmlspecialchars($rows['mother_name']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>BAPTISM DATE</label>
					<input type="text" name="baptism_date" class="auto-format-date"
						value="<?php echo htmlspecialchars($rows['baptism_date']); ?>" placeholder="dd/mm/yyyy">
				</div>
				<div class="form-group">
					<label>BAPTISM REGISTRATION NO.</label>
					<input type="text" name="baptism_reg" value="<?php echo htmlspecialchars($rows['baptism_reg_no']); ?>">
				</div>
				<div class="form-group">
					<label>BAPTISM PARISH NAME</label>
					<input type="text" name="baptism_parish"
						value="<?php echo htmlspecialchars($rows['baptism_parish']); ?>">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>PARISH ADDRESS</label>
					<input type="text" name="p_address" value="<?php echo htmlspecialchars($rows['parish_address']); ?>">
				</div>
				<div class="form-group">
					<label>CHURCH OF HOLY COMMUNION</label>
					<input type="text" name="church_of_eucharist"
						value="<?php echo htmlspecialchars($rows['church_of_comunion']); ?>">
				</div>
				<div class="form-group">
					<label>DATE OF HOLY COMMUNION</label>
					<input type="text" name="date" class="auto-format-date"
						value="<?php echo htmlspecialchars($rows['date_of_communion']); ?>" placeholder="dd/mm/yyyy">
				</div>
			</div>
			<div class="form-section-header">
				<h4>Parochial Details</h4>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label>MINISTER'S NAME</label>
					<input type="text" name="minister_name" value="<?php echo htmlspecialchars($rows['minister']); ?>">
				</div>
				<div class="form-group">
					<label>PARISH PRIEST</label>
					<input type="text" name="parish_priest" value="<?php echo htmlspecialchars($rows['parish_priest']); ?>">
				</div>
				<div class="form-group"></div>
			</div>
			<div class="form-header">
				<div class="form-actions">
					<button type="submit" class="btn-primary" name="edit_eucharist_from">
						<i class="fas fa-save"></i> Save
					</button>
					<button class="btn-secondary" type="button" onclick="history.back();">
						<i class="fas fa-times"></i> Back
					</button>
				</div>
			</div>
		</form>
		<br>
	</body>

	</html>
<?php } ?>