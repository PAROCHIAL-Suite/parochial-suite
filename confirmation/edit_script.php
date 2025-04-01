<?php

$year = date("Y");

	include '../connection.php';
	$rID = $_POST['reg_no'];
	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$surname = mysqli_real_escape_string($conn,$_POST['surname']);
	$dob = mysqli_real_escape_string($conn,$_POST['dob']);
	$gender = mysqli_real_escape_string($conn,$_POST['gender']);
	$father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
	$mother_name = mysqli_real_escape_string($conn,$_POST['mother_name']);
	$baptism_reg = mysqli_real_escape_string($conn,$_POST['baptism_reg']);
	$baptism_date = mysqli_real_escape_string($conn,$_POST['baptism_date']);
	$baptism_parish = mysqli_real_escape_string($conn,$_POST['baptism_parish']);
	$address = mysqli_real_escape_string($conn,$_POST['p_address']);
	$church_of_confirmation = mysqli_real_escape_string($conn,$_POST['church_of_confirmation']);
	$minister_name = mysqli_real_escape_string($conn,$_POST['minister_name']);
	$parish_priest = mysqli_real_escape_string($conn,$_POST['parish_priest']);
	$date = $_POST['date'];

	$todayDate = date("d-M-Y");
	$sql ="UPDATE confirmation SET
		name = '$name',
		surname = '$surname',
		gender = '$gender',
		dob = '$dob',
		father_name = '$father_name',
		mother_name = '$mother_name',
		baptism_reg_no = '$baptism_reg',
		baptism_date = '$baptism_date',
		baptism_parish = '$baptism_parish' ,
		parish_address = '$address ',
		church_of_confirmation = '$church_of_confirmation',
		minister = '$minister_name',
		parish_priest = '$parish_priest',
		updated_on = '$todayDate', author = '$USERNAME'
		WHERE reg_no = '$rID' and stationID = '$STATION_CODE'";
	if(mysqli_query($conn, $sql)){	
		
		header("Location: search_confirmation.php");     
			
	} else{
	         echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}    


?>