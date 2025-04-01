
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
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
				<td width="40%"><h3>CREATE COMMITTEE</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<div class="">
		  <form action="council_script.php?id=<?php echo $_GET['id']; ?>&s_date=<?php echo $_GET['s_date']; ?>&e_date=<?php echo $_GET['e_date']; ?>" method="post">
		  	<table width="100%" border="0" class="form" cellspacing="10" >
		  					<tr>
				<td colspan="12%"><h4>Group Detail</h4></td>
			</tr>
			<tr>
		  			<td width="10%"><p>From:&nbsp;&nbsp;&nbsp;<b><?php echo $_GET['s_date'];?></b></p>
		  			<p>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $_GET['e_date'];?></b></p></td>

  					<td width="12%">
  						<p>COMMITTEE NAME</p>
  					</td>
		  			<td>

		  			<input type="text" name="group_name" placeholder="Type" style="width: 500px">
		  			
		  			<input type="submit" name="create_group" value="Add Group "></td>
		  		</tr>
		  	</table>		
		  </form>
	</div>
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
				<th width="120px">Tenure</th>
				<th width="120px">Name</th>				
				<th>ACTIONS</th>
			</tr>
			<?php
				include '../connection.php';
				$termID = $_GET['id'];
				$sql = "SELECT council_master_table.start_date, council_master_table.end_date,council_group.ID, council_group.group_name FROM council_master_table LEFT JOIN council_group ON council_master_table.ID = council_group.termID 
				WHERE council_group.termID = '$termID' AND council_master_table.stationID = '$STATION_CODE'";
				$result = $conn->query($sql);

				while ($rows=$result->fetch_assoc()) {
			?>			
			<tr>				
				
				<td width="100px"><?php echo $rows['start_date'] . "-" . $rows['end_date'];; ?></td>
				<td width="300px"><?php echo $rows['group_name']; ?></td>
				<td width="300px"><a href="">Edit</a> <b>|</b> 
					<a href="add_member.php?id=<?php echo $rows['ID'];  ?>">Add Mmeber</a></td>
							
			</tr>
		<?php } ?>

		</table>
	</div>


	<script src="../js/search_script.js"></script>

</body>
</html>



