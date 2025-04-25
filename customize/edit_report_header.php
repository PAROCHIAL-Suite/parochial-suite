<?php
	include '../connection.php';

	if (isset($_POST['create_unit_code'])) {
		// code...
		@$p_name = mysqli_real_escape_string($conn,$_POST['parish_name']);
		@$p_address = mysqli_real_escape_string($conn,$_POST['parish_address']);
		@$diocese = mysqli_real_escape_string($conn,$_POST['diocese-name']);

		$sql = "UPDATE parish_info SET 
			p_name = '$p_name', 
			p_address = '$p_address', 
			diocese = '$diocese' WHERE stationID = '$STATION_CODE'";

	    if(mysqli_query($conn, $sql)){	
			 echo "<script>alert('Report hase been header changed.')</script>";
		} else{
		    echo "ERROR: $sql. " . mysqli_error($conn);
		}    		

	}

		
	$sql = "SELECT * from parish_info WHERE stationID = '$STATION_CODE'";
	$result = $conn->query($sql);		
    if ($result) {
        // Fetch the result as an associative array
        $rows = $result->fetch_assoc();	
			 $name = $rows['p_name'];
			 $address = $rows['p_address'];
			 $diocese = $rows['diocese'];
		 	
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
	<style type="text/css">
		.headerPreview{
			border: 1px solid lightblue; width: 85%; margin: auto; 
			box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
		}
	</style>


</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>EDIT REPORT HEADER</h3></td>
			</tr>
		</table>
	</div>
	<br>

	<form id="" class="" method="post" action="">
		<table width="20%"  border="0" cellspacing="14" class="form">
			<tr>
				<td colspan="8"><h4>Heder Information</h4></td>
			</tr>
			<tr>
				<td width="15%"><p>CHURCH NAME</p></td>
				<td><input type="text" name="parish_name" style="width: 50%" value="<?php echo $name; ?>" required>  </td>
			</tr>
				<td><p>ADDRESS</p></td>
				<td><input type="text" name="parish_address" style="width: 50%" value="<?php echo $address; ?>" required>  </td>
			</tr>
				<td><p>DIOCESE NAME</p></td>
				<td><input type="text" name="diocese-name" style="width: 50%" value="<?php echo $diocese; ?>" required>  </td>	
			</tr>
			<tr></tr><tr></tr>
			<tr>
			
				<td><input type="submit" name="create_unit_code" value="Save">  </td>
			</tr>
		</table>
	</form>
	<br>
	<div class="headerPreview">
		<div class="containerTitle">
			<h3>Preview of header</h3>
		</div><br><br>
		<?php include '../prefrences/letterHead_header.php'; ?>
	</div>
</body>
</html>

