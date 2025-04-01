<?php 
	
	include '../connection.php';
	$del_mem_id = $_GET['id'];
	$groupID = $_GET['famID'];

	$sql = "DELETE FROM family_member WHERE ID = '$del_mem_id' ";


	if(mysqli_query($conn, $sql)){	
	   	header("Location:  view_family.php?id=$groupID");	
	} else{
	    echo "<br>ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
	
?>