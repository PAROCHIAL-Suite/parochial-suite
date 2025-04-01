<?php
	include "../connection.php";

    $sql = "SELECT COUNT(*) as total_member_in_family FROM family_member WHERE  stationID = '$STATION_CODE'";
    $result = $conn->query($sql);
    if ($result) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();
         $total_member_in_family = $row['total_member_in_family'];
        if ($total_member_in_family == 0) {
            // code...
            $total_member_in_family = 1;
        }elseif ($total_member_in_family > 0) {
            // code...
            $total_member_in_family = 1;
        }        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }	


    // inserting family
	if (isset($_POST['register_family'])) {
		// code...
		$date = date("d/m/Y");
		$family_name = mysqli_real_escape_string($conn,$_POST['family_name']);
		$address = $_POST['address'];
		$area_code = $_POST['area_code'];
		$family_ID = $STATION_CODE.$family_count; // gon1

		$sql = "SELECT * FROM family_master_table WHERE family_ID = '$family_ID'";	
		$result = $conn->query($sql); 
    	$users_Exist = mysqli_num_rows($result);

    	if ($users_Exist == 1) {
    		echo "<script>Duplicate entry.</script>";

    	}else{

    	}
		
		if(mysqli_query($conn, $sql)){			
			//header("Location: success_reg_dialog.php?query=$fam_ID");
		} else{
			echo "ERROR: <code>UNABLE_TO_REG_FAMILY</code>";
		    echo "$sql. " . mysqli_error($conn);
		}   

		$sql = "INSERT INTO family_master_table VALUES(
			'','$family_ID','$STATION_CODE','ACTIVE', '$family_name','$address', '$area_code',
			 '$date', '', '')";	
		
		if(mysqli_query($conn, $sql)){			
			//header("Location: success_reg_dialog.php?query=$fam_ID");
		} else{
			echo "ERROR: <code>UNABLE_TO_REG_FAMILY</code>";
		    echo "$sql. " . mysqli_error($conn);
		}   

		// Adding heading of the family to family_member table.
		$name = $_POST['name'];
		$contact_no = $_POST['contact_no'];

	
		$sql = "INSERT INTO family_member VALUES(
				'',
				'$family_ID',
				'$STATION_CODE',
				'$area_code',		 
				'ACTIVE',
				'',		
				'$name',
				'$family_name',
				'',
				'',
				'',
				'',
				'',
				'$address', 
				'$contact_no',
				'',
				'Head',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'', 
				'',
				'',
				'',
				'',
				'',
				'', 
				'',
				'',
				'', 
				'', 
				'')";
					
				if(mysqli_query($conn, $sql)){			
			    echo "
			    <script>
			    	alert('A new family has been created.');
			    </script>"; 	 					
					//header("Location: success_reg_dialog.php?query=$fam_ID");
				} else{
					echo "ERROR: <code>UNABLE_TO_REG_FAMILY</code>";
				    echo "$sql. " . mysqli_error($conn);
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
<body style="overflow: auto;">
	<?php include '../nav/global_nav.php';  ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>CREATE FAMILY</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<form id="" class="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<table width="100%"  border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="6" ><h4>Basic Details</h4></td>
			</tr>
		
				<td> <?php// echo $family_count ?> </td>
			
			<tr>
				<td width="14%"><p>HEAD OF THE FAMILY</p></td>
				<td width="20%"><input placeholder="Name" type="text" id="head_name" name="name" required>			
				</td>
				<TD></TD>
			<td width="200px">	
				<input type="text" placeholder="Surname" id="family_name" name="family_name" required></td>	
			</tr>
			<TR>
				<td width="220px"><p>UNIT/AREA CODE</p></td>
				<td><select name="area_code"  required>
					<option hidden>--</option>
					<?php
		  				include "../connection.php";		  			
		            	$sql = "SELECT * FROM area_mapping";
		            	$result = $conn->query($sql);
		            	
						while ($rows=$result->fetch_assoc()) { 
							$area_Code = $rows['area_code'];
							$area_Name = $rows['area_name'];
						?>
					<option value="<?php echo $rows['area_code']; ?>"> 
						<?php echo $rows['area_code'] .' - (' .  $rows['area_name'] . ")"; } ?> 
					</option>
					</select>
				</td>				
			<td width="4%">CONTACT</td>
			<td>
				<input type="text" placeholder="contact" id="" name="contact_no" required></td>
			</tr>
			<tr>
				<td><p>ADDRESS</p></td>
				<td colspan="4"><input type="text" name="address" id="address" style="width: 72.3%;"></td>						
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="register_family" value="CREATE">  </td>
			</tr>
	</table>
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
	
	<div  class="recordDisplayContainer" style="height:45%;">			
		<table class="recordDisplay" id="table" width="100%">
			<tr>
				<th></th>
				<th>FAMILY ID</th>
				<th>FAMILY NAME</th>
				<th>AREA CODE</th>
				<th>ADDRESS</th>
				<th hidden>PARISH ID</th>
				<th>ACTION</th>
			</tr>
			<?php
			    include '../connection.php';

				//$id = $_GET['id'];
			    $sql = "SELECT * FROM family_master_table WHERE stationID = '$STATION_CODE' ";    
			    $result = $conn->query($sql);  
			            
			    while ($rows=$result->fetch_assoc()){
			?>
			<tr>
				<td></td>
				<td><?php echo $rows['family_ID'];  ?></td>
				<td><?php echo $rows['family_name']; ?></td>
				<td><?php echo $rows['area_code']; ?></td>
				<td><?php echo $rows['address'];     ?></td>								
				<td>
					<a href="edit_family.php?id=<?php echo $rows['family_ID'];  ?>">Edit</a>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<a href="create_member.php?id=<?php echo  $rows['family_ID'];?>">Add Member</a> 
					&nbsp;&nbsp;&nbsp;|
					&nbsp;&nbsp;&nbsp;
					<a href="edit_family_head.php?id=<?php echo $rows['family_ID'];  ?>">Edit Family Head</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<script src="../js/tab-page-script.js"></script>
	<script src="../js/search_script.js"></script>
</body>
</html>


<!-- code to upload data to server -->
