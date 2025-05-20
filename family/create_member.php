<?php
include '../config/connection.php';
$id = $_GET['id'];

// Fetch family details
$sql_for_family = "SELECT * FROM family_master_table WHERE family_ID = '$id'";
$result = $conn->query($sql_for_family);
if ($result->num_rows > 0) {
	while ($rows = $result->fetch_assoc()) {
		$family_name = $rows['family_name'];
		$family_ID = $rows['family_ID'];
		$area = $rows['area_code'];
		$contact_no = @$rows['contact_no'];
		$address = $rows['address'];
	}
} else {
	echo "No family found with ID: $id";
	exit;
}

// Fetch family head details from family_member
$head = '';
$head_contact = '';
$sql_head = "SELECT name, contact_no, relation_with_head FROM family_member WHERE family_ID = '$id' AND relation_with_head = 'Head' LIMIT 1";
$result_head = $conn->query($sql_head);
if ($result_head && $result_head->num_rows > 0) {
	$row_head = $result_head->fetch_assoc();
	$head = $row_head['name'];
	$head_contact = $row_head['contact_no'];
	$relation_with_head_value = '';
	$relation_with_head_readonly = '';
} else {
	// No head found, so this member will be the head
	$relation_with_head_value = 'Head';
	$relation_with_head_readonly = 'readonly';
}

