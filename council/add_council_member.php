<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<script src="../print.js"></script>
	<title></title>
</head>
<?php
$area_Code = "";
$area_Code = @$_POST['area_code'];
$val = $area_Code;
?>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>CREATE COUNCIL MEMBERS</h3>
	</div>
	<br>
	<div class="container-widgets" style="margin-bottom: 25px;">
		<div class="widget-row">
			<div class=" ">
				<div class="">
					<form id="search_family" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
						enctype="multipart/form-data">
						&nbsp;&nbsp;
						<label for="">Select Area Code</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="area_code" onchange="search()">
							<option hidden>-- --</option>
							<?php
							include "../connection.php";
							$sql = "SELECT * FROM council_master_table ORDER BY start_date DESC";
							$result = $conn->query($sql);

							while ($rows = $result->fetch_assoc()) {
								$start_date = $rows['start_date'];
								$end_date = $rows['end_date'];
								$id = $rows['ID'];
								?>
								<option value="<?php echo $id; ?>" <?php echo ($id == $area_Code) ? 'selected' : ''; ?>>
									<?php echo $start_date . ' - ' . $end_date; ?>
								</option>
							<?php }
							$conn->close();
							?>
						</select>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php include '../simpleSearchBox.php'; ?>
	<!--  data display -->
	<div class="container-widgets">
		<!-- Recent Transactions -->
		<div class="widget-row">
			<div class="widget table-widget" style="max-height: 55%;">
				<div class="widget-content">
					<table class="data-table" id="table">
						<thead>
							<tr>
								<th width="10%">ACTIONS</th>
								<th width="10%">ID</th>
								<th>Comittees Names</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include '../config/connection.php';

							$sql = "SELECT 
									council_master_table.start_date,
									council_master_table.end_date,
									council_group.group_name, 
									council_group.termID , council_group.ID as cgID

									FROM council_master_table 

									LEFT JOIN council_group 
									ON council_master_table.ID = council_group.termID				

										WHERE council_group.termID = '$area_Code' 
											AND council_group.stationID = '$STATION_CODE'";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td><a href="add_member.php?id=<?php echo $rows['cgID']; ?>">Add member</a></td>
									<td><?php echo $rows['cgID']; ?></td>
									<td><?php echo $rows['group_name']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript">
		function search() {
			document.getElementById("search_family").submit();
		}
	</script>

	<script src="../js/search_script.js"></script>
</body>

</html>