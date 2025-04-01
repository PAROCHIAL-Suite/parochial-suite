// SEARCHING THOUGHT OUT THE TABLE
// Get the input element and the table element
var input = document.getElementById("searchbox");
var table = document.getElementById("table");

// Add an event listener to the input element
input.addEventListener("keyup", function(event) {
  // Get the value of the input
  var value = event.target.value.toLowerCase();
  // Get all the table rows
  var rows = table.getElementsByTagName("tr");
  // Loop through the rows
  for (var i = 0; i < rows.length; i++) {
    // Get the cells in the current row
    var cells = rows[i].getElementsByTagName("td");
    // Loop through the cells
    for (var j = 0; j < cells.length; j++) {
      // Get the text content of the cell
      var text = cells[j].textContent.toLowerCase();
      // Check if the text contains the input value
      if (text.indexOf(value) > -1) {
        // Show the row if it does
        rows[i].style.display = "";
        //document.getElementById("notFound").style.display = "none";
        // Break out of the inner loop
        break;
      } else {
        // Hide the row if it doesn't
        rows[i].style.display = "none";
        //document.getElementById("notFound").style.display = "block";
      }
    }
  }
});


// TO FILTER TABLE UNITE WISE
document.getElementById('filterByArea').addEventListener('change', function() {
  const filterValue = this.value.toLowerCase(); // Get the selected value and convert to lowercase
  const table = document.getElementById('table');
  const rows = table.getElementsByTagName('tr');

  // Loop through all table rows (starting from index 1 to skip the header row)
  for (let i = 1; i < rows.length; i++) {
    const secondColumn = rows[i].getElementsByTagName('td')[1]; // Get the second column (index 1)
    if (secondColumn) {
      const textValue = secondColumn.textContent || secondColumn.innerText;
      if (filterValue === "" || textValue.toLowerCase() === filterValue) {
        rows[i].style.display = ''; // Show the row if it matches the filter or if no filter is selected
      } else {
        rows[i].style.display = 'none'; // Hide the row if it doesn't match the filter
      }
    }
  }
});


//  to generate pdf from table
//         // Initialize jsPDF
// const { jsPDF } = window.jspdf;
        
// function exportTableToPDF() {
//   // Get the table element
//   const table = document.getElementById("table");
            
//             // Options for html2canvas
//   const options = {
//     scale: 2, // Higher scale for better quality
//     useCORS: true, // Enable cross-origin images
//     logging: false // Disable logging
//   };
            
//             // Convert table to canvas
//   html2canvas(table, options).then((canvas) => {
//     // Create PDF
//     const pdf = new jsPDF('p', 'mm', 'a4');
//     const imgData = canvas.toDataURL('image/png');
            
//                 // Calculate PDF page dimensions
//     const pdfWidth = pdf.internal.pageSize.getWidth();
//     const pdfHeight = pdf.internal.pageSize.getHeight();
                
//                 // Calculate image dimensions to fit the PDF
//     const imgWidth = pdfWidth - 20; // 10mm margin on each side
//     const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
//             // Add image to PDF
//     pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
              
//                 // Save the PDF
//     pdf.save('table_export.pdf');
//   });
// }