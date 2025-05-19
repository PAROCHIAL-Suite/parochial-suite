<?php
include "../config/connection.php";

// Fetch family count
$sql = "SELECT COUNT(*) as family_count FROM family_master_table WHERE stationID = '$STATION_CODE'";
$result = $conn->query($sql);
if ($result) {
	$row = $result->fetch_assoc();
	$family_count = $row['family_count'] + 1; // Increment count for new family
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	$family_count = 1; // Default to 1 if query fails
}

// Inserting family
if (isset($_POST['register_family'])) {
	$date = date("d/m/Y");
	$family_name = mysqli_real_escape_string($conn, $_POST['family_name']);
	$address = $_POST['address'];
	$area_code = $_POST['area_code'];
	$family_ID = $STATION_CODE . $family_count; // Generate family ID

	// Insert into family_master_table
	$sql = "INSERT INTO family_master_table VALUES(
            '', '$family_ID', '$STATION_CODE', 'ACTIVE', '$family_name', '$address', '$area_code',
            '$date', '', '')";

	try {
		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('A new family has been created.');</script>";
		} else {
			throw new Exception(mysqli_error($conn));
		}
	} catch (Exception $e) {
		if (strpos($e->getMessage(), '1062') !== false) {
			echo "<script>alert('Duplicate entry detected. The family ID already exists.');</script>";
		} else {
			echo "ERROR: " . $e->getMessage();
		}
	}

	// Adding family head to family_member table
	$name = $_POST['name'];
	$contact_no = $_POST['contact_no'];

	$sql = "INSERT INTO `family_member` (`ID`, `family_ID`, `stationID`, `area_code`, `status`, `status_remark`, `name`, `surname`, `dob`, `gender`, `blood_group`, `occupation`, `qualification`, `address`, `contact_no`, `email`, `relation_with_head`, `relationship_status`, `lang`, `other_lang`, `baptism`, `confirmation`, `eucharist`, `anointing_of_the_sick`, `marriage`, `ration_card`, `pan_card`, `adhar_card`, `aayushman_bharat`, `ladki_bahin`, `old_age_pension`, `differently_able`, `voter_id`, `driving_license`, `monthly_income`, `any_other`, `modify_date`, `edited_by`) VALUES
 (NULL, '$family_ID', '$STATION_CODE', '$area_code', 'ACTIVE', '', '$name', '$family_name', '', '', '', '', '', '$address', '$contact_no', '', 'Head', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";

	try {
		if (mysqli_query($conn, $sql)) {
			echo "<script>alert('Family head has been added successfully.');</script>";
		} else {
			throw new Exception(mysqli_error($conn));
		}
	} catch (Exception $e) {
		if (strpos($e->getMessage(), '1062') !== false) {
			echo "<script>alert('Duplicate entry detected. The family head already exists.');</script>";
		} else {
			echo "ERROR: " . $e->getMessage();
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title></title>
</head>

<body style="overflow: auto;">
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>FAMILY REGISTRATION</h3>
	</div>
	<br>
	<!-- form to add new family -->
	<form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Details of Family Head</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Pries Name">Name</label>
					<input placeholder="Name" type="text" id="head_name" name="name" required>
				</div>
				<div class="form-group">
					<label for="status">Surname</label>
					<input type="text" placeholder="Surname" id="family_name" name="family_name" required>
				</div>
				<div class="form-group">
					<label for="startYear">Contact</label>
					<!-- <input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_date" required> -->
					<input type="number" pattern="\d{10}" maxlength="10" inputmode="numeric" inputmode="numeric"
						oninput="this.value=this.value.slice(0,10)" placeholder="10 Digits" id="family_name"
						name="contact_no" required>
				</div>


			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="status">Address</label>
					<input type="text" placeholder="Address" id="address" name="address" required>
				</div>
				<div class="form-group">
					<label for="status">Area Code</label>
					<select name="area_code" id="" required>
						<option hidden>Area Code</option>
						<?php
						include "../config/connection.php";
						$sql = "SELECT * FROM area_mapping 
		            	 ORDER BY area_code ASC";
						$result = $conn->query($sql);
						$conn->close();
						while ($rows = $result->fetch_assoc()) {
							$area_Code = $rows['area_code'];
							$area_Name = $rows['area_name'];
							?>
							<option value="<?php echo $rows['area_code']; ?>">
								<?php echo $rows['area_code'] . ' - [' . $rows['area_name'] . "]";
						} ?>
						</option>
					</select>
				</div>
				<div></div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="register_family">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
		<br>
	</form>
	<div class="form-header">
		<div class="form-actions">


		</div>
	</div>

	<!-- Disply data -->
	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 55%;">
				<div class="widget-header">
					<h3>Recently Created Records</h3>
					<a href="family_list.php" class="btn-link">
						Show All Records
					</a>
				</div>
				<div class="widget-content">
					<table class="data-table">
						<thead>
							<tr>
								<th>ACTION</th>
								<th onclick="sortTable(1)">FAMILY ID</th>
								<th>FAMILY NAME</th>
								<th onclick="sortTable(3)">AREA CODE</th>
								<th>ADDRESS</th>
								<th hidden>PARISH ID</th>

							</tr>
						</thead>
						<tbody>
							<?php
							include "../config/connection.php";
							$sql = "SELECT * FROM family_master_table WHERE stationID = '$STATION_CODE'";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								$id = $rows['family_ID'];
								?>
								<tr>
									<td>
										<a href="edit_family.php?id=<?php echo $rows['family_ID']; ?>">Edit</a>
										|
										<a href="create_member.php?id=<?php echo $rows['family_ID']; ?>">Add Member</a>
										|
										<a href="edit_family_head.php?id=<?php echo $rows['family_ID']; ?>">Edit Family
											Head</a>
									</td>
									<td><?php echo $rows['family_ID']; ?></td>
									<td><?php echo $rows['family_name']; ?></td>
									<td><?php echo $rows['area_code']; ?></td>
									<td><?php echo $rows['address']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>




	<script src="../js/search_script.js"></script>
</body>

</html>


<!-- code to upload data to server -->