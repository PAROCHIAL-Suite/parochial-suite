<?php
	include "../connection.php";
    echo "<br>" .$id = $_GET['id'];
	echo "<br>" .$family_name = mysqli_real_escape_string($conn,$_POST['family_name']);
	echo "<br>" .$address = $_POST['address'];
	echo "<br>" .$area_code = $_POST['area_code'];
	echo "<br>" .$status = $_POST['status'];

	$sql = "UPDATE family_master_table SET 
			family_name = '$family_name', address = '$address', area_code ='$area_code',
			modify_date = '$date',status = '$status', edited_by = '$USERNAME' 
			WHERE family_ID = '$id'";
			
		
	if(mysqli_query($conn, $sql)){					
	//header("Location: edit_family.php?id=$id");
	} else{
		echo "ERROR: <code>UNABLE_TO_REG_FAMILY</code>";
	   echo "<br>" . "$sql. " . mysqli_error($conn);
	}

	$sql = "UPDATE family_member SET 
		surname = '$family_name', status = '$status',
		address = '$address', area_code ='$area_code', modify_date = '$date', edited_by = '$USERNAME' WHERE family_ID = '$id'";
			
		
	if(mysqli_query($conn, $sql)){					
		header("Location: view_family.php?id=$id");
	} else{
		echo "ERROR: <code>UNABLE_TO_REG_FAMILY</code>";
	    echo "<br>" . "$sql. " . mysqli_error($conn);
	}	 		

	

?>