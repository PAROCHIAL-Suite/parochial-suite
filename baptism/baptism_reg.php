<?php
    include '../connection.php';
    $sql = "SELECT * FROM parish_info WHERE stationID = '$STATION_CODE'";
    $result = $conn->query($sql);
    if ($result) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();
    	@$parishName = $row['p_name'];
    }
    ?>      
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%" ><h3>REGISTRATION OF BAPTISM</h3></td>
			</tr>
		</table>
	</div>
<br>

	<form id="baptism_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<table   border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="4" ><h4>Baptism Registration</h4></td>
			</tr>
			<tr>
				<td width="25%"><p>REGISTRATION NO.</p></td>
				<td>
					<input type="text" name="reg_no" placeholder="No." style="width: 80px;" required> /
					 <input type="text" name="reg_year" placeholder="Year." style="width: 80px;" required></td>
			</tr>
			<tr>				
				<td><p>DATE OF BAPTISM</p></td>
				<td><input type="text" name="baptism_dt" class="auto-format-date"  placeholder="dd/mm/yyyy" ></td>
			</tr>
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td colspan="4"><h4>Neophytes Details</h4></td>
			</tr><tr></tr>
			<tr>
				<td><p>NAME</p></td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>				
				<td><p>SURNAME</p></td>
				<td><input type="text" name="surname"></td>				
			</tr>

			<tr>
				<td><p>DATE OF BIRTH</p></td>
				<td><input type="text" name="dob" class="auto-format-date" placeholder="dd/mm/yyyy"></td>
			</tr>
			<tr>				
				<td><p>GENDER</p></td>
				<td> <select name="gender"><option hidden>Choose Gender</option> <option value="Male">Male</option><option value="Female">Female</option> </select> </td>
			</tr>
							
			<tr>
				<td><p>FATHER'S NAME</p></td>
				<td><input type="text" name="father_name"></td>
			</tr>
			<tr>				
				<td><p>MOTHER'S NAME</p></td>
				<td><input type="text" name="mother_name"></td>				
			</tr>
			<tr>
				<td><p>FATHER'S NATIONALITY</p></td>
				<td><input type="text" name="nationality" value="Indian"></td>
			</tr>
			<tr>				
				<td><p>ADDRESS</p></td>
				<td><input type="text" name="address"></td>					
			</tr>	
			<tr>
				<td><p>FATHER'S OCCUPATION</p></td>
				<td><input type="text" name="father_occupation"></td>				
			</tr>								
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td colspan="4"><h4>Godparents Details</h4></td>
			</tr><tr></tr>
			<tr>
				<td ><p>GODFATHER'S NAME</p></td>
				<td><input type="text" name="godfather_name"></td>
							</tr>
			<tr>
				<td><p>HIS ADDRESS</p></td>
				<td><input type="text" name="godfather_address"></td>			
			</tr>			
			<tr>
				<td><p>GODMOTHER'S NAME</p></td>
				<td><input type="text" name="godmother_name"></td>
			</tr>
			<tr>					
				<td><p>HER ADDRESS</p></td>
				<td><input type="text" name="godmother_address"></td>									
			</tr>
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td colspan="4"><h4>Parochial Details</h4></td>
			</tr><tr></tr>
			<tr>
				<td ><p>MINISTER'S NAME</p></td>
				<td><input type="text" name="minister_name"></td>
			</tr>
			<tr>				
				<td><p>PLACE OF BAPTISM</p></td>
				<td><input type="text" name="place_of_baptism" 
					value="<?php echo $parishName; ?>"></td>			
			</tr>			
			<tr>
				<td><p>COMMUNION</p></td>
				<td><input type="text" name="communion"></td>
			</tr>
			<tr>	
				<td><p>CONFIRMATION</p></td>
				<td><input type="text" name="confirmation"></td>									
			</tr>
			<tr>
				<td><p>MARRIAGE</p></td>
				<td><input type="text" name="marriage"></td>
			</tr>
			<tr>				
				<td><p>REMARKS</p></td>
				<td><input type="text" name="remarks"></td>				
			</tr>
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td></td>
				<td><input type="submit" name="post_bpt_frm" id="saveFrm">  </td>
				<td></td>
			</tr>
		</table>		
	</form><br><br>
	<script type="text/javascript">
		function me(){
		document.getElementById('saveFrm').click();}
	</script>
</body>
</html>

<?php
		// This below file will act as an engine between the client side and server side. It will create connection between the databse and the html form.
		include '../connection.php';
		// Taking all  values from the form data(input).
		
		if (isset($_POST['post_bpt_frm'])) {			
			$reg_no = mysqli_real_escape_string($conn, $_REQUEST['reg_no'] . "/" . $_REQUEST['reg_year']);
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

			$created_on = date("d" . "-" . "m" ."-" . "y" . " " . "h:i a");

			// Performing insert query 

			$sql = "INSERT INTO baptism VALUES(			
				'$reg_no',
				'$STATION_CODE',
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
				'','$created_on', '$USERNAME')";
			
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