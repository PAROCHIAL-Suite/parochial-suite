<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

<body>

	<div class="searchContainer">

		<table border="0" width="100%">
			<tr>
				<td colspan="5" width="50%">
					<input type="text" name="query" id="searchbox" placeholder="Type here...">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>

				<td width="4%"><i style="font-size:17px; float: right; margin-right:14px;" class="fa">&#xf0b0;</i>
				</td>

				<td width="8%">
					<p>Sort by area/unit: </p>
				</td>
				<td width="20%">
					<select name="sort_by_area_code" id="filterByArea" style="width: 170px;">
						<option value="">All</option>
						<?php
						include "../connection.php";
						$sql = "SELECT * FROM area_mapping";
						$result = $conn->query($sql);

						while ($rows = $result->fetch_assoc()) {
							$area_Code = $rows['area_code'];
							$area_Name = $rows['area_name'];
							?>
							<option value="<?php echo $rows['area_code']; ?>">
								<?php echo $rows['area_code'];
						} ?>
						</option>
					</select>

					<button onclick="location.reload();">Clear Filter</button>
				</td>
				<td width="5%">
					&nbsp;&nbsp;&nbsp;&nbsp;
					<button onclick="location.reload();" title="Refresh">
						<i style="font-size:17px; color: green" class="fa">&#xf021;</i></button>
				</td>

				<td>
					<button class="excelBtn" onclick="exportToExcel('table', 'Exported from parochilcloud')">Export as
						excel</button>
				</td>
			</tr>
		</table>
	</div>

	<script type="text/javascript">
		function updateRowCount(tableId) {
			const table = document.getElementById(tableId);
			const countElement = table.querySelector('.row-count');
			const dataRows = table.rows.length - 1; // Exclude header

			countElement.textContent = dataRows;
		}

		window.addEventListener('DOMContentLoaded', () => {
			updateRowCount('table');
		});

	</script>
</body>

</html>