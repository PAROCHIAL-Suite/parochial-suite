<?php
include '../config/connection.php';

$memberID = $_GET['mem_id'];
$groupID = $_GET['group'];


$name = $_POST['name'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$contact_no = $_POST['contact_no'];
$remarks = $_POST['remarks'];
$elected_nominated = $_POST['elected_nominated'];

$sql = "UPDATE council_member SET 
			name = '$name', 
			gender = '$gender', 
			designation = '$designation', 
			contact_no = '$contact_no', 
			remarks = '$remarks', 
			nominated_elected = '$elected_nominated' 
			WHERE ID = '$memberID' and stationID  = '$STATION_CODE'";

if (mysqli_query($conn, $sql)) {
	// header("Location:  committee_info.php?gID=$groupID");
	echo "<script>alert('Member details updated successfully');</script>";
	echo "<script>window.location.href='member_list.php?gID=$groupID';</script>";
	exit;
} else {
	echo "<br>ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
}
?>