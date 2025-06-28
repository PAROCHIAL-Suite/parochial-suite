<?php
include '../config/connection.php';
$id = $_GET['famID'];

$sql = "SELECT * FROM family_member WHERE family_ID = '$id' AND relation_with_head = 'Head' AND stationID = '$STATION_CODE'";
$result = $conn->query($sql);

while ($rows = $result->fetch_assoc()) {
	$family_name = $rows['surname'];
	$family_ID = $rows['family_ID'];
	$area = $rows['area_code'];
	$head = $rows['name'] . " " . $rows['surname'];
	$contact_no = $rows['contact_no'];
	$address = $rows['address'];
}


$sql = "SELECT * FROM family_member WHERE family_ID = '$id' AND stationID = '$STATION_CODE'";
$result = $conn->query($sql);

while ($rows = $result->fetch_assoc()) {
	$name = $rows['name'] . " " . $rows['surname'];
	$status = $rows['status'];
	$gender = $rows['gender'];
	$dob = $rows['dob'];
	$blood_group = $rows['blood_group'];
	$contact_no = $rows['contact_no'];
	$email = $rows['email'];
	$relation_with_head = $rows['relation_with_head'];
	$relationship_status = $rows['relationship_status'];
	$qualification = $rows['qualification'];
	$occupation = $rows['occupation'];
	$baptism = $rows['baptism'];
	$communion = $rows['eucharist'];
	$confirmation = $rows['confirmation'];

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
		.head {
			font-family: sans-serif;
		}
	</style>
</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<!-- PAGE TITLE -->
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="20%">
					<h3 class="pageName">FAMILY VIEW</h3>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<div class="searchContainer">
		<table border="0">
			<td width="5%" style="text-align: center;">
			</td>

			<td width="3%">
				<button onclick="location.reload();">
					<i style="font-size:17px; color: green" class="fa">&#xf021;</i>
				</button>
			</td>
			<td width="3%">
				<button style="font-size: 18px;" type="button" onclick="" id="hideBtn">
					<i class="fa">&#xf02f;</i>
				</button>
			</td>
			<td width="">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="create_member.php?id=<?php echo $id; ?>" style="text-decoration: none;">
					<button>Add Member</button>
				</a>
				<a href="edit_family.php?id=<?php echo $id; ?>" style="text-decoration: none;">
					<button>Edit Family Details</button>
				</a>

			</td>
		</table>
	</div>
	<br>
	<div class="container reportPageContainer">
		<div id="printJS-form">
			<div style="border-bottom:  double ;text-align: center; font-family: 'Calibri', sans-serif; display: none;"
				id="show-report-header">
				<h1 style=" margin-bottom: -10px;">St. Joseph's Church, Gondia</h1>
				<table width="100%">
					<tr>
						<td width="70%">
							<p style="float: left;font-size: 20px; font-weight: bold;">Member Profile Report</p>
						</td>
						<td>
							<p style="float: right;"><?php echo date("d-M-Y"); ?></p>
						</td>
					</tr>
				</table>
			</div>
			<br>
			<table width="100%" border="1" style="
				border: 1px solid lightgray; 
				border-collapse: collapse; 
				 font-family: 'Titillium Web', calibri;">

				<tr style="height: 40px;">
					<td width="10%"><b>Family ID</b></td>
					<td width="10%"><b>Area Code</b></td>
					<td width="20%"><b>Head of family</b></td>
					<td width="10%"><b>Contact</b></td>
					<td width="20%"><b>Address</b></td>
					<td class="column-to-hide" width="1%"><b></b></td>
				</tr>

				<tr>
					<td><?php echo @$family_ID; ?></td>
					<td><?php echo @$area; ?></td>
					<td><?php echo @$head; ?></td>
					<td><?php echo @$contact_no; ?></td>
					<td><?php echo @$address; ?></td>
				</tr>
			</table>
			<br>
			<table width="100%" border="1" style="
				border: 1px solid lightgray; 
				border-collapse: collapse; 
				 font-family: 'Titillium Web', calibri;">
				<tr>
					<td><b>Name</b></td>
					<td><?php echo $name; ?></td>
					<td><b>Role in family</b></td>
					<td><?php echo $relation_with_head; ?></td>
					<td><b>Status</b></td>
					<td><?php echo $status; ?></td>
				</tr>
				<tr>
					<td><b>Sex</b></td>
					<td><?php echo $gender; ?></td>
					<td><b>Date of Birth</b></td>
					<td><?php echo $dob; ?></td>
					<td><b>Blood Group</b></td>
					<td><?php echo $blood_group; ?></td>
				</tr>
				<tr>
					<td><b>Phone</b></td>
					<td><?php echo $contact_no; ?></td>
					<td><b>Email Add.</b></td>
					<td colspan="3"><?php echo $email; ?></td>

				</tr>
				<tr>
					<td><b>Qualification</b></td>
					<td><?php echo $qualification; ?></td>
					<td><b>Occupation</b></td>
					<td><?php echo $occupation; ?></td>
					<td><b>Relationship Status</b></td>
					<td><?php echo $relationship_status; ?></td>
				</tr>

				<tr>
					<td><b>Baptism</b></td>
					<td><?php echo $baptism; ?></td>
					<td><b>Communion</b></td>
					<td><?php echo $communion; ?></td>
					<td><b>Confirmation</b></td>
					<td><?php echo $confirmation; ?></td>
				</tr>
			</table>
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

</body>

</html>