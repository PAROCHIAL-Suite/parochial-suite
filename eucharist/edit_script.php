
<?php
include('../connection.php');

    $year = date("Y");
    $idGet = $_GET['id'];

	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$surname = mysqli_real_escape_string($conn,$_POST['surname']);
	$dob = mysqli_real_escape_string($conn,$_POST['dob']);
	$father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
	$mother_name = mysqli_real_escape_string($conn,$_POST['mother_name']);
	$baptism_reg = mysqli_real_escape_string($conn,$_POST['baptism_reg']);
	$baptism_date = mysqli_real_escape_string($conn,$_POST['baptism_date']);
	$baptism_parish = mysqli_real_escape_string($conn,$_POST['baptism_parish']);
	$address = mysqli_real_escape_string($conn,$_POST['p_address']);
	$church_of_eucharist = mysqli_real_escape_string($conn,$_POST['church_of_eucharist']);
	$minister_name = mysqli_real_escape_string($conn,$_POST['minister_name']);
	$parish_priest = mysqli_real_escape_string($conn,$_POST['parish_priest']);
	$date = $_POST['date'];

	$todayDate = date("d-M-Y");
	$sql ="UPDATE eucharist SET
		name = '$name',
		surname = '$surname',
		dob = '$dob',
		father_name = '$father_name',
		mother_name = '$mother_name',
		baptism_reg_no = '$baptism_reg',
		baptism_date = '$baptism_date',
		baptism_parish = '$baptism_parish' ,
		parish_address = '$address ',
		church_of_comunion = '$church_of_eucharist' ,
		minister = '$minister_name',
		parish_priest = '$parish_priest',
		date_of_communion = '$date',
		updated_on = '$todayDate', author = '$USERNAME'	WHERE id = '$idGet' and stationID = '$STATION_CODE'";
		
    	if(mysqli_query($conn, $sql)){	
    			header("Location: ../eucharist/search_communion.php");     
    			
    	} else{
    	         echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
    	}    


?>