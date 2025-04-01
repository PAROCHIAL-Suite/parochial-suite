<!-- NAVIGATION FILE  -->
<!-- CONTAINS APPLICATION NAME AND USER DETIALS -->
<!-- TOP LEVEL NAVIGATION -->


<?php
	// CODE TO CHECK WHETHER THE USER STATE IS ACTIVE
	// IF THE STATE DOES NOT EXIST THE USER WILL BE REDIRECTED TO THE LOGIN PAGE
	// IF THE USER TRY TO LOGIN WITH A URL OF APPLICATION THEY WON'T BE ABLE TO GET INTO THE APPLICATION.
    if(!isset($_COOKIE['user'])) {
      //echo "Cookie named '" . $cookie_name . "' is not set!";
    	header("Location: ../index.php");
    } else {
      //echo "Cookie '" . $cookie_name . "' is set!<br>";
      //echo "Value is: " . $_COOKIE['user'];
    }	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">	
	<script src="https://kit.fontawesome.com/088cbc7107.js" crossorigin="anonymous"></script>
	<title></title>
</head>
<body>
	<?php 

	// THIS CODE WILL GET THE USER DATA FROM 'USER' TABLE AND WILL SHOW IT IN THE NAVIGATION BAR.
	 	include '../connection.php';
	  	$id = $_GET['ref'];
	 	$path =  $_SERVER['SCRIPT_NAME'];
		$sql = "SELECT * FROM users WHERE ID = '$id'";
		$result = $conn->query($sql);
		$conn->close();
		while ($rows=$result->fetch_assoc()) { 
			$id = $rows['ID'];
			$role = $rows['role'];
			$pId = $rows['parishID'];		
			$stationCode = $rows['stationCode'];			
	?>

	<div class="nav">
		<div class="current-user">
			<table border="0" width="100%">
				<tr>
					<td rowspan="2" width="15%"><i class='fas fa-user-circle'></i></td>
					<td><?php echo $rows['Name']; ?></td>
					<td rowspan="2"> <a href="../logout.php?id=<?php echo $id; ?>"><button>Logout</button></a>  </td>
				</tr>
				<tr>
					<td><?php echo $rows['role']. " | " . $rows['parishID']. " | ";} echo $_COOKIE['user'];?></td>
				</tr>
			</table>
		</div>
		<table width="30%" border="0">
			<tr>
				<td width="30%"><p>Parochial Cloud</p></td>
			</tr>
		</table>
	</div>
	<?php  
	// AFTER GETTING THE CREDENTIALS THIS CODE WILL REDIRECT THEM ACCORDING TO THERE PRIVILLAGE.

		if ($role == 'User' and $path == '/admin/default.php') {			
			header("Location: ../index.php");
		}
		elseif ($role == 'Adminstrator' and $path == '/view_only/index.php') {
			header("Location: ../index.php");
		}
	?>
</body>
</html>
