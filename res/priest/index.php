<?php
	include '../connection.php';
	if (isset($_POST['add_priest'])) {
		// code...
		$name = mysqli_real_escape_string($conn,$_REQUEST['name']);
		$designation = mysqli_real_escape_string($conn,$_REQUEST['designation']);
		$start_dateRF = $_REQUEST['start_date'];
		$start_date = reformatDate($start_dateRF);
		$end_dateRF = $_REQUEST['end_date'];
		$end_date = reformatDate($end_dateRF);

		$sql = "INSERT INTO priest values(
		'','$STATION_CODE','$name', '$designation', '$start_date', '$end_date')";
	    if(mysqli_query($conn, $sql)){	
     
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
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>PRIEST</h3></td>
			</tr>
		</table>
	</div>
	<br>

	<form id="" class="" method="post" action="<?php echo  $_SERVER['PHP_SELF'] ?>">
		<table width="20%"  border="0" cellspacing="14" class="form" style="margin-left: ;">
			<tr>
				<td colspan="8"><h4>Priest Details</h4></td>
			</tr>
			<tr>
				<td><p>PRIEST NAME</p></td>
				<td width="200px"><input type="text" name="name">  </td>
				<td><p>DESIGNATION</p></td>
				<td>
					<select name="designation">
						<option>Parish Priest</option>
						<option>Asst. Parish Priest</option>
						<option>Parish Priest (In-Charge)</option>
					</select>
				</td>	
			</tr>
			<tr>
				<td><p>START DATE</p></td>
				<td><input type="date" name="start_date" required>  </td>
				<td><p>END DATE</p></td>
				<td><input type="date" name="end_date">  </td>										
			</tr>
			<tr></tr><tr></tr>
			<tr>
				<td></td>
				<td><input type="submit" name="add_priest" value="Add to list">  </td>
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
	<div  class="recordDisplayContainer" style="height: 50%;" >
		<table class="recordDisplay" id="printJS-form" width="100%">
			<tr>
				<th></th>
				<th>NAME</th>
				<th>DESIGNATION</th>
				<th>START DATE</th>
				<th>END DATE</th>
				<th>ACTIONS</th>
			</tr>
			<?php
				include '../connection.php';
				$sql = "SELECT * FROM priest WHERE stationID = '$STATION_CODE' ORDER BY start_date ASC";
				$result = $conn->query($sql);
					
				while ($rows=$result->fetch_assoc()){
					$id = $rows['ID'];
			?>			
			<tr>
				<TD></TD>
				<td><?php echo $rows['name']; ?></td>
				<td><?php echo $rows['designation']; ?></td>
				<td><?php echo $rows['start_date']; ?></td>
				<td><?php echo $rows['end_date']; ?></td>
				<td><a href="edit_priest.php?id=<?php echo $rows['ID']; ?>">Edit</a></td>

			</tr>
		<?php } ?>
		</table>
	</div>
	<script src="../js/tab-page-script.js"></script>
</body>
</html>

