<?php

include '../config/connection.php';
$tenure = $_GET['id'];
if (isset($_POST['update_tenure'])) {
	echo $start_d = $_POST['start_dt'];
	echo $end_d = $_POST['end_dt'];

	$sql = "UPDATE council_master_table SET 
 		start_date = '$start_d', end_date = '$end_d'
 		WHERE ID = '$tenure' ";

	if (mysqli_query($conn, $sql)) {
		header("Location:  index.php");
	} else {
		echo "<br>ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
}

if (isset($_POST['delete_tenure'])) {

	$sql = "DELETE FROM council_master_table WHERE ID = '$tenure' ";

	if (mysqli_query($conn, $sql)) {
		header("Location:  index.php");
	} else {
		echo "<br>ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}


}

?>