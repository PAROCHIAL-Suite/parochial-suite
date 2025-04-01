
<?php
	include '../connection.php';
	$id = $_GET['id'];
	
	
	$sql = "SELECT * FROM family_member WHERE family_ID = '$id' AND relation_with_head = 'Head'";
	$result = $conn->query($sql);
			 
	while ($rows=$result->fetch_assoc()){ 		
		$family_name = $rows['surname']; 	
		$family_ID = $rows['family_ID']; 	
		$area = $rows['area_code']; 	
		$head = $rows['name'] . " " . $rows['surname'];
		$contact_no = $rows['contact_no'];
		$address = $rows['address'];
	}
	
if (isset($_POST['register_member'])) {	// code...

	$fid =  $_GET['id'];
	$area_code = $area;
	$status = $_REQUEST['status'];
	$status_remark = $_REQUEST['status_remark'];
	$name = mysqli_real_escape_string($conn,$_REQUEST['name']);
	$surname = mysqli_real_escape_string($conn,$_REQUEST['surname']);
	$dob = mysqli_real_escape_string($conn,$_REQUEST['dob']);
	$gender = mysqli_real_escape_string($conn,$_REQUEST['gender']);
	$blood_grp = $_POST['blood_group'];
	$occupation = mysqli_real_escape_string($conn,$_REQUEST['occupation']);
	$qualification = mysqli_real_escape_string($conn,$_REQUEST['qualification']);
	$address = mysqli_real_escape_string($conn,$_REQUEST['address']);
	$contact_no = mysqli_real_escape_string($conn,$_REQUEST['contact_no']);
	$email = mysqli_real_escape_string($conn,$_REQUEST['email']);
	$relation_with_head = mysqli_real_escape_string($conn,$_REQUEST['relation_with_head']);
	$relationship_status = mysqli_real_escape_string($conn,$_REQUEST['relationship_status']);
	$lang = mysqli_real_escape_string($conn,$_REQUEST['lang']);
	$other_lang = mysqli_real_escape_string($conn,$_REQUEST['other_lang']);
	$baptism = mysqli_real_escape_string($conn,$_REQUEST['baptism']);
	$confirmation = mysqli_real_escape_string($conn,$_REQUEST['confirmation']);
	$eucharist = mysqli_real_escape_string($conn,$_REQUEST['eucharist']);
	$marriage = mysqli_real_escape_string($conn,$_REQUEST['marriage']);
	$annointing_of_the_sick = mysqli_real_escape_string($conn,$_REQUEST['annointing_of_the_sick']);
	$ration_card = mysqli_real_escape_string($conn,$_REQUEST['ration_card']);
	$pan_card = mysqli_real_escape_string($conn,$_REQUEST['pan_card']);
	$adhar_card = mysqli_real_escape_string($conn,$_REQUEST['adhar_card']);
	$aayushman_bharat = mysqli_real_escape_string($conn,$_REQUEST['aayushman_bharat']);
	$ladki_bahin_yogana = mysqli_real_escape_string($conn,$_REQUEST['ladki_bahin_yogana']);
	$old_age_pension = mysqli_real_escape_string($conn,$_REQUEST['old_age_pension']);
	$differently_able = mysqli_real_escape_string($conn,$_REQUEST['differently_able']);
	$voter_id = mysqli_real_escape_string($conn,$_REQUEST['voter_id']);
	$driving_license = mysqli_real_escape_string($conn,$_REQUEST['driving_license']);
	$monthly_income = mysqli_real_escape_string($conn,$_REQUEST['monthly_income']);
	$any_other = mysqli_real_escape_string($conn,$_REQUEST['any_other']);

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
	
	if(mysqli_query($conn, $sql)){
//		header("Location: family_list.php");
		echo "<script>alert('A new member has been added.');</script>"; 
		header("Location: view_family.php?id=$family_ID");
	}
	else{
		echo "ERROR: <code>UNABLE_TO_REG_MEMBER</code>\n";
		echo "\n\n$sql. " . mysqli_error($conn);
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
				<td width="40%"><h3>ADD A MEMBER</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<div class="actionBar">
		<table width="100%" border="0" style="text-wrap: wrap;">
			<tr>
				<td width="10%"><b>Family Name</b></td>
				<td width="10%"><b>Family ID</b></td>
				<td width="10%"><b>Area Code</b></td>
				<td width="20%"><b>Head of family</b></td>
				<td width="10%"><b>Contact</b></td>
				<td width="20%"><b>Address</b></td>
			</tr>

			<tr>
				<td ><h4><span style="color: var(--txtblue);">
					<?php echo  $family_name; ?></span></h4></td>
				<td><?php echo  $family_ID; ?></td>
				<td><?php echo  $area; ?></td>
				<td><?php echo  $head; ?></td>
				<td><?php echo  $contact_no; ?></td>
				<td><?php echo  $address; ?></td>
			</tr>
		</table>		
	</div>	
	<br><br>

	
    
	<div>
		<form id="" class="" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="100%"  border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="4" ><h4>Baisc Details</h4></td>
			</tr><tr></tr><tr></tr>
			<tr>		
				<td width="20%"><p>Status</p></td>
				<td width="20%">
					<select name="status">
						<option selected value="ACTIVE">ACTIVE</option>
						<option value="IN-ACTIVE">IN-ACTIVE</option>
						<option value="DECEASED">DECEASED</option>
					</select>
				</td>
				<td width="20%"><P>Status remark</p></td>
				<td><input type="text" name="status_remark" ></td></td>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<td><p>NAME</p></td>
				<td><input onblur="getLastName()"  type="text" name="name" required></td>
										
				<td><p>SURNAME</p></td>
				<td><input type="text" name="surname" id="surname" value="<?php echo $family_name; ?>" required></td>				
			</tr>

			<tr>
				<td><p>DATE OF BIRTH</p></td>
				<td><input type="text" name="dob" placeholder="dd/mm/yyyy"></td>
			</tr>
			<tr>				
				<td><p>GENDER</p></td>
				<td> 
					<select name="gender" style="width: 140px;">
						<option hidden>Choose</option> 
						<option value="Male">Male</option>
						<option value="Female">Female</option> 
					</select> 
				</td>
							
				<td><p>BLOOD GROOP</p></td>
				<td>
					<select id="blood_group" name="blood_group" style="width: 140px;">				<option hidden>--</option>	
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
				<td><p>OCCUPATION</p></td>
				<td><input type="text" name="occupation"></td>					
											
				<td><p>QUALIFICATION</p></td>
				<td><input type="text" name="qualification"></td>					
			</tr>					
			<tr>				
				<td><p>ADDRESS</p></td>
				<td><input type="text" name="address" id="m_address"  value="<?php echo $address; ?>"></td>					
			</tr>	
			<tr>
				<td><p>CONTACT NO.</p></td>
				<td><input type="text" name="contact_no"></td>
							
				<td><p>EMAIL ID</p></td>
				<td><input type="email" name="email"></td>
			</tr>				
			<tr>
				<td><p>RELATIION WITH HEAD</p></td>
				<td>
					<select id="relations" name="relation_with_head">
						<option hidden>--</option>	
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
				<td><p>RELATIONSHIP STATUS</p></td>
				<td>
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
				</td>
			</tr>		
			<tr>
				<td><p>MOTHER LONGUE</p></td>
				<td>
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
				</td>
							
				<td><p>KNOWN LANGUAGES</p></td>
				<td><input type="text" name="other_lang"></td>
			</tr>											
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td colspan="4"><h4>Sacrament Details</h4></td>
			</tr><tr></tr>
			<tr>
				<td><p>BAPTISM</p></td>
				<td>
					<select name="baptism">
						
						<option selected value="Yes">Yes</option><option value="No">No</option>
					</select>
				</td>
							
				<td><p>CONFIRMATION</p></td>
				<td>
					<select name="confirmation">
						
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><p>COMMUNION</p></td>
				<td>
					<select name="eucharist">
						
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</td>
				<td><p>ANNOINTING OF THE SICK</p></td>
				<td>
					<select name="annointing_of_the_sick">
						
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><p>MARRIAGE</p></td>
				<td>
					<select name="marriage">
						
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select></td>
			</tr>			
			<tr>
				<td colspan="4"><h4>Govenment Entitlements</h4></td>
			</tr><tr></tr>												
			<tr>
				<td><p>RATION CARD</p></td>
				<td>
					<select name="ration_card">						
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</td>

				<td><p>PAN CARD</p></td>
				<td>
					<select name="pan_card">						
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select></td>
			</tr>
			<tr>
				<td><p>ADHAR CARD</p></td>
				<td>
					<select name="adhar_card">
						<option value="Yes" selected>Yes</option>
						<option value="No">No</option>
					</select>
				</td>

				<td><p>AAYUSHMAN BHARAT (PM-JAY)</p></td>
				<td>
					<select name="aayushman_bharat">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</td>
			</tr>						
			<tr>
				<td><p>LADKI BAHIN YOGANA</p></td>
				<td>
					<select name="ladki_bahin_yogana">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</td>

				<td><p>OLD AGE PENSION/NIRADHAR YOJANA</p></td>
				<td>
					<select name="old_age_pension">
						<option  value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</td>
			</tr>						
			<tr>
				<td><p>DIFFERENTLY ABLE PERSON</p></td>
				<td>
					<select name="differently_able">
						<option value="Yes">Yes</option>
						<option selected value="No">No</option>
					</select>
				</td>

				<td><p>VOTER ID</p></td>
				<td>
					<select name="voter_id">
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</td>
			</tr>						
			<tr>
				<td><p>DRIVING LICENSE</p></td>
				<td>
					<select name="driving_license">
						<option selected value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</td>

				<td><p>MONTHLY INCOME</p></td>
				<td><input type="text" name="monthly_income"></select></td>
			</tr>				
			<tr>
				<td><p>ANY OTHER/REMARK</p></td>
				<td><input type="text" name="any_other" > </td>
			</tr>						
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td></td>
				<td> <input type="submit" name="register_member" id="saveFrm" value="Save"></td>
				<td></td>
			</tr>
		</table>		
	</form>  
</div>
	<br><br>
</div>
</body>
</html>


