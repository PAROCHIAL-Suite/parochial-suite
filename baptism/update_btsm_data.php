<?php 

	include '../connection.php';
	$id = $_GET['id'];



	if (isset($_POST['add_remark'])) {
	    	$rmk = $_POST['new_remarks'];
		$sql = "UPDATE baptism SET remarks = '$rmk' WHERE reg_no = '$id'";
		if(mysqli_query($conn, $sql)){	 	     
			header("Location: btsm_detail.php?id=$id");
		}
	    	else{echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
		}
	}
	

	if (isset($_POST['update_btsm_info'])) {
			echo $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
			$regyear = $_POST['reg_year'];
			$baptism_date = $_REQUEST['baptism_dt'];		

			$dob = $_REQUEST['dob'];

			$gender = $_POST['gender'];
			$name = $_POST['name'];
			$surname = mysqli_real_escape_string($conn,$_POST['surname']);
			$father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
			$mother_name = mysqli_real_escape_string($conn,$_POST['mother_name']);
			$father_nationality = $_POST['father_nationality'];
			$address = mysqli_real_escape_string($conn,$_POST['address']);
			$father_occupation = $_POST['father_occupation'];
			$godfather_name = mysqli_real_escape_string($conn,$_POST['godfather_name']);
			$godfather_address = mysqli_real_escape_string($conn,$_POST['godfather_address']);
			$godmother_name = mysqli_real_escape_string($conn,$_POST['godmother_name']);
			$godmother_address = mysqli_real_escape_string($conn,$_POST['godmother_address']);
			$church_name = mysqli_real_escape_string($conn,$_POST['church_name']);
			$minister_name = mysqli_real_escape_string($conn,$_POST['minister_name']);
			$communion = mysqli_real_escape_string($conn,$_POST['communion']);
			$confirmation = mysqli_real_escape_string($conn,$_POST['confirmation']);
			$marriage = mysqli_real_escape_string($conn,$_POST['marriage']);
			$remarks =  mysqli_real_escape_string($conn,$_POST['remarks']);

			$last_update = date("d" ."-" . "M" . '-' ."Y");
			$sql = "
			UPDATE baptism 
			SET 
			reg_no ='$reg_no',
			stationID = '$STATION_CODE',						
			baptism_date = '$baptism_date',
			dob = '$dob',
			gender = '$gender',
			name = '$name',
			surname = '$surname',
			father_name = '$father_name',
			mother_name = '$mother_name',
			father_nationality = '$father_nationality',	
			address = '$address',		
			father_occupation = '$father_occupation', 		
			godfather_name  = '$godfather_name', 
			godfather_address = '$godfather_address',
			godmother_name = '$godmother_name', 
			godmother_address = '$godmother_address', 
			church_name = '$church_name', 
			minister_name = '$minister_name',
			communion = '$communion', 
			confirmation = '$confirmation',
			marriage = '$marriage', 
			remarks = '$remarks',
			last_update = '$last_update'
			WHERE reg_no = '$id'";
			
	       if(mysqli_query($conn, $sql)){	
			    echo "
			    <script>
			    	alert('A new baptism record has been created.');
			    </script>"; 	     
			    header("Location: sacrament_search_index.php?id=$id");
	        } else{
	            echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	        }        
		
	}

?>
