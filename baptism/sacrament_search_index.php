<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/baptism.css"> -->
	<title></title>
    <script>

    </script>		
</head>
<body>
	<?php include '../nav/global_nav.php';  ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="20%"><h3>SEARCH IN BAPTISM</h3></td>				
			</tr>
		</table>
	</div>
	<br>
	<?php include '../simpleSearchBox.php'; ?>	
	<div class="recordDisplayContainer">	
		<table width="100%" class="recordDisplay" id="table">
			<?php
  				include "../connection.php";
  			
            	$sql = "SELECT * FROM baptism WHERE stationID = '$STATION_CODE' 
            	ORDER BY reg_no ASC";

            	$result = $conn->query($sql);
            	$conn->close();
		  
		       ?>
		    <tr>
				<th width="80px">REG. NO.</th>
				<th width="260px">NAME</th>
				<th width="150px">DATE OF BIRTH</th>
				<th width="210px">FATHER'S NAME</th>
				<th width="210px">MOTHER'S NAME</th>
				<th id="action">ACTION</th>				
			</tr>
			<?php          	
            	while ($rows=$result->fetch_assoc()) {
			?>
			<tr>
				<td><?php echo $rows['reg_no']; ?></td>
				<td><?php echo $rows['name']." ".$rows['surname']; ?></td>				
				<td><?php echo $rows['dob']; ?></td>
				<td><?php echo $rows['father_name']; ?></td>
				<td><?php echo $rows['mother_name']; ?></td>
				<td> 
					<a href="btsm_certificate.php?id=<?php echo $rows['reg_no']; ?>">View</a> 
					&nbsp;&nbsp;&nbsp;
					<b>|</b> 
					&nbsp;&nbsp;&nbsp;<a href="btsm_edit.php?id=<?php echo $rows['reg_no']; ?>">Edit</a></td>
			</tr>
		<?php  }  ?>
		</table>
	</div>


	<script src="../js/search_script.js"></script>
	<script src="../js/exportToExcel.js"></script>	
</body>
</html>