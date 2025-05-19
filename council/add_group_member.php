<?php

include '../config/connection.php';

$groupid = $_GET['id'];
$name = mysqli_real_escape_string($conn, $_POST['name']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
$designation = mysqli_real_escape_string($conn, $_POST['designation']);
$nominated_elected = mysqli_real_escape_string($conn, $_POST['nominated_elected']);
$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);



$sql = "INSERT INTO council_member VALUES(
		'',
		'$STATION_CODE',
		'$groupid',		
		'$name',
		'$gender',
		'$contact_no',
		'$designation',
		'$nominated_elected',
		'$remarks')";
if (mysqli_query($conn, $sql)) {
	echo "
			<script>
			    alert('A new member has been added.');			    	
			</script>";
	header("Location: add_member.php?id=$groupid");

} else {
	echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
}


?>