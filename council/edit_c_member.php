<?php
	include '../connection.php';

	echo "MEMBER ". $memberID = $_GET['mem_id'];
	echo "<br> GRP " .$groupID = $_GET['group'];


	$name =  $_POST['name'];
 	$gender =  $_POST['gender'];
 	$designation =  $_POST['designation'];
 	$contact_no =  $_POST['contact_no'];
 	$remarks =  $_POST['remarks'];
 	$elected_nominated =  $_POST['elected_nominated'];
	
	$sql = "UPDATE council_member SET 
			name = '$name', 
			gender = '$gender', 
			designation = '$designation', 
			contact_no = '$contact_no', 
			remarks = '$remarks', 
			elected_nominated = '$elected_nominated' 
			WHERE ID = '$memberID' and stationID  = '$STATION_CODE'";

	    if(mysqli_query($conn, $sql)){	
	    	header("Location:  committee_info.php?gID=$groupID");	
		} else{
		    echo "<br>ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
		}
?>