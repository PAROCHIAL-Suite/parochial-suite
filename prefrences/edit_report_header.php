<?php
include '../config/connection.php';

if (isset($_POST['edit_header'])) {
	@$p_name = mysqli_real_escape_string($conn, $_POST['parish_name']);
	@$p_address = mysqli_real_escape_string($conn, $_POST['parish_address']);
	@$diocese = mysqli_real_escape_string($conn, $_POST['diocese-name']);


	$sql = "UPDATE parish_info SET 
            p_name = '$p_name', 
            p_address = '$p_address', 
            diocese = '$diocese' WHERE stationID = '$STATION_CODE'";

	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Report header has been changed.')</script>";
	} else {
		echo "ERROR: $sql. " . mysqli_error($conn);
	}
}

$sql = "SELECT * from parish_info WHERE stationID = '$STATION_CODE'";
$result = $conn->query($sql);
if ($result) {
	$rows = $result->fetch_assoc();
	$name = $rows['p_name'];
	$address = $rows['p_address'];
	$diocese = $rows['diocese'];
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Report Header</title>
	<style>
		.headerPreview {
			border: 1px solid lightblue;
			width: 85%;
			margin: auto;
			box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
			background-color: white;
		}
	</style>
</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<h3>EDIT REPORT HEADER</h3>
	</div>
	<br>


	<form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Basic Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="parish_name">CHURCH NAME</label>
					<input type="text" name="parish_name" class="form-control" value="<?php echo $name; ?>" required>
				</div>
				<div class="form-group">
					<label for="parish_address">ADDRESS</label>
					<input type="text" name="parish_address" class="form-control" value="<?php echo $address; ?>"
						required>
				</div>
				<div class="form-group">
					<label for="diocese-name">DIOCESE NAME</label>
					<input type="text" name="diocese-name" class="form-control" value="<?php echo $diocese; ?>"
						required>
				</div>
			</div>
		</div>


		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="edit_header">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>
	<br><br>
	<div class="form-section">
		<div class="form-section-header">
			<h3>Report Header Preview</h3>
		</div>
		<?php include '../prefrences/letterHead_header.php'; ?>
		<br><br>
	</div>
</body>

</html>