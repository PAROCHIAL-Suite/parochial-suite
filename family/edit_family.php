<?php
include "../config/connection.php";

$idR = $_GET['id'];

if (isset($_POST['update_member'])) {
	$family_name = isset($_POST['family_name']) ? mysqli_real_escape_string($conn, $_POST['family_name']) : '';
	$address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : '';
	$area_code = isset($_POST['area_code']) ? mysqli_real_escape_string($conn, $_POST['area_code']) : '';
	$status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';

	// Update family_master_table
	$sql1 = "UPDATE family_master_table SET 
    family_name = '$family_name', 
    address = '$address', 
    area_code = '$area_code',
    modify_date = '$date', 
    edited_by = '$USERNAME' 
    WHERE family_ID = '$idR'";

	if (!mysqli_query($conn, $sql1)) {
		echo "ERROR: <code>UNABLE_TO_UPDATE_FAMILY</code><br>";
		echo "$sql1<br>" . mysqli_error($conn);
		exit;
	}

	// Update family_member table
	$sql2 = "UPDATE family_member SET 
    surname = '$family_name', 
    status = '$status',
    address = '$address', 
    area_code = '$area_code', 
    modify_date = '$date', 
    edited_by = '$USERNAME' 
    WHERE family_ID = '$idR'";

	if (!mysqli_query($conn, $sql2)) {
		echo "ERROR: <code>UNABLE_TO_UPDATE_FAMILY_MEMBER</code><br>";
		echo "$sql2<br>" . mysqli_error($conn);
		exit;
	}

	echo "<script>alert('Family details updated successfully!');</script>";
	echo "<script>window.location.href='family_list.php';</script>";
	exit;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Family</title>
	<style>
		.widget-row {
			display: flex;
			gap: 18px;
			margin: 30px 0 0 0;
			flex-wrap: wrap;
		}

		.widget-card {
			background: #fff;
			border-radius: 10px;
			box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
			padding: 18px 22px;
			min-width: 220px;
			max-width: 320px;
			flex: 1 1 220px;
			display: flex;
			flex-direction: column;
			align-items: flex-start;
		}

		.widget-title {
			font-size: 1.08rem;
			font-weight: 600;
			margin-bottom: 10px;
			color: #2a3b4d;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.widget-content {
			font-size: 0.98rem;
			color: #444;
		}

		.widget-content ul {
			margin: 0;
			padding-left: 18px;
		}

		.widget-content li {
			margin-bottom: 6px;
		}

		@media (max-width: 900px) {
			.widget-row {
				flex-direction: column;
				gap: 14px;
			}
		}
	</style>
</head>

<body style="overflow: auto;">
	<?php include '../nav/global_nav.php'; ?>
	<br><br>

	<div class="pageName">
		<h3>EDIT FAMILY</h3>
	</div>
	<BR>
	<?php
	$sql = "SELECT * FROM family_master_table 
                WHERE stationID = '$STATION_CODE' AND family_ID = '$idR'";
	$result = $conn->query($sql);
	while ($rows = $result->fetch_assoc()) {
		$area_code = $rows['area_code'];
		$family_name = $rows['family_name'];
		$address = $rows['address'];
		$status = $rows['status'];
	}
	?>

	<form class="parochial-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $idR; ?>">
		<div class="form-section">
			<div class="form-section-header">
				<h4 class="section-title">Modify Details</h4>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="area_code">UNIT/AREA CODE</label>
					<select name="area_code" id="area_code" class="select" onchange="search()">
						<option hidden><?php echo $area_code; ?></option>
						<?php
						$sql = "SELECT * FROM area_mapping ORDER BY area_code ASC";
						$result = $conn->query($sql);
						while ($rows = $result->fetch_assoc()) {
							$area_Code = $rows['area_code'];
							$area_Name = $rows['area_name'];
							?>
							<option value="<?php echo $area_Code; ?>">
								<?php echo $area_Code . ' - [' . $area_Name . "]"; ?>
							</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="family_name">NAME OF THE FAMILY</label>
					<input type="text" placeholder="Surname" value="<?php echo $family_name; ?>" id="family_name"
						name="family_name" required class="input">
				</div>
				<div class="form-group">
					<label for="status">STATUS</label>
					<select name="status" id="status" class="select">
						<option hidden><?php echo $status; ?></option>
						<option>ACTIVE</option>
						<option>IN-ACTIVE</option>
					</select>
				</div>
				<div></div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="address">ADDRESS</label>
					<input type="text" value="<?php echo $address; ?>" name="address" id="address" class="input">
				</div>
			</div>
		</div>

		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="update_member" id="saveFrm">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="history.back()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>

</body>

</html>