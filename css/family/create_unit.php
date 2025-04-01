<?php
	include '../connection.php';

	if (isset($_POST['create_unit_code'])) {
		// code...
		$area_name = $_POST['area_name'];
		$given_name = $_POST['given_name'];
		$area_code = $_POST['area_code'];

		$sql = "INSERT INTO area_mapping VALUES('','$STATION_CODE', '$area_name', '$given_name', '$area_code')";

	    if(mysqli_query($conn, $sql)){	
			 //header("Location: create_unit.php");
		} else{
		    echo "ERROR: $sql. " . mysqli_error($conn);
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
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>CREATE UNIT</h3></td>
			</tr>
		</table>
	</div>
	<br>

	<form id="" class="" method="post" action="">
		<table width="20%"  border="0" cellspacing="14" class="form" style="">
			<tr>
				<td colspan="8"><h4>Area/Unit Mapping</h4></td>
			</tr>
			<tr>
				<td><p>AREA NAME</p></td>
				<td><input type="text" name="area_name">  </td>
				<td><p>GIVEN NAME</p></td>
				<td><input type="text" name="given_name">  </td>	
				<td><p>SET A CODE NAME</p></td>
				<td><input type="text" name="area_code">  </td>	
												
			</tr>
			<tr></tr><tr></tr>
			<tr>
				<td></td>
				<td><input type="submit" name="create_unit_code" value="Create">  </td>
			</tr>
		</table>
	</form>
	<br>
	<div class="searchContainer">
        <table>
				<td colspan="5">
					<i style="font-size:15px; margin-left: 10px; margin-right:10px;" class="fa">&#xf002;</i>
					<input type="text" name="query" id="searchbox" placeholder="Search by name, surname, dob, etc." style="width: 400px;">
				</td>			
			</tr>          		
        </table>	
	</div>
	<div  class="recordDisplayContainer" style="height: 55%;">
		<table class="recordDisplay" id="table" width="100%">
			<tr>
				<th width="10%">AREA NAME</th>
				<th width="25%">GIVEN NAME</th>
				<th width="10%">AREA CODE</th>
				<th>ACTIONS</th>
			</tr>
			<?php
				include '../connection.php';
				$sql = "SELECT * FROM area_mapping";
				$result = $conn->query($sql);
					
				while ($rows=$result->fetch_assoc()){			 		
			?>			
			<tr>
				<td><?php echo $rows['area_name']; ?></td>
				<td><?php echo $rows['given_name']; ?></td>
				<td><?php echo $rows['area_code']; ?></td>
				<td><a href="">Edit</a> | <a href="">Delete</a>  </td>
			</tr>
		<?php } ?>
		</table>
	</div>
	<script src="../js/search_script.js"></script>
</body>
</html>

