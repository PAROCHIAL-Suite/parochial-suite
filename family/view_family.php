<?php
include '../config/connection.php';
$getPOC = $_GET['id'];

$sql = "SELECT * FROM family_members WHERE poc = '$getPOC' AND relation_with_head = 'Head' AND stationID = '$STATION_CODE'";
$result = $conn->query($sql);

while ($rows = $result->fetch_assoc()) {
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
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">


	<script src="../print.js"></script>
	<title>Family View</title>
	<style type="text/css">
		.head {
			font-family: sans-serif;
		}

		#table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			border: none
		}

		#table th {
			padding: 10px;
		}
	</style>
</head>

<body>
	<?php include '../nav/global_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>FAMILY INFORMATION</h3>
	</div>
	<br>
	<div class="container-widgets " style="margin-bottom: 65px;">
		<div class="widget-row ">
			<div class="widget table-widget ">
				<div class="widget-header "
					style="background-color:rgba(231, 236, 249, 0.48); border:none !important; ">
					<div class="search-actions ">

						<button class="btn btn-secondary-exp " id="exportBtn" onclick="exportToWord('table', 'myData')">
							<i class="fa fa-file-word-o word" title="Export to Microsoft Word File (.docx)"></i>
						</button>
						<button class="btn btn-secondary-exp " id="exportBtn"
							onclick="exportToPDF('table', 'parochial-data-extract.pdf');">
							<i class="fa fa-file-pdf-o pdf" title="Export to PDF File (.pdf)"></i>
						</button>
						|
						<button class="btn btn-secondary-exp " id="exportBtn" onclick="printJS('table', 'html')">
							<i class="fa fa-print print"></i>
						</button>
						<button class="btn btn-secondary-exp " id="exportBtn" onclick="location.reload()">
							<i class="fa fa-refresh refresh reload"></i>
						</button>

						<a href="edit_family.php?id=<?php echo $getPOC; ?>" class=" btn-secondary-exp btn-link"
							style="float: left; margin-left: 50px;">
							Edit Family Details
						</a>
					</div>

				</div>

			</div>
		</div>
		<br><br>
		<br>
		<div class="widget widget-container reportPageContainer" id="table"
			style="width: 100%; margin: auto;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: white; padding: 5px ; " ">
			
			<h3 style=" color: var(--accent-color);">Summary Report</h3>

			<span style=" color:black;font-size: 14px; margin-top: 100px; font-family: 'Courier New' , Courier, monospace;
		">

				<p>Date: <span id="currentDate"></span></p>
				<script>
					const now = new Date();
					const formattedDate = now.toLocaleDateString('en-GB') + ' ' + now.toLocaleTimeString('en-GB');
					document.getElementById('currentDate').textContent = formattedDate;
				</script>
			</span>

			<br>
			<div class=" widget-header">

				<p><span style="color: dimgrey; font-weight: bold;">Family ID:</span>
					<span style="color: var(--accent-color); font-weight: normal;"><?php echo $family_ID; ?></span>
				</p>
				<p><span style="color: dimgrey; font-weight: bold;">Area Code:</span>
					<span style="color: var(--accent-color); font-weight: normal;"><?php echo $area; ?></span>
				</p>
				<p><span style="color: dimgrey; font-weight: bold;">Head of Family:</span>
					<span style="color: var(--accent-color); font-weight: normal;"><?php echo $head; ?></span>
				</p>
				<p><span style="color: dimgrey; font-weight: bold;">Contact No.:</span>
					<span style="color: var(--accent-color); font-weight: normal;"><?php echo $contact_no; ?></span>
				</p>
				<p><span style="color: dimgrey; font-weight: bold;">Address:</span>
					<span style="color: var(--accent-color); font-weight: normal;"><?php echo $address; ?></span>
				</p>
			</div>
			<hr>
			<br>
			<h4 style="margin-left: 10px; color: var(--accent-color);">Members in the family</h4>

			<div>

				<table width="100%" border="1" class="data-table"
					style="border-collapse: collapse; font-family:  'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
					cellpadding="10">
					<tr>
						<td><b>Name</b></td>
						<td><b>Gender</b></td>
						<td><b>Phone No.</b></td>
						<td><b>Role</b></td>

					</tr>

					<?php
					$sql = "SELECT * FROM family_members WHERE poc = '$getPOC' AND stationID = '$STATION_CODE'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row['name'] . " " . $row['surname'] . "</td>";
							echo "<td>" . $row['gender'] . "</td>";
							echo "<td>" . $row['contact_no'] . "</td>";
							echo "<td>" . $row['relation_with_head'] . "</td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='5'>No records found.</td></tr>";
					}
					?>

				</table>
				<br>




			</div>


			<script type="text/javascript">
				document.getElementById('hideBtn').addEventListener('click', function () {
					// Get all cells in the column to hide
					const columnCells = document.querySelectorAll('.column-to-hide');
					const showHeader = document.getElementById('show-report-header');

					// Hide the column
					columnCells.forEach(cell => {
						cell.style.display = 'none';
						cell.style.border = 'none';
						showHeader.style.display = 'block';
						printJS({
							printable: 'printJS-form', type: 'html'
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
			<script src="../js/export.js"></script>
</body>

</html>