if (isset($_POST['register_member'])) {
	$fid = $_GET['id'];
	$area_code = $area;
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	$status_remark = mysqli_real_escape_string($conn, $_POST['status_remark']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$blood_grp = mysqli_real_escape_string($conn, $_POST['blood_group']);
	$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$relation_with_head = mysqli_real_escape_string($conn, $_POST['relation_with_head']);
	$relationship_status = mysqli_real_escape_string($conn, $_POST['relationship_status']);
	$lang = mysqli_real_escape_string($conn, $_POST['lang']);
	$other_lang = mysqli_real_escape_string($conn, $_POST['other_lang']);
	$baptism = mysqli_real_escape_string($conn, $_POST['baptism']);
	$confirmation = mysqli_real_escape_string($conn, $_POST['confirmation']);
	$eucharist = mysqli_real_escape_string($conn, $_POST['eucharist']);
	$marriage = mysqli_real_escape_string($conn, $_POST['marriage']);
	$annointing_of_the_sick = mysqli_real_escape_string($conn, $_POST['annointing_of_the_sick']);
	$ration_card = mysqli_real_escape_string($conn, $_POST['ration_card']);
	$pan_card = mysqli_real_escape_string($conn, $_POST['pan_card']);
	$adhar_card = mysqli_real_escape_string($conn, $_POST['adhar_card']);
	$aayushman_bharat = mysqli_real_escape_string($conn, $_POST['aayushman_bharat']);
	$ladki_bahin_yogana = mysqli_real_escape_string($conn, $_POST['ladki_bahin_yogana']);
	$old_age_pension = mysqli_real_escape_string($conn, $_POST['old_age_pension']);
	$differently_able = mysqli_real_escape_string($conn, $_POST['differently_able']);
	$voter_id = mysqli_real_escape_string($conn, $_POST['voter_id']);
	$driving_license = mysqli_real_escape_string($conn, $_POST['driving_license']);
	$monthly_income = mysqli_real_escape_string($conn, $_POST['monthly_income']);
	$any_other = mysqli_real_escape_string($conn, $_POST['any_other']);

	$sql = "INSERT INTO family_member VALUES(
        '',
        '$fid',
        '$STATION_CODE',
        '$area_code',
        '$status',    
        '$status_remark',            
        '$name',
        '$surname',
        '$dob',
        '$gender',
        '$blood_grp',
        '$occupation',
        '$qualification',
        '$address', 
        '$contact_no',
        '$email',
        '$relation_with_head',
        '$relationship_status',
        '$lang',
        '$other_lang',
        '$baptism',
        '$confirmation',
        '$eucharist',
        '$annointing_of_the_sick',
        '$marriage',
        '$ration_card',
        '$pan_card', 
        '$adhar_card',
        '$aayushman_bharat',
        '$ladki_bahin_yogana',
        '$old_age_pension',
        '$differently_able',
        '$voter_id', 
        '$driving_license',
        '$monthly_income',
        '$any_other','','$USERNAME')";

	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('A new member has been added.');</script>";
		echo "<script>window.location.href='view_family.php?id=$fid';</script>";
		exit;
	} else {
		echo "ERROR: Unable to register member.<br>";
		echo "SQL Query: " . $sql . "<br>";
		echo "MySQL Error: " . mysqli_error($conn);
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/parochialUI.css">
	<script src="../print.js"></script>
	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>ADD A MEMBER</h3>
	</div>
	<br>
	<div class="form-section">
		<div class="form-section-header" style="margin-bottom: 2px;">
			<h3>Family Information</h3>
		</div>
		<div class="form-grid">
			<div class="form-group">
				<label for="">Family ID</label>
				<?php echo @$family_ID; ?>
			</div>
			<div class="form-group">
				<label for="">Family Name</label>
				<?php echo @$family_name; ?>
			</div>
			<div class="form-group">
				<label for="">Family Head Name</label>
				<?php echo @$head; ?>
			</div>
			<div class="form-group">
				<label for="">Contact</label>
				<?php echo $head_contact ? $head_contact : $contact_no; ?>
			</div>
			<div class="form-group">
				<label for="">Area Code</label>
				<?php echo $area; ?>
			</div>
			<div class="form-group">
				<label for="">Address</label>
				<?php echo $address; ?>
			</div>
		</div>
	</div>

	<br><br>

	<div class="pageName">
		<h3>MEMBER REGISTRATION FORM</h3>
	</div>
	<BR>
	<div class="form-section">
		<form id="" class="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Member Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status">
						<option selected value="ACTIVE">ACTIVE</option>
						<option value="IN-ACTIVE">IN-ACTIVE</option>
						<option value="DECEASED">DECEASED</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Status Remark</label>
					<input type="text" name="status_remark">
				</div>
				<div></div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="">Name</label>
					<input onblur="getLastName()" type="text" name="name" required>
				</div>
				<div class="form-group">
					<label for="">Surname</label>
					<input type="text" name="surname" id="surname" value="<?php echo $family_name; ?>" required>
				</div>
				<div class="form-group">
					<label for="">Date of birth</label>
					<input type="text" name="dob" class="auto-format-date" placeholder="dd/mm/yyyy">
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="">Gender</label>
					<select name="gender">
						<option hidden>Choose</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">blood group</label>
					<select id="blood_group" name="blood_group">
						<option hidden>--</option>
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
					</select>
				</div>
				<div></div>
			</div>

			<div class="form-grid">

				<div class="form-group">
					<label for="">Qualification</label>
					<input type="text" name="qualification">
				</div>
				<div class="form-group">
					<label for="">Occupation</label>
					<input type="text" name="occupation">
				</div>
				<div class="form-group">
					<label for="">mother TONGUE</label>
					<select name="lang">
						<option hidden></option>
						<option hidden>--</option>
						<option value="Hindi">Hindi</option>
						<option value="English">English</option>
						<option value="Marathi">Marathi</option>
						<option value="Tamil">Tamil</option>
						<option value="Telugue">Telugue</option>
						<option value="Malayalam">Malayalam</option>
					</select>
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="">Known Languages</label>
					<input type="text" name="other_lang">
				</div>

				<div class="form-group">
					<label for="">Relation with Head (<?php echo @$head; ?>)</label>
					<?php if (isset($relation_with_head_readonly) && $relation_with_head_readonly): ?>
						<input type="text" id="relations" name="relation_with_head" value="Head" readonly
							placeholder="Relation with Head">
					<?php else: ?>
						<select id="relations" name="relation_with_head" required>
							<option value="" hidden>Select Relation</option>
							<option value="Husband">Husband</option>
							<option value="Wife">Wife</option>
							<option value="Father">Father</option>
							<option value="Mother">Mother</option>
							<option value="Son">Son</option>
							<option value="Daughter">Daughter</option>
							<option value="Brother">Brother</option>
							<option value="Sister">Sister</option>
							<option value="Grandfather">Grandfather</option>
							<option value="Grandmother">Grandmother</option>
							<option value="Uncle">Uncle</option>
							<option value="Aunt">Aunt</option>
							<option value="Cousin">Cousin</option>
							<option value="Nephew">Nephew</option>
							<option value="Niece">Niece</option>
							<option value="Son-in-Law">Son-in-Law</option>
							<option value="Daughter-in-Law">Daughter-in-Law</option>
							<option value="Brother-in-Law">Brother-in-Law</option>
							<option value="Sister-in-Law">Sister-in-Law</option>
							<option value="Father-in-Law">Father-in-Law</option>
							<option value="Mother-in-Law">Mother-in-Law</option>
						</select>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label for="">Relationship Status</label>
					<select name="relationship_status">
						<option hidden>--</option>
						<option value="Married">Married</option>
						<option value="Divorsed">Divorsed</option>
						<option value="Seperated">Seperated</option>
						<option value="Bachelor">Bachelor</option>
						<option value="Spinster">Spinster</option>
						<option value="Widower">Widower</option>
						<option value="Window">Widow</option>
						<option value="Priest">Priest</option>
					</select>
				</div>

			</div>

			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Contact Details</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email">
				</div>
				<div class="form-group">
					<label for="">Phone No.</label>
					<input type="text" name="contact_no" id="contact_no">
				</div>
				<div class="form-group">
					<label for="">address</label>
					<textarea name="address" id="address" rows="2" cols="20" required><?php echo $address; ?></textarea>
				</div>
			</div>


			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Sacramental Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Baptism</label>
					<select name="baptism">
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Confirmation</label>
					<select name="confirmation">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Holy Communion</label>
					<select name="eucharist">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>

			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Anointing of the Sick</label>
					<select name="annointing_of_the_sick">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Marriage</label>
					<select name="marriage">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Marriage Date</label>
					<input type="text" name="marriage_date" class="auto-format-date" placeholder="dd/mm/yyyy">
				</div>
			</div>
			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Government Entitlements</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Ration Card</label>
					<select name="ration_card">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">PAN Card</label>
					<select name="pan_card">
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Aadhar Card</label>
					<select name="adhar_card">
						<option value="Yes" selected>Yes</option>
						<option value="No">No</option>
					</select>
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Aayushman Bharat (PM-JAY)</label>
					<select name="aayushman_bharat">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Ladki Bahin Yogana</label>
					<select name="ladki_bahin_yogana">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Old Age Pension/Niradhar Yojana</label>
					<select name="old_age_pension">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Differently Able Person</label>
					<select name="differently_able">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Voter ID</label>
					<select name="voter_id">
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Driving License</label>
					<select name="driving_license">
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Monthly Income</label>
					<input type="text" name="monthly_income">
				</div>
				<div class="form-group">
					<label for="">Any Other/Remark</label>
					<textarea name="any_other" id="any_other" rows="2" cols="20"></textarea>
				</div>
				<div></div>
			</div>


	</div>

	<div class="form-header">
		<div class="form-actions">
			<button type="submit" class="btn-primary" name="register_member">
				<i class="fas fa-save"></i> Save
			</button>
			<button class="btn-secondary" onclick="location.reload()">
				<i class="fas fa-times"></i> Reset
			</button>
		</div>
	</div>
	</form>

	<br><br>
</body>

</html>