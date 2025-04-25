<?php
	include('../mobile_connection.php');
	$code = $_GET['id'];
	$sql = "SELECT count(*) AS family_count  FROM u381709061_mobile_db.users WHERE city_code = '$code'";
	$result = $conn_mob->query($sql);
			
	while ($rows=$result->fetch_assoc()){ 
	    $total = $rows['family_count'];
	}

	$sql1 = "SELECT location FROM u381709061_mobile_db.churches WHERE code = '$code'";
	$result = $conn_mob->query($sql1);
			
	while ($rows=$result->fetch_assoc()){ 
	    $location = $rows['location'];
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
		<h2>FAMLIES IN <?php echo $location; ?></h2>
		<p>TOTAL RECORDS : <b><?php echo  $total; ?></b></p>
	</div>
	<br>


	<?PHP include '../simpleSearchBox.php'; ?>
	<div class="recordDisplayContainer" style="height: 70%; position: fixed; left: 8px;">
		<table class="recordDisplay" id="table" width="100%" >
			<tr>
			
				<th>CITY CODE</th>
				<th>NAME OF THE FAMILY HEAD</th>
				<th>CONTACT</th>
				<th>ADDRESS</th>

				<!-- <th>ACTIONS</th> -->
			</tr>
			<?php

				$sql = "SELECT * FROM u381709061_mobile_db.users WHERE city_code = '$code'";
				$result = $conn_mob->query($sql);
					
				while ($rows=$result->fetch_assoc()){
					
			?>			
			<tr>
				<!-- <TD></TD> -->
				<td><?php echo $rows['city_code']; ?></td>
				<td><?php echo $rows['name']; ?></td>
				<td><?php echo $rows['contact']; ?></td>
				
				<td><?php echo $rows['address']; ?></td>
				

				<!--<td><a href="family.php?id=<?php echo $rows['code']; ?>">Edit</a></td>-->

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

