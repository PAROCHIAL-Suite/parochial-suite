<?php
	include '../connection.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM eucharist WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
    $result = $conn->query($sql); 
    while ($rows=$result->fetch_assoc()) { 
	
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
				<td width="40%" ><h3>REGISTRATION OF BURIAL</h3></td>
			</tr>
		</table>
	</div>
<br>

	<form id="baptism_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<table width="100%"  border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="4"><h4>Certificate Details</h4></td>
			</tr><tr></tr>
			<tr>
				<td><p>REG. NO.</p></td>
				<td><input type="text" name="reg_no"></td>
			</tr>
			<tr>				
				<td><p>NAME</p></td>
				<td><input type="text" name="name"></td>				
			</tr>
			<tr>
				<td><p>DATE OF BURIAL</p></td>
				<td><input type="date" class="auto-format-date" name="burial_date"></td>
			</tr>	
			<tr>
				<td><p>CAUSE OF DEATH</p></td>
				<td><input type="text" name="cause"></td>
			</tr>					
			<tr>
				<td><p>INFORMATION SOURCE</p></td>
				<td><input type="text" name="info_source" placeholder="How you got to know about the news"></td>
			</tr>
	
		
			<tr>				
				<td><p>GRAVE NO.</p></td>
				<td><input type="text" name="grave_no"></td>				
			</tr>		
			<tr>				
				<td><p>MINISTER</p></td>
				<td><input type="text" name="minister"></td>			
			</tr>							
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td></td>
				<td>  
					<button>Cancel</button> 
					<input type="submit" name="post_eucharist_from" id="saveFrm">  </td>
				<td></td>
			</tr>
		</table>		
	</form><br><br>
</body>
</html>
<?php
if (isset($_POST['post_eucharist_from'])){
	include '../connection.php';
	
	$name = mysqli_real_escape_string($conn,$_POST['name']);	
	$reg_no = mysqli_real_escape_string($conn,$_POST['reg_no']);
	$cause = mysqli_real_escape_string($conn,$_POST['cause']);
	$info_source = mysqli_real_escape_string($conn,$_POST['info_source']);
	$db = mysqli_real_escape_string($conn,$_POST['burial_date']);
	$burial_date = reformatDate($db);
	$grave_no = mysqli_real_escape_string($conn,$_POST['grave_no']);
	$minister = mysqli_real_escape_string($conn,$_POST['minister']);
	
	

	$sql ="INSERT INTO burial VALUES(
		'',
		'$STATION_CODE',
		'$reg_no',
		'$name',
		'$burial_date',
		'$cause',
		'$info_source',
		'$grave_no' ,
		'$minister ')";
	if(mysqli_query($conn, $sql)){	
		echo "
			<script>
			    alert('A new Burial record has been created.');			    	
			</script>"; 	     
			$total_records = $total_records + 1;
	} else{
	         echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}    
}


?>