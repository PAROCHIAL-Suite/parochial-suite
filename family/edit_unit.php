<?php
include '../config/connection.php';

$uID = $_GET['unitID'] ?? '';

if (isset($_POST['update_unit_code'])) {
	$area_name = $_POST['area_name'];
	$given_name = $_POST['given_name'];
	$area_code = $_POST['area_code'];

	$sql = "UPDATE area_mapping SET area_name = '$area_name', area_code = '$area_code', given_name = '$given_name' WHERE ID = '$uID'";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Unit updated successfully!');</script>";
		echo "<script>window.location.href = 'create_unit.php';</script>";
		exit;
	} else {
		$msg = "ERROR: $sql. " . mysqli_error($conn);
	}
}

if (isset($_POST['delete_unit_code'])) {
	$sql = "DELETE FROM area_mapping WHERE ID = '$uID'";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Unit deleted successfully!');</script>";
		echo "<script>window.location.href = 'create_unit.php';</script>";
		$msg = "Unit deleted successfully!";
		// Redirect to the create_unit page after deletion
		// header("Location: create_unit.php");

		exit;
	} else {
		$msg = "ERROR: $sql. " . mysqli_error($conn);
	}
}

$sql = "SELECT * FROM area_mapping WHERE ID = '$uID'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
while ($row) {
	$area_name = $row['area_name'];
	$given_name = $row['given_name'];
	$area_code = $row['area_code'];
	break; // Exit after the first row
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Unit</title>
</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<h3>EDIT UNIT</h3>
	</div>
	<br>
	<div>
		<?php if (!empty($msg)): ?>
			<div class="ps-note warning" style="margin-bottom:18px;"><?php echo $msg; ?></div>
		<?php endif; ?>

		<form class="parochial-form" method="post" action="">
			<div class="form-section">
				<div class="form-section-header">
					<h3>Area/Unit Mapping</h3>
				</div>
				<div class="form-grid">
					<div class="form-group">
						<label for="area_name">AREA NAME</label>
						<input type="text" name="area_name" id="area_name"
							value="<?php echo htmlspecialchars($area_name); ?>" required>
					</div>
					<div class="form-group">
						<label for="given_name">GIVEN NAME</label>
						<input type="text" name="given_name" id="given_name"
							value="<?php echo htmlspecialchars($given_name); ?>">
					</div>
					<div class="form-group">
						<label for="area_code">SET A CODE NAME</label>
						<input type="text" name="area_code" id="area_code"
							value="<?php echo htmlspecialchars($area_code); ?>" required>
					</div>
				</div>
			</div>
			<div class="form-header">
				<div class="form-actions">
					<button type="submit" class="btn-primary" name="update_unit_code">
						<i class="fas fa-save"></i> Update
					</button>
					<button type="submit" class="btn-secondary" name="delete_unit_code"
						onclick="return confirm('Are you sure you want to delete this unit?');">
						<i class="fas fa-trash"></i> Delete
					</button>
				</div>
			</div>
		</form>
	</div>
</body>

</html>