<?php
	
	include '../connection.php';

	if (isset($_POST['create_tenure'])) {
		$s_dt = $_POST['start_dt'];

		$e_dt = $_POST['end_dt'];



		$sql = "INSERT INTO council_master_table VALUES('','$STATION_CODE', '$s_dt', '$e_dt')";

	    if(mysqli_query($conn, $sql)){	
			// echo "<script>alert('Tenure created...');</script>";	
		} else{
		    echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
		}
	}

    	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<link rel="stylesheet" type="text/css" href="../print.css">
	<script src="../print.js"></script>  
	<title></title>
	
</head>
<body>
<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>CREATE TERM</h3></td>
			</tr>
		</table>
	</div>
	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<table class="form" cellspacing="10" border="0" width="30%">
			<tr>
				<td colspan="8"><h4>Create a new term</h4></td>
			</tr>		  		
	 		<tr>
	 			<td width="10%"><label><p>START YEAR</label></td>
	 			<td width="50px">
	 				<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric" oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_dt" style="width: 100px">
	 			</td>
	 			<td width="130px"><label><p>END YEAR</label></td>
	 			<td width="130px">
	 				<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric" oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="end_dt" style="width: 100px"></td>

	  			<td><input type="submit" name="create_tenure" value="Create"></td>
	  		</tr>
	 		<tr>
	  			
	 			
	 			
	  		</tr>
	  	</table>		
	</form>

	<br>
	<div class="searchContainer">
        <table>
			<tr>
				<td colspan="5">
					<i style="font-size:15px; margin-left: 10px; margin-right:20px;" class="fa">&#xf002;</i>
					<input type="text" name="query" id="searchbox" placeholder="Search by name, surname, dob, etc." style="width: 400px;">
				</td>
			</tr>          		
        </table>	
	</div>	
	<div class="recordDisplayContainer" style="height: 60%;">
		<table class="recordDisplay" width="100%" id="table">
			<tr>
				<th width="120px">Start Date</th>
				<th>End Date</th>
				<th>ACTIONS</th>
			</tr>
			<?php
				include '../connection.php';
				$sql = "SELECT * FROM council_master_table WHERE stationID = '$STATION_CODE'";
				$result = $conn->query($sql);

				while ($rows=$result->fetch_assoc()) {
			?>			
			<tr>				
				<td width="300px"><?php echo $rows['start_date']; ?></td>
				<td width="300px"><?php echo $rows['end_date']; ?></td>
				<td>


					<a href="add_group.php?id=<?php echo $rows['ID']; ?>&s_date=<?php echo $rows['start_date']; ?>&e_date=<?php echo $rows['end_date']; ?>">Add Groups</a>

					<b>|</b>

					<a href="editTenure.php?tID=<?php echo $rows['ID']; ?>">Edit</a>
				</td>	
			</tr>
		<?php } ?>

		</table>
	</div>


<script src="../js/search_script.js" />

</body>
</html>



