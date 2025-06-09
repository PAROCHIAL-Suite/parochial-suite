<?php
include "../config/connection.php";

$idR = $_GET['id'];


// GET the family ID of the head of the family
$sql_head = "SELECT family_id FROM family_members WHERE relation_with_head = 'Head' AND poc = '$idR' AND stationID = '$STATION_CODE' LIMIT 1";
$result_head = $conn->query($sql_head);
$family_id = '';
if ($row_head = $result_head->fetch_assoc()) {
	$family_id = $row_head['family_id'];
}


// Updating family details this will also update the family members
if (isset($_POST['update_member'])) {
	$area_code = mysqli_real_escape_string($conn, $_POST['area_code']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);

	$sql = "UPDATE family_members SET area_code='$area_code', family_id='$family_id' WHERE poc='$idR' AND stationID = '$STATION_CODE'";

	if (mysqli_query($conn, $sql)) {
		echo "<script>
			alert('Family details updated successfully.');
			window.location.href = 'view_family.php?id=$idR';
		</script>";
	} else {
		echo "<script>alert('Error updating family details: " . mysqli_error($conn) . "');</script>";
	}
}

// Handle delete
if (isset($_POST['delete_family'])) {
	// Delete all members first
	$sql_del_members = "DELETE FROM family_members WHERE family_ID = '$family_id' AND stationID = '$STATION_CODE'";
	mysqli_query($conn, $sql_del_members);

	// If you have a family_master table, delete from it as well (uncomment and set correct table name)
	// $sql_del_family = "DELETE FROM family_master WHERE family_ID = '$family_id' AND stationID = '$STATION_CODE'";
	// mysqli_query($conn, $sql_del_family);

	echo "<script>
        alert('Family record and all its members have been deleted.');
        window.location.href = 'family_list.php';
    </script>";
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
	$sql = "SELECT * FROM family_members WHERE stationID = '$STATION_CODE' AND poc = '$idR'";

	$result = $conn->query($sql);
	while ($rows = $result->fetch_assoc()) {
		$area_code = $rows['area_code'];
		$family_name = $rows['name'];
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
					<label for="status">STATUS</label>
					<select name="status" id="status" class="select">
						<option hidden><?php echo $status; ?></option>
						<option>ACTIVE</option>
						<option>IN-ACTIVE</option>
					</select>
				</div>
				<div class="form-group">
					<label for="address">ADDRESS</label>
					<textarea name="address" id="address" rows="3"
						placeholder="Address"><?php echo $address; ?></textarea>
				</div>
			</div>
			<div class="form-grid">


				<div></div>
				<div></div>
			</div>
		</div>
		<br>
		<div class="form-section" style="background-color: transparent; border: none;">
			<i>
				<p><b>NOTE:</b> Deleting a family will also delete it's family members.</p>
			</i>
		</div>
		<div class="form-header">

			<div class="form-actions">
				<button type="submit" class="btn-primary" name="update_member" id="saveFrm">
					<i class="fas fa-save"></i> Save
				</button>
				<!-- Enhanced Delete button with warning -->
				<button type="button" class="btn-danger"
					onclick="if(confirm('Warning: Deleting this family will also delete ALL its members. Do you want to continue?')) { document.getElementById('deleteFamilyForm').submit(); }">
					<i class="fas fa-trash"></i> Delete
				</button>


			</div>

		</div>
		<br><br>
	</form>

	<!-- Hidden form for delete action -->
	<form id="deleteFamilyForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $idR; ?>">
		<input type="hidden" name="delete_family" value="1">
	</form>
	...