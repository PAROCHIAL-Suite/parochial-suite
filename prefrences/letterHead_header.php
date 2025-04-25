<?php
	include '../connection.php';
	$sql = "SELECT * FROM parish_info WHERE stationID = '$STATION_CODE'";
	$result = $conn->query($sql);

	while ($rows=$result->fetch_assoc()) { 
		$logo = $rows['p_logo'];
		$name = $rows['p_name'];
		$diocese = $rows['diocese'];
		$address = $rows['p_address'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="print.css">
	 <script src="print.js"></script>
	<title></title>
	<style type="text/css">
		.title{
			font-size: 32px;		
			font-family: 'Arial', sans-serif;
			font-weight: bold;
			text-align: center;
		}
		.adrs_line{	
			font-family: 'Arial', sans-serif;		
			text-align: center;	
		}
		.logo{			
			font-family: 'Arial', sans-serif;	

		}
		.logo img {
				width: 100px;					
		}

		.rightbox{
			width: 80px;
		}

	</style>
</head>
<body>
	<div class="header1 container" >
		<!-- <img src="../prefrences/media/<?php // echo $logo; ?>"> -->

		<table border="0"  width="100%">
			<tr>
				<td class="title"><?php echo $name; ?></td>	
			</tr>
			<tr>
				<td class="adrs_line"><b><?php echo  $diocese; ?></b></td>
			</tr>
			<tr>
				<td class="adrs_line"> <?php echo $address; ?></td>
			</tr>
		</table>
	</div>
</body>
</html>