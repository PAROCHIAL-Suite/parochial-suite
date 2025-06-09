<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<script src="../print.js"></script>
	<title></title>
</head>


<body>
	<div class="container-widgets " style="margin-bottom: 55px;">
		<div class="widget-row ">
			<div class="widget table-widget ">
				<div class="widget-header "
					style="background-color:rgba(231, 236, 249, 0.48); border:none !important; ">
					<div class="search-actions ">
						<button class=" btn btn-secondary-exp " id=" exportBtn"
							onclick="exportToExcel('table', document.title)">
							<i class="fa fa-file-excel-o excel" title="Export to Microsoft Excel File (.csv)"></i>
						</button>
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
					</div>
					<div class="search-actions">

					</div>


					<div class="search-actions" style="float: left;">

						<input type="text" id="searchbox" name="searchbox" class="search-input"
							placeholder="Type here to search" style="min-width: 400px;">
						<i class="fa-solid fa-magnifying-glass"></i>

					</div>
					<p>Total Records: <span id="rowCount">0</span></p>
				</div>
			</div>
		</div>
	</div>
	<script src="../js/export.js"></script>

	<script>
		const pageTitle = document.title;
		// Function to count rows in the table (excluding the header)
		function updateRowCount() {
			const table = document.getElementById('table');
			const rowCount = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
			document.getElementById('rowCount').textContent = rowCount;
		}

		// Update row count on page load
		window.addEventListener('DOMContentLoaded', updateRowCount);
	</script>
</body>

</html>