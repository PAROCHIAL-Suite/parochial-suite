<?php 
	include '../connection.php';
	 $id = $_GET['id'];
			
	$sql = "SELECT * FROM family_member WHERE family_ID = '$id' AND relation_with_head = 'Head' AND stationID = '$STATION_CODE'";
	$result = $conn->query($sql);
			 
	while ($rows=$result->fetch_assoc()){ 		
		$family_name = $rows['surname']; 	
		$family_ID = $rows['family_ID']; 	
		$area = $rows['area_code']; 	
		$head = $rows['name'] . " " . $rows['surname'];
		$contact_no = $rows['contact_no'];
		$address = $rows['address'];
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../print.css">
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="../print.js"></script>
	<title>Family View</title>
	<style type="text/css">
		.head{
			font-family: sans-serif	;
		}
	</style>
</head>
<body>
	<?php include '../nav/global_nav.php';  ?>
	<br><br>
	<!-- PAGE TITLE -->
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="20%"><h3 class="pageName">FAMILY VIEW</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<div class="searchContainer">
		 <table border="0">
		 	<td width="5%" style="text-align: center;">
		 	</td>

		 	<td width="3%">
		 		<button onclick="location.reload();" >
					<i style="font-size:17px; color: green" class="fa">&#xf021;</i>
				</button>
		 	</td>
		 	<td width="3%">
		 		<button 
			 		style="font-size: 18px;" 
			 		type="button" 
			 		onclick="" id="hideBtn">
		 		<i class="fa" >&#xf02f;</i>
		 		</button>
		 	</td>
		 	<td width="">
		 	&nbsp;&nbsp;&nbsp;&nbsp;		 		
		 		<a href="create_member.php?id=<?php echo  $id;?>" style="text-decoration: none;">
		 			<button >Add Member</button>
		 		</a>
		 		<a href="edit_family.php?id=<?php echo  $id;?>" style="text-decoration: none;">
		 			<button >Edit Family Details</button>
		 		</a>		 		

		 	</td>		 	
		 </table>
	</div>
	<br>
	<div class="container reportPageContainer">
	<div  id="printJS-form">
		<div style="border-bottom:  double ;text-align: center; font-family: 'Calibri', sans-serif; display: none;" id="show-report-header">
			<h1 style=" margin-bottom: -10px;">St. Joseph's Church, Gondia</h1>	

			<table width="100%">
				<tr>
					<td width="70%"><p style="float: left;font-size: 20px; font-weight: bold;">Family Summary Report</p></td>
					<td>
						<p style="float: right;"><?php echo date("d-M-Y"); ?></p>
					</td>
				</tr>
			</table>			
		</div>
	<br>
		<table 
			width="100%" border="1"
			style="
				border: 1px solid lightgray; 
				border-collapse: collapse; 
				 font-family: 'Titillium Web', calibri;">
			<tr>
				<td width="10%"><b>Family ID</b></td>				
				<td width="10%"><b>Area Code</b></td>
				<td width="20%"><b>Head of family</b></td>
				<td width="10%"><b>Contact</b></td>
				<td id="target" width="20%"><b>Address</b></td>
			</tr>

			<tr>
				<td><?php echo  @$family_ID; ?></td>				
				<td><?php echo  @$area; ?></td>
				<td><?php echo  @$head; ?></td>
				<td><?php echo  @$contact_no; ?></td>
				<td><?php echo  @$address; ?></td>
			</tr>
		</table>		
		<br>
		<table width="100%" cellspacing="10px" border="1" 			
				style="
				border: 1px solid lightgray; 
				border-collapse: collapse; 
				 font-family: 'Titillium Web', 'calibri'; ">
			<tr>
				<th colspan="7" style="height: 50px; color: var(--txtblue);">Members of the family</th>
			</tr>
			<tr style="font-size: 14px; height: 30px;;">
				<th>Status</th>
				<th>Name</th>
				<th>D.O.B</th>
				<th>Gender</th>
				<th>Contact</th>
				<th>Relation</th>
				<th class="column-to-hide">Action</th>
				
			</tr>
		<?php
			$sql = "SELECT * FROM family_member WHERE family_ID = '$id' AND stationID = '$STATION_CODE'";
			$result = $conn->query($sql);
					 
			while ($rows=$result->fetch_assoc()){ 		

				
		?>				
		<tr style="height: 40px;">	
			<td width="10%" style="text-align: center;" width="12%"><?php echo  $rows['status']; ?></td>				
			<td style="padding-left: 10px;" width="20%"><?php echo  $rows['name'] . " " . $rows['surname']; ?></td>				
			<td style="padding-left: 10px;" width="12%"><?php echo  $rows['dob']; ?></td>
			<td style="padding-left: 10px;" width="12%"><?php echo  $rows['gender']; ?></td>
			<td style="padding-left: 10px;" width="12%"><?php echo  $rows['contact_no']; ?></td>
			<td style="padding-left: 10px;" width="12%"><?php echo  $rows['relation_with_head']; ?></td>
			<td width="10%" class="column-to-hide" style="text-align: center;"><a href="edit_member.php?id=<?php echo $rows['ID']; ?>">Edit</a>  
			<b>|</b>  
			<a href="delete_family_member.php?id=<?php echo $rows['ID']; ?>&famID=<?php echo $id; ?>">Delete</a>
			</td>
			</td>
		</tr>			
		<?php } ?>	
		</table>
		
	</div>
	

	<script type="text/javascript">
        document.getElementById('hideBtn').addEventListener('click', function() {
            // Get all cells in the column to hide
            const columnCells = document.querySelectorAll('.column-to-hide');
            const showHeader = document.getElementById('show-report-header');
           
            // Hide the column
            columnCells.forEach(cell => {                
                cell.style.display = 'none';
                cell.style.border = 'none';
                 showHeader.style.display = 'block';
                printJS({ printable: 'printJS-form', type: 'html'
			 		})

            });
            
            // Show the column after 3 seconds
            setTimeout(() => {
                columnCells.forEach(cell => {
                    cell.style.display = '';
                    showHeader.style.display = 'none';
                    cell.style.border = '1px solid lightgrey';
                });
            }, 1000);
        });
	</script>
</body>
</html>