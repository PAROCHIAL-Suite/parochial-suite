<?php
	include '../connection.php';
	$id = $_GET['id'];
	$s_date = $_GET['s_date'];
	$e_date = $_GET['e_date'];

	if (isset($_POST['create_group'])){
		$group_name = mysqli_real_escape_string($conn,$_POST['group_name']);
		$tid = $_POST['termIDTxt'];
		$sql = "INSERT INTO council_group VALUES('','$id','$STATION_CODE','$group_name'
			)";

	    if(mysqli_query($conn, $sql)){	
	    	header("Location:  add_group.php?id=$id&s_date=$s_date&e_date=$e_date");	
		} else{
		    echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
		}
	}


?>