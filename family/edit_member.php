<?php
include '../config/connection.php';
$id = $_GET['id'];

$sql = "SELECT * FROM family_members WHERE ID = '$id'";
$result = $conn->query($sql);


// loop through the result set
while ($rows = $result->fetch_assoc()) {
	$family_ID = $rows['family_ID'];
	$status = $rows['status'];
	$status_remark = $rows['status_remark'];
	$name = $rows['name'];
	$surname = $rows['surname'];
	$dob = $rows['dob'];
	$gender = $rows['gender'];
	$blood_group = $rows['blood_group'];
	$occupation = $rows['occupation'];
	$qualification = $rows['qualification'];
	$address = $rows['address'];
	$contact_no = $rows['contact_no'];
	$email = $rows['email'];
	$relation_with_head = $rows['relation_with_head'];
	$relationship_status = $rows['relationship_status'];
	$lang = $rows['lang'];
	$other_lang = $rows['other_lang'];
	$baptism = $rows['baptism'];
	$confirmation = $rows['confirmation'];
	$eucharist = $rows['eucharist'];
	$anointing_of_the_sick = $rows['anointing_of_the_sick'];
	$marriage = $rows['marriage'];
	$ration_card = $rows['ration_card'];
	$pan_card = $rows['pan_card'];
	$adhar_card = $rows['adhar_card'];
	$aayushman_bharat = $rows['aayushman_bharat'];
	$ladki_bahin_yogana = $rows['ladki_bahin'];
	$old_age_pension = $rows['old_age_pension'];
	$differently_able = $rows['differently_able'];
	$voter_id = $rows['voter_id'];
	$driving_license = $rows['driving_license'];
	$monthly_income = $rows['monthly_income'];
	$any_other = $rows['any_other'];
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<title>Edit Member</title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>

	<div class="pageName">
		<h3>EDIT MEMBER RECORD</h3>
	</div>
	<BR>
	<div class="form-section">
		<form id="" class="" method="post" action="update_member.php?member_code=<?php echo $id; ?>">
			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Member Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Family ID</label>
					<input type="text" name="family_ID" value="<?php echo $family_ID; ?>" readonly>
				</div>

				<div class="form-group">
					<label for="">Status</label>
					<select name="status">
						<option hidden><?php echo $status; ?></option>
						<option selected value="ACTIVE">ACTIVE</option>
						<option value="IN-ACTIVE">IN-ACTIVE</option>
						<option value="DECEASED">DECEASED</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Status Remark</label>
					<input type="text" name="status_remark" value="<?php echo $status_remark; ?>">
				</div>

			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="">Name</label>
					<input onblur="getLastName()" type="text" name="name" value="<?php echo $name; ?>">
				</div>
				<div class="form-group">
					<label for="">Surname</label>
					<input type="text" name="surname" id="surname" value="<?php echo $surname; ?>">
				</div>
				<div class="form-group">
					<label for="">Date of birth</label>
					<input type="text" name="dob" class="auto-format-date" placeholder="dd/mm/yyyy"
						value="<?php echo $dob; ?>">
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="">Gender</label>
					<select name="gender">
						<option hidden><?php echo $gender; ?></option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">blood group</label>
					<select id="blood_group" name="blood_group">
						<option hidden><?php echo $blood_group; ?></option>
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
					<input type="text" name="qualification" value="<?php echo $qualification; ?>">
				</div>
				<div class="form-group">
					<label for="">Occupation</label>
					<input type="text" name="occupation" value="<?php echo $occupation; ?>">
				</div>
				<div class="form-group">
					<label for="">mother TONGUE</label>
					<select name="lang">
						<option hidden><?php echo $lang; ?></option>
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
					<input type="text" name="other_lang" value="<?php echo $other_lang; ?>">
				</div>

				<div class="form-group">
					<label for="">Relation with Head</label>
					<select id="relations" name="relation_with_head">
						<option hidden><?php echo $relation_with_head; ?></option>
						<option>Husband</option>
						<option>Wife</option>
						<option>Father</option>
						<option>Mother</option>
						<option>Son</option>
						<option>Daughter</option>
						<option>Brother</option>
						<option>Sister</option>
						<option>Grandfather</option>
						<option>Grandmother</option>
						<option>Uncle</option>
						<option>Aunt</option>
						<option>Cousin</option>
						<option>Nephew</option>
						<option>Niece</option>
						<option>Son-in-Law</option>
						<option>Daughter-in-Law</option>
						<option>Daughter-in-Law</option>
						<option>Father-in-Law</option>
						<option>Mother-in-Law</option>
						<option>Brother-in-Law</option>
						<option>Sister-in-Law</option>
						<option>Step Father</option>
						<option>Step Mother</option>
						<option>Step Brother</option>
						<option>Step Sister</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Relationship Status</label>
					<select name="relationship_status">
						<option hidden><?php echo $relationship_status; ?></option>
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
					<input type="email" name="email" value="<?php echo $email; ?>">
				</div>
				<div class="form-group">
					<label for="">Phone No.</label>
					<input type="text" name="contact_no" id="contact_no" value="<?php echo $contact_no; ?>">
				</div>
				<div class="form-group">
					<label for="">address</label>
					<textarea name="address" id="address" rows="2" cols="20"><?php echo $address; ?></textarea>
				</div>
			</div>


			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Sacramental Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Baptism</label>
					<select name="baptism">
						<option hidden><?php echo $baptism; ?></option>
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Confirmation</label>
					<select name="confirmation">
						<option hidden><?php echo $confirmation; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Holy Communion</label>
					<select name="eucharist">
						<option hidden><?php echo $eucharist; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>

			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Anointing of the Sick</label>
					<select name="annointing_of_the_sick">
						<option hidden><?php echo $anointing_of_the_sick; ?></option>
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Marriage</label>
					<select name="marriage">
						<option hidden><?php echo $marriage; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">

				</div>
			</div>
			<div class="form-section-header" style="margin-bottom: 2px;">
				<h3>Government Entitlements</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Ration Card</label>
					<select name="ration_card">
						<option hidden><?php echo $ration_card; ?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">PAN Card</label>
					<select name="pan_card">
						<option hidden><?php echo $pan_card; ?></option>
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Aadhar Card</label>
					<select name="adhar_card">
						<option hidden><?php echo $adhar_card; ?></option>
						<option value="Yes" selected>Yes</option>
						<option value="No">No</option>
					</select>
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Aayushman Bharat (PM-JAY)</label>
					<select name="aayushman_bharat">
						<option hidden><?php echo $aayushman_bharat; ?></option>
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Ladki Bahin Yogana</label>
					<select name="ladki_bahin_yogana">
						<option hidden><?php echo $ladki_bahin_yogana; ?></option>
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Old Age Pension/Niradhar Yojana</label>
					<select name="old_age_pension">
						<option hidden><?php echo $old_age_pension; ?></option>
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Differently Able Person</label>
					<select name="differently_able">
						<option hidden><?php echo $differently_able; ?></option>
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Voter ID</label>
					<select name="voter_id">
						<option hidden><?php echo $voter_id; ?></option>
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Driving License</label>
					<select name="driving_license">
						<option hidden><?php echo $driving_license; ?></option>
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">Monthly Income</label>
					<input type="text" name="monthly_income" value="<?php echo $monthly_income; ?>">
				</div>
				<div class="form-group">
					<label for="">Any Other/Remark</label>
					<textarea name="any_other" id="any_other" rows="2" cols="20"><?php echo $any_other; ?> </textarea>
				</div>
				<div></div>
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
	<br><br>
</body>

</html>