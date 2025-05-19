<?php

include '../config/connection.php';
if (isset($_POST['register_member'])) {
	// code...

	$fid = $_GET['id'];
	$member_ID = $_REQUEST['member_ID'];
	$area_code = $_GET['area_code'];
	$status = $_REQUEST['status'];
	$status_remark = $_REQUEST['status_remark'];
	$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
	$surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);
	$dobRF = mysqli_real_escape_string($conn, $_REQUEST['dob']);
	$dob = reformatDate($dobRF);
	$gender = mysqli_real_escape_string($conn, $_REQUEST['gender']);
	$blood_grp = $_POST['blood_group'];
	$occupation = mysqli_real_escape_string($conn, $_REQUEST['occupation']);
	$qualification = mysqli_real_escape_string($conn, $_REQUEST['qualification']);
	$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
	$contact_no = mysqli_real_escape_string($conn, $_REQUEST['contact_no']);
	$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
	$relation_with_head = mysqli_real_escape_string($conn, $_REQUEST['relation_with_head']);
	$relationship_status = mysqli_real_escape_string($conn, $_REQUEST['relationship_status']);
	$lang = mysqli_real_escape_string($conn, $_REQUEST['lang']);
	$other_lang = mysqli_real_escape_string($conn, $_REQUEST['other_lang']);
	$baptism = mysqli_real_escape_string($conn, $_REQUEST['baptism']);
	$confirmation = mysqli_real_escape_string($conn, $_REQUEST['confirmation']);
	$eucharist = mysqli_real_escape_string($conn, $_REQUEST['eucharist']);
	$marriage = mysqli_real_escape_string($conn, $_REQUEST['marriage']);
	$annointing_of_the_sick = mysqli_real_escape_string($conn, $_REQUEST['annointing_of_the_sick']);
	$ration_card = mysqli_real_escape_string($conn, $_REQUEST['ration_card']);
	$pan_card = mysqli_real_escape_string($conn, $_REQUEST['pan_card']);
	$adhar_card = mysqli_real_escape_string($conn, $_REQUEST['adhar_card']);
	$aayushman_bharat = mysqli_real_escape_string($conn, $_REQUEST['aayushman_bharat']);
	$ladki_bahin_yogana = mysqli_real_escape_string($conn, $_REQUEST['ladki_bahin_yogana']);
	$old_age_pension = mysqli_real_escape_string($conn, $_REQUEST['old_age_pension']);
	$differently_able = mysqli_real_escape_string($conn, $_REQUEST['differently_able']);
	$voter_id = mysqli_real_escape_string($conn, $_REQUEST['voter_id']);
	$driving_license = mysqli_real_escape_string($conn, $_REQUEST['driving_license']);
	$monthly_income = mysqli_real_escape_string($conn, $_REQUEST['monthly_income']);
	$any_other = mysqli_real_escape_string($conn, $_REQUEST['any_other']);

	$sql = "INSERT INTO family_member VALUES(
		'',
		'$fid',
		'$member_ID',
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
		//		header("Location: family_list.php");
		// echo "<script>alert('A new Holy Communion record has been created.'); </script>"; 
	} else {
		echo "ERROR: <code>UNABLE_TO_REG_MEMBER</code>\n";
		echo "\n\n$sql. " . mysqli_error($conn);
	}
}
?>