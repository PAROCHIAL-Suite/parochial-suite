<?php

	include '../connection.php';
	echo "<br>". $priest_id = $_GET['id'];


		echo "<br>". $name = mysqli_real_escape_string($conn,$_POST['name']);
		echo "<br>".$designation = mysqli_real_escape_string($conn,$_POST['designation']);
		
		$start_date = $_POST['start_date'];

		 $end_date = $_POST['end_date'];
		

		$sql = "UPDATE priest SET name = '$name', designation =  '$designation', 
		start_date = '$start_date', end_date = '$end_date' WHERE ID = '$priest_id' 
		AND stationID = '$STATION_CODE'";

	    if(mysqli_query($conn, $sql)){	
     		echo "<script>alert('Record updated');</script>";
     		header("Location: index.php");
	    } else{
	            echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	    } 
	
?>