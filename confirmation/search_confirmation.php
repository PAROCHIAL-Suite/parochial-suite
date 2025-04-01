

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php';  ?>
	<br><br>
	<!-- PAGE TITLE -->
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="20%"><h3 class="pageName">SEARCH IN CONFIRMATION</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<?php include '../searchBar.php'; ?>
	<div class="recordDisplayContainer">
			<table class="recordDisplay" id="table" width="99.4%" style="margin-right: 10px;">
				<tr>
					<th width="100px">Reg. No.</th>					
					<th width="300px">Name</th>		
					<th>Baptism Parish</th>
					<th>Date of Communion</th>
					<th>Parish Priest</th>				
					<th>ACTIONS</th>
				</tr>
				<?php
					include '../connection.php';
					$sql = "SELECT * from confirmation WHERE stationID = '$STATION_CODE'";
					$result = $conn->query($sql);									
					while ($rows=$result->fetch_assoc()){						 	
				?>			
				<tr>				
					<td style="text-align: center;"><?php echo $rows['reg_no']; ?></td>				
					<td><?php echo $rows['name'] . " " . $rows['surname'];; ?></td>
					<td><?php echo $rows['baptism_parish']; ?></td>
					<td><?php echo $rows['date_of_confirmation']; ?></td>
					<td><?php echo $rows['parish_priest']; ?></td>
					<td><a href="edit_confirmation.php?id=<?php echo $rows['reg_no'];?>">Edit</a>
					 &nbsp;&nbsp;&nbsp; 
						<b>|</b> 
						&nbsp;&nbsp;&nbsp;
						<a href="notify.php?id=<?php echo $rows['id']; ?>">Notify</a>  </td>							
				</tr>		
		</tr>
		<?php } ?>
		</table>     			
    </div>
	</div>
	<script src="../js/tab-page-script.js"></script>
	<script src="../js/search_script.js"></script>
	<script src="../js/exportToExcel.js"></script>


</body>
</html>