<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/parochialUI.css">
	<title></title>
</head>

<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>ADD A MEMBER</h3>
	</div>
	<br>

	<div class="container-widgets" style="margin-bottom: 25px;">
		<div class="widget-row">
			<div class=" ">
				<div class="">
					<form id="search_family" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
						enctype="multipart/form-data">
						&nbsp;&nbsp;
						<label for="">Select Area Code to display data</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="area_code" onchange="this.form.submit()">
							<option hidden>Area Code</option>
							<?php
							include "../connection.php";
							$sql = "SELECT * FROM area_mapping ORDER BY area_code ASC";
							$result = $conn->query($sql);
							if ($result->num_rows == 0) {
								$msg = "No area code found";
								echo "<script type='text/javascript'>alert('$msg');</script>";
							} else {
								// Get the selected area_code from POST
								$selected_area_code = isset($_POST['area_code']) ? $_POST['area_code'] : '';

								while ($rows = $result->fetch_assoc()) {
									$area_Code = $rows['area_code'];
									$area_Name = $rows['area_name'];
									?>
									<option value="<?php echo $area_Code; ?>" <?php echo ($area_Code == $selected_area_code) ? 'selected' : ''; ?>>
										<?php echo $area_Name; ?>
									</option>

								<?php }
							}
							$conn->close();
							?>
						</select>
					</form>
				</div>
			</div>
		</div>
		<!-- form to add new priest -->


		<?php
		$area_Code = "";
		$area_Code = @$_POST['area_code'];
		?>

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
								<th>ACTIONS</th>
								<th>Family ID</th>
								<th>Family Head</th>
								<th>Contact</th>
								<th>Area Code</th>
								<th>Address</th>

							</tr>
						</thead>
						<tbody>
							<?php
							include '../config/connection.php';
							$sc = $_COOKIE['user'];
							$sql = "SELECT * FROM family_members WHERE area_code = '$area_Code' AND
				relation_with_head = 'Head' AND stationID = '$sc'";
							$result = $conn->query($sql);
							while ($rows = $result->fetch_assoc()) {
								?>
								<tr>
									<td><a href="create_member.php?id=<?php echo $rows['family_ID']; ?>">Add member</a>
									</td>
									<td><?php echo $rows['family_ID']; ?></td>
									<td><?php echo $rows['name'] . " " . $rows['surname']; ?></td>
									<td><?php echo $rows['contact_no']; ?></td>
									<td><?php echo $rows['area_code']; ?></td>
									<td><?php echo $rows['address']; ?></td>
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
	<script src="../js/export.js"></script>
</body>

</html>