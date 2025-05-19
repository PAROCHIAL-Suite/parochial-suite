<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<!-- PAGE TITLE -->
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="20%">
					<h3 class="pageName">SEARCH IN HOLY COMMUNION</h3>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<div class="searchContainer">
		<table>
			<tr>
				<td colspan="5">
					<i style="font-size:15px; margin-left: 10px; margin-right:20px;" class="fa">&#xf002;</i>
					<input type="text" name="query" id="searchbox" placeholder="Search by name, surname, dob, etc."
						style="width: 400px;">
				</td>
				<td width="100px"><i style="font-size:17px; float: right; margin-right:4px;" class="fa">&#xf0b0;</i>
				</td>
				<td>
					<button onclick="location.reload();">Refresh</button>
				</td>

				<td width="180px"><i style="font-size:22px; float: right; margin-right:8px;" class='fas'>&#xf1c3;</i>
				</td>
				<td><button id="opcBtn" onclick="exportToExcel('table', 'Member List')">Excel (.csv)</button></td>
			</tr>
		</table>
	</div>
	<div class="recordDisplayContainer">
		<table class="recordDisplay" id="table" width="99.4%" style="margin-right: 10px;">
			<tr>
				<th width="150px">Registration No.</th>
				<th width="300px">Name</th>
				<th width="150px">Baptism Date</th>
				<th>Baptism Parish</th>
				<th>Date of Communion</th>
				<th>Place of Communion</th>
				<th>Parish Priest</th>
				<th>ACTIONS</th>
			</tr>
			<?php
			include '../config/connection.php';
			$sql = "SELECT * from eucharist WHERE stationID = '$STATION_CODE'";
			$result = $conn->query($sql);
			while ($rows = $result->fetch_assoc()) {
				?>
				<tr>
					<td style="text-align: center;"><?php echo $rows['reg_no']; ?></td>
					<td><?php echo $rows['name'] . " " . $rows['surname'];
					; ?></td>
					<td><?php echo $rows['baptism_date']; ?></td>
					<td><?php echo $rows['baptism_parish']; ?></td>
					<td><?php echo $rows['date_of_communion']; ?></td>
					<td><?php echo $rows['church_of_comunion']; ?></td>
					<td><?php echo $rows['parish_priest']; ?></td>
					<td><a href="edit_eucharist.php?id=<?php echo $rows['reg_no']; ?>">Edit</a>
						&nbsp;&nbsp;&nbsp;
						<b>|</b>
						&nbsp;&nbsp;&nbsp;
						<a href="">View</a>
					</td>
				</tr>
				</tr>
			<?php } ?>
		</table>
	</div>
	</div>
	<script src="../js/tab-page-script.js"></script>
	<script src="../js/search_script.js"></script>
	<script src="../js/export.js"></script>


</body>

</html>