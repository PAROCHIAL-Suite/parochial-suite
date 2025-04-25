<?php
	include '../connection.php';
	if (isset($_POST['add_priest'])) {
		// code...
		$name = mysqli_real_escape_string($conn,$_REQUEST['name']);
		$designation = mysqli_real_escape_string($conn,$_REQUEST['designation']);
		$start_date = $_REQUEST['start_date'];

		$end_date = $_REQUEST['end_date'];


		$sql = "INSERT INTO priest values(
		'','$STATION_CODE','$name', '$designation', '$start_date', '$end_date')";
	    if(mysqli_query($conn, $sql)){	
     
	    } else{
	            echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	    } 

	}
	
	$getRecCount = "SELECT COUNT(*) as totalPriest FROM priest";
	$result = $conn->query($getRecCount);
					
	while ($rows=$result->fetch_assoc()){
		$total = $rows['totalPriest'];	
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>
<body>
	<?php include '../nav/superuser_nav.php'; ?>
	<br><br>
	<div class="pageName">	
		<h2>PRIEST</h2>
		<p>TOTAL RECORDS: <b><?php echo  $total; ?></b></p>
	</div>
	<br>


	<?PHP include '../simpleSearchBox.php'; ?>
	<div class="recordDisplayContainer" style="height: 70%; position: fixed; left: 8px;">
		<table class="recordDisplay" id="table" width="100%" >
			<tr>
				<th>NAME</th>
				<th>PARISH ID</th>
				<th>DESIGNATION</th>
				<th>START DATE</th>
				<th>END DATE</th>
				<!-- <th>ACTIONS</th> -->
			</tr>
			<?php
				
				$sql = "SELECT * FROM priest  ORDER BY start_date DESC";
				$result = $conn->query($sql);
					
				while ($rows=$result->fetch_assoc()){
					$id = $rows['ID'];
			?>			
			<tr>
				<!-- <TD></TD> -->
				<td><?php echo $rows['name']; ?></td>
				<td><?php echo $rows['stationID']; ?></td>
				<td><?php echo $rows['designation']; ?></td>
				<td><?php echo $rows['start_date']; ?></td>
				<td><?php echo $rows['end_date']; ?></td>
				<!-- <td><a href="edit_priest.php?id=<?php echo $rows['ID']; ?>">Edit</a></td> -->

			</tr>
		<?php } ?>
		</table>
	</div>

	<script src="../js/search_script.js"></script>
	<script src="../js/exportToExcel.js"></script>	
		<script type="text/javascript">
        // Initialize jsPDF
		const { jsPDF } = window.jspdf;
		        
		function exportTableToPDF() {
		  // Get the table element
		  const table = document.getElementById("table");
		            
		            // Options for html2canvas
		  const options = {
		    scale: 2, // Higher scale for better quality
		    useCORS: true, // Enable cross-origin images
		    logging: false // Disable logging
		  };
		            
		            // Convert table to canvas
		  html2canvas(table, options).then((canvas) => {
		    // Create PDF
		    const pdf = new jsPDF('p', 'mm', 'a4');
		    const imgData = canvas.toDataURL('image/png');
		            
		                // Calculate PDF page dimensions
		    const pdfWidth = pdf.internal.pageSize.getWidth();
		    const pdfHeight = pdf.internal.pageSize.getHeight();
		                
		                // Calculate image dimensions to fit the PDF
		    const imgWidth = pdfWidth - 20; // 10mm margin on each side
		    const imgHeight = (canvas.height * imgWidth) / canvas.width;
		            
		            // Add image to PDF
		    pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
		              
		                // Save the PDF
		    pdf.save('table_export.pdf');
		  });
		}		
	</script>
</body>
</html>

