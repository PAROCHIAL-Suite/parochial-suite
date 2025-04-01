<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout</title>
</head>
<body>
<?php 
        $conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
    if ($conn->connect_error) {
        echo "\'<h2>Running Status :<b> Active</b></h2>";
        die("Connection failed. " . $conn->connect_error);
    }

	$id = $_GET['id'];

	$sql = "UPDATE users SET login_status = 'Logged Out' WHERE ID = '$id'";  
    $result = mysqli_query($conn, $sql);  
				
	if(mysqli_query($conn, $sql)){	
		setcookie("user", $STATION_CODE, time() - 3600);
		setcookie("username", $USERNAME, time() - 3600);

		echo "<script>alert('Logged out')</script>";   	
		header("Location: ../index.php");			    
	} 
	else{echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);}
	            



	
			
?>

</body>
</html>