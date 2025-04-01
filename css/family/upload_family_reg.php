<!-- code to upload data to server -->


<?php
		
	include '../connection.php';
if (isset($_POST['variable'])) {
	// code...
	$f_ID = mysqli_real_escape_string($conn,$_REQUEST['f_ID']);
	$family_name = mysqli_real_escape_string($conn,$_REQUEST['family_name']);
	$address = mysqli_real_escape_string($conn,$_REQUEST['address']);
	$area_code = mysqli_real_escape_string($conn,$_REQUEST['area_code']);

	//$reg_by = mysqli_real_escape_string($conn,$_REQUEST['reg_by']);
	//$address_of_parish = mysqli_real_escape_string($conn,$_REQUEST['address_of_parish']);
	
	$fam_ID = $area_code . "-" . $f_ID;

	$date = date("d/m/Y");

	$sql = "INSERT INTO family_master_table VALUES(
		'','$fam_ID', '$family_name','$address', '$area_code', '$date')" ;	
	
	if(mysqli_query($conn, $sql)){			
		//header("Location: success_reg_dialog.php?query=$fam_ID");
	} else{
		echo "ERROR: <code>UNABLE_TO_REG_FAMILY</code>";
	    echo "\n$sql. " . mysqli_error($conn);
	}	


	$sql = "SELECT COUNT(*) as total FROM family_master_table";
	$result = $conn->query($sql);
	if ($result) {
	    // Fetch the result as an associative array
	    $row = $result->fetch_assoc();
	    $total = $row['total'];    
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	



	$fid =  $area_code . "-" .   $total;
	$member_ID =  $fid. "-" . $_REQUEST['member_ID'] ;
	$status = $_REQUEST['status'];
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
		'$member_ID',
		'$area_code',
		'$status',		
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
		'$any_other','','')";
	
    if(mysqli_query($conn, $sql)){	
		header("Location: family_tree.php?family_id=$fid");
	} else{
		echo "ERROR: <code>UNABLE_TO_REG_MEMBER</code>\n";
	    echo "\n\n$sql. " . mysqli_error($conn);
	}    
}
?>
