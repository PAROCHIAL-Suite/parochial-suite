<?php
include '../config/connection.php';

$id1 = $_GET['id'];
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
		<div class="pageName card-heading">
			<h3>EDIT HOLY COMMUNION RECORD</h3>
		</div>
		<br>
		<form id="eucharist_form" method="post" action="edit_script.php?id=<?php echo $rows['id']; ?>" class="form-section">
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

		</form>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="edit_eucharist_from" id="saveFrm">
					<i class="fas fa-save"></i> Save</button>
				<button class="btn-secondary" onclick="history.back();">
					<i class="fas fa-times"></i> Back
				</button>
			</div>
		</div>
		<br><br>
	</body>

	</html>
<?php } ?>