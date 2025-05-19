<?php
include '../config/connection.php';
$id = $_GET['id'];

$sql = "SELECT * FROM family_member WHERE ID = '$id'";
$result = $conn->query($sql);

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
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<link rel="stylesheet" type="text/css" href="../print.css">
	<script src="../print.js"></script>
	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%">
					<h3>EDIT MEMBER</h3>
				</td>
			</tr>
		</table>
	</div>
	<br><br>

	<form id="" class="" method="post" action="update_member.php?member_code=<?php echo $id; ?>">

		<div class="form" style="width: 84%; margin:  auto;">
			<table width="100%" border="0" cellspacing="7" class=""
				style="font-family: 'Source Sans 3',sans-serif; margin: auto;">
				<tr>
					<td colspan="4">
						<h4>Baisc Details</h4>
					</td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td width="15%">
						<p>FAMILY ID</p>
					</td>
					<td><input type="text" name="family_ID" value="<?php echo $family_ID; ?>" readonly> </td>
				</tr>
				<tr>
					<td>
						<p>STATUS</p>
					</td>
					<td width="20%">
						<select name="status">
							<option hidden><?php echo $status; ?></option>
							<option value="ACTIVE">ACTIVE</option>
							<option value="IN-ACTIVE">IN-ACTIVE</option>
							<option value="DECEASED">DECEASED</option>
						</select>
					</td>
					<td width="19%">
						<P>STATUS REMARK</p>
					</td>
					<td><input type="text" name="status_remark" value="<?php echo $status_remark ?>"></td>
					</td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td>
						<p>NAME</p>
					</td>
					<td><input onblur="getLastName()" type="text" name="name" value="<?php echo $name; ?>" required>
					</td>
					<td>
						<p>SURNAME</p>
					</td>
					<td><input type="text" name="surname" id="surname" value="<?php echo $surname; ?>" required></td>
				</tr>
				<tr>
					<td>
						<p>DATE OF BIRTH</p>
					</td>
					<td><input type="text" name="dob" class="auto-format-date" value="<?php echo $dob; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>GENDER</p>
					</td>
					<td>
						<select name="gender" style="width: 140px;">
							<option hidden><?php echo $gender; ?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</td>

					<td>
						<p>BLOOD GROOP</p>
					</td>
					<td>
						<select id="blood_group" name="blood_group" style="width: 140px;">
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

					</td>
				</tr>
				<tr>
					<td>
						<p>OCCUPATION</p>
					</td>
					<td><input type="text" name="occupation" value="<?php echo $occupation; ?>"></td>
					<td>
						<p>QUALIFICATION</p>
					</td>
					<td><input type="text" name="qualification" value="<?php echo $qualification; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>ADDRESS</p>
					</td>
					<td><input type="text" name="address" id="m_address" value="<?php echo $address; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>CONTACT NO.</p>
					</td>
					<td><input type="text" name="contact_no" value="<?php echo $contact_no; ?>"></td>

					<td>
						<p>EMAIL ID</p>
					</td>
					<td><input type="email" name="email" value="<?php echo $email; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>RELATIION WITH HEAD</p>
					</td>
					<td>
						<select id="relations" name="relation_with_head">
							<option hidden><?php echo $relation_with_head ?></option>
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
						</select>
					</td>


					<td>
						<p>RELATIONSHIP STATUS</p>
					</td>
					<td>
						<select name="relationship_status">
							<option value=""><?php echo $relationship_status ?></option>
							<option value="Married">Married</option>
							<option value="Divorsed">Divorsed</option>
							<option value="Seperated">Seperated</option>
							<option value="Bachelor">Bachelor</option>
							<option value="Spinster">Spinster</option>
							<option value="Widower">Widower</option>
							<option value="Window">Widow</option>
							<option value="Priest">Priest</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>MOTHER LONGUE</p>
					</td>
					<td>
						<select name="lang">
							<option value="" hidden><?php echo $lang; ?></option>
							<option value="Hindi">Hindi</option>
							<option value="English">English</option>
							<option value="Marathi">Marathi</option>
							<option value="Tamil">Tamil</option>
							<option value="Telugue">Telugue</option>
							<option value="Malayalam">Malayalam</option>
						</select>
					</td>

					<td>
						<p>KNOWN LANGUAGES</p>
					</td>
					<td><input type="text" name="other_lang" value="<?php echo $other_lang; ?>"></td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td colspan="4">
						<h4>Sacrament Details</h4>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td>
						<p>BAPTISM</p>
					</td>
					<td>
						<select name="baptism">
							<option hidden><?php echo $baptism; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>

					<td>
						<p>CONFIRMATION</p>
					</td>
					<td>
						<select name="confirmation">
							<option hidden><?php echo $confirmation; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>COMMUNION</p>
					</td>
					<td>
						<select name="eucharist">
							<option hidden><?php echo $eucharist; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>

					<td>
						<p>ANNOINTING OF THE SICK</p>
					</td>
					<td>
						<select name="anointing_of_the_sick">
							<option hidden><?php echo $anointing_of_the_sick; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>MARRIAGE</p>
					</td>
					<td>
						<select name="marriage">
							<option hidden><?php echo $marriage; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<h4>Govenment Entitlements</h4>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td>
						<p>RATION CARD</p>
					</td>
					<td>
						<select name="ration_card">
							<option hidden><?php echo $ration_card; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					<td>
						<p>PAN CARD</p>
					</td>
					<td>
						<select name="pan_card">
							<option hidden><?php echo $pan_card; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>ADHAR CARD</p>
					</td>
					<td>
						<select name="adhar_card">
							<option hidden><?php echo $adhar_card; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>

					<td>
						<p>AAYUSHMAN BHARAT (PM-JAY)</p>
					</td>
					<td>
						<select name="aayushman_bharat">
							<option hidden><?php echo $aayushman_bharat; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>LADKI BAHIN YOGANA</p>
					</td>
					<td>
						<select name="ladki_bahin_yogana">
							<option hidden><?php echo $ladki_bahin_yogana; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>

					<td>
						<p>OLD AGE PENSION/NIRADHAR YOJANA</p>
					</td>
					<td>
						<select name="old_age_pension">
							<option hidden><?php echo $old_age_pension; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>DIFFERENTLY ABLE PERSON</p>
					</td>
					<td>
						<select name="differently_able">
							<option hidden><?php echo $differently_able; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>

					<td>
						<p>VOTER ID</p>
					</td>
					<td>
						<select name="voter_id">
							<option hidden><?php echo $voter_id; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>DRIVING LICENSE</p>
					</td>
					<td>
						<select name="driving_license">
							<option hidden><?php echo $driving_license; ?></option>
							<option>Yes</option>
							<option>No</option>
						</select>
					</td>

					<td>
						<p>MONTHLY INCOME</p>
					</td>
					<td><input type="text" name="monthly_income" value="<?php echo $monthly_income; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>ANY OTHER</p>
					</td>
					<td><input type="text" name="any_other" value="<?php echo $any_other; ?>"> </td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td></td>
					<td><input type="submit" name="update_family_member" id="saveFrm" value="Save Changes"
							style="width: 120px;"></td>
					<td></td>
				</tr>
			</table>
	</form>
	</div>
	<br><br>


	</div>
</body>

</html>