<?php
		// This below file will act as an engine between the client side and server side. It will create connection between the databse and the html form.
		include '../connection.php';
		// Taking all  values from the form data(input).
		
		if (isset($_POST['post_bpt_frm'])) {			
			$reg_no = mysqli_real_escape_string($conn, $_REQUEST['reg_no'] . "/" . $_REQUEST['reg_year']);
			$reg_year = $_REQUEST['reg_year'];
			$baptism_date = $_REQUEST['baptism_dt'];		
			$dob = $_REQUEST['dob'];
			$gender = $_REQUEST['gender'];
			$name = $_REQUEST['name'];
			$surname = mysqli_real_escape_string($conn,$_REQUEST['surname']);
			$father_name = mysqli_real_escape_string($conn,$_REQUEST['father_name']);
			$mother_name = mysqli_real_escape_string($conn,$_REQUEST['mother_name']);
			$father_nationality = $_REQUEST['nationality'];
			$address = mysqli_real_escape_string($conn,$_REQUEST['address']);
			$father_occupation = $_REQUEST['father_occupation'];
			$godfather_name = mysqli_real_escape_string($conn,$_REQUEST['godfather_name']);
			$godfather_address = mysqli_real_escape_string($conn,$_REQUEST['godfather_address']);
			$godmother_name = mysqli_real_escape_string($conn,$_REQUEST['godmother_name']);
			$godmother_address = mysqli_real_escape_string($conn,$_REQUEST['godmother_address']);
			$church_name = mysqli_real_escape_string($conn,$_REQUEST['place_of_baptism']);
			$minister_name = mysqli_real_escape_string($conn,$_REQUEST['minister_name']);
			$communion = mysqli_real_escape_string($conn,$_REQUEST['communion']);
			$confirmation = mysqli_real_escape_string($conn,$_REQUEST['confirmation']);
			$marriage = mysqli_real_escape_string($conn,$_REQUEST['marriage']);
			$remarks =  mysqli_real_escape_string($conn,$_REQUEST['remarks']);
			$fullname = $name . ' ' . $surname;
			$created_on = date("d" . "-" . "m" ."-" . "y" . " " . "h:i a");

			// Performing insert query 

			$sql = "INSERT INTO baptism VALUES(			
				'$reg_no',
				'$reg_year',
				'$baptism_date',
				'$dob',
				'$gender',
				'$name',
				'$surname',
				'$father_name',
				'$mother_name',
				'$father_nationality',	
				'$address',		
				'$father_occupation', 		
				'$godfather_name', 
				'$godfather_address',
				'$godmother_name', 
				'$godmother_address', 
				'$church_name', 
				'$minister_name',
				'$communion', 
				'$confirmation',
				'$marriage', 
				'$remarks',
				'Baptism',
				'$fullname','','$created_on', '$USERNAME', '$STATION_CODE')";
			
	       if(mysqli_query($conn, $sql)){	
			    echo "
			    <script>
			    	alert('A new baptism record has been created.');
			    </script>"; 	     
			    header("Location: baptism_reg.php");
	        } else{
	            echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	        }          
	    }
?>