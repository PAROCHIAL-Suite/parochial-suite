<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout</title>
</head>

<body>
	<?php
	// $servername = "localhost";
	// $database = "u381709061_parochial_db";
	// $username = "u381709061_Ecclesiastical";
	// $password = "/vV+q6=C";
	
	// Create connection
	
	$conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');

	// Check connection
	
	if (!$conn) {
		die("Unable to connect: " . mysqli_connect_error());
	}
	$id = $_GET['id'];

	$sql = "UPDATE users SET login_status = 'Logged Out' WHERE ID = '$id'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_query($conn, $sql)) {
		setcookie("user", $STATION_CODE, time() - 3600);
		setcookie("username", $USERNAME, time() - 3600);

		echo "<script>alert('Logged out')</script>";
		header("Location: index.php");
	} else {
		echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}






	?>

</body>

</html>