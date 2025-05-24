<?php
include '../config/connection.php';
$priest_id = $_GET['id'];

$sql = "SELECT * FROM priest WHERE ID = '$priest_id' AND stationID = '$STATION_CODE'";
$result = $conn->query($sql);

while ($rows = $result->fetch_assoc()) {
	$name = $rows['name'];
	$designation = $rows['designation'];
	$start_date = $rows['start_date'];
	$end_date = $rows['end_date'];
}

if (isset($_POST['modify_priest'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$designation = mysqli_real_escape_string($conn, $_POST['designation']);
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$sql = "UPDATE priest SET name = '$name', designation =  '$designation', 
	start_date = '$start_date', end_date = '$end_date' WHERE ID = '$priest_id' 
	AND stationID = '$STATION_CODE'";

	if (mysqli_query($conn, $sql)) {
		echo "<script>
					alert('A priest record has been modified.');			
					window.location.href = document.referrer;
			</script>";
		// header("Location: ../priest/index.php");
	} else {
		echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
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
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%">
					<h3>PRIEST</h3>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<form id="addNewPriestForm" action="<?php $_SERVER['PHP_SELF'] ?>?id=<?php echo $priest_id; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Basic Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Pries Name">Priest Name</label>
					<input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
				</div>
				<div class="form-group">
					<label for="status">Designation</label>
					<select id="designation" name="designation" required>
						<option value="<?php echo $designation; ?>" hidden><?php echo $designation; ?></option>
						<option>Parish Priest</option>
						<option>Asst. Parish Priest</option>
						<option>Parish Priest (In-Charge)</option>
					</select>
				</div>
				<div class="form-group">
					<label for="startYear">Start Year</label>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_date"
						value="<?php echo $start_date; ?>" required>
				</div>
				<div class="form-group">
					<label for="endYear">End Year</label>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="end_date"
						value="<?php echo $end_date; ?>">
				</div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="modify_priest">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
		<br><br>
	</form>

</body>

</html>