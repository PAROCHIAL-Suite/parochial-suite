<?php

include '../config/connection.php';

$mid = $_GET['member_code'];
$family_ID = $_REQUEST['family_ID'];
//$area_code = $_GET['area_code'];
$status = $_REQUEST['status'];
$status_remark = $_REQUEST['status_remark'];
$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
$surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);

// FORMATING DATE IN DD-MM-YYYY
$dob = mysqli_real_escape_string($conn, $_REQUEST['dob']);

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
$anointing_of_the_sick = mysqli_real_escape_string($conn, $_REQUEST['anointing_of_the_sick']);
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


$sql = "UPDATE family_member set
		family_ID = '$family_ID',
		status = '$status',		
		status_remark = '$status_remark',		
		name = '$name',
		surname = '$surname',
		dob = '$dob',
		gender = '$gender',
		blood_group = '$blood_grp',
		occupation = '$occupation',
		qualification = '$qualification',
		address = '$address', 
		contact_no ='$contact_no',
		email = '$email',
		relation_with_head ='$relation_with_head',
		relationship_status = '$relationship_status',
		lang = '$lang',
		other_lang ='$other_lang',
		baptism ='$baptism',
		confirmation = '$confirmation',
		eucharist ='$eucharist',
		anointing_of_the_sick = '$anointing_of_the_sick',
		marriage = '$marriage',
		ration_card ='$ration_card',
		pan_card = '$pan_card', 
		adhar_card = '$adhar_card',
		aayushman_bharat = '$aayushman_bharat',
		ladki_bahin ='$ladki_bahin_yogana',
		old_age_pension = '$old_age_pension',
		differently_able ='$differently_able',
		voter_id = '$voter_id', 
		driving_license = '$driving_license',
		monthly_income ='$monthly_income',
		any_other ='$any_other',
		modify_date = '$date',
		edited_by = '$USERNAME'
		WHERE ID = '$mid' AND stationID = '$STATION_CODE'";

if (mysqli_query($conn, $sql)) {
	header("Location: member_list.php");
} else {
	echo "ERROR: <code>UNABLE_TO_REG_MEMBER</code>\n";
	echo "\n\n$sql. " . mysqli_error($conn);
}

?>