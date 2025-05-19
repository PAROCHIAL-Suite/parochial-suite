<?php
include '../config/connection.php';
$sql = "SELECT * FROM parish_info WHERE stationID = '$STATION_CODE'";
$result = $conn->query($sql);

$logo = $name = $diocese = $address = '';
if ($result && $rows = $result->fetch_assoc()) {
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
	<title>Parish Report Header</title>
	<style>
		.header1 {
			width: 100%;
			margin: auto;
			padding: 10px 0 0 0;
			background: #fff;
		}

		.header-flex {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 30px;
		}

		.logo-box {
			width: 110px;
			text-align: center;
		}

		.logo-box img {
			width: 100px;
			height: auto;
		}

		.header-content {
			flex: 1;
			text-align: center;
		}

		.title {
			font-size: 32px;
			font-family: 'Arial', sans-serif;
			font-weight: bold;
			margin-bottom: 5px;
		}

		.diocese_name {
			font-size: 22px;
			font-family: 'Arial', sans-serif;
			margin-bottom: 5px;
		}

		.adrs_line {
			font-family: 'Arial', sans-serif;
			margin-bottom: 5px;
		}

		.parish_name {
			font-size: 26px;
			font-family: 'Arial', sans-serif;
			font-weight: bold;
			margin-bottom: 5px;
		}

		@media print {
			.header1 {
				box-shadow: none;
				border: none;
			}
		}
	</style>
</head>

<body>
	<div class="header1">
		<div class="header-flex">
			<div class="logo-box">
				<?php if ($logo): ?>
					<img src="../prefrences/media/<?php echo $logo; ?>" alt="Logo">
				<?php endif; ?>
			</div>
			<div class="header-content">
				<div class="parish_name"><?php echo htmlspecialchars($name); ?></div>
				<div class="diocese_name"><b><?php echo htmlspecialchars($diocese); ?></b></div>
				<div class="adrs_line"><?php echo htmlspecialchars($address); ?></div>
			</div>
			<div class="logo-box">
				<!-- Optionally, repeat logo or leave blank for symmetry -->
			</div>
		</div>
	</div>
</body>


</html>