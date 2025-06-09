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


// TO FILTER TABLE UNIT WISE
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

// TO FILTER TABLE
// Function to sort the table based on the clicked column and add sorting icons
function sortTable(columnIndex) {
  const table = document.getElementById("table");
  const rows = Array.from(table.rows).slice(1); // Exclude header row
  const header = table.rows[0].cells[columnIndex]; // Get the header cell
  const isAscending = header.getAttribute("data-sort") !== "asc"; // Determine sort direction

  // Reset all header icons
  Array.from(table.rows[0].cells).forEach(cell => {
    cell.setAttribute("data-sort", "");
    const iconSpan = cell.querySelector(".sort-icon");
    if (iconSpan) iconSpan.remove(); // Remove existing icons
  });

  // Add sorting icon to the clicked header
  header.setAttribute("data-sort", isAscending ? "asc" : "desc");
  const icon = document.createElement("span");
  icon.className = "sort-icon";
  icon.style.color = isAscending ? "dimgrey" : "dimgrey"; // Set color based on sort direction
  icon.style.marginLeft = "3px";
  icon.style.fontSize = "0.8em"; // Adjust icon size
  icon.textContent = isAscending ? "▲" : "▼";
  header.appendChild(icon);

  rows.sort((a, b) => {
    const cellA = a.cells[columnIndex].innerText.toLowerCase();
    const cellB = b.cells[columnIndex].innerText.toLowerCase();

    if (cellA < cellB) return isAscending ? -1 : 1;
    if (cellA > cellB) return isAscending ? 1 : -1;
    return 0;
  });

  rows.forEach(row => table.appendChild(row)); // Reorder rows in the table
}

// Add event listeners to header cells for sorting and add initial sort icons
const headers = document.querySelectorAll("#table thead th");
if (headers.length === 0) {
  console.error("No table headers found. Ensure your table has a <thead> with <th> elements.");
} else {
  headers.forEach((header, index) => {
    // Add a default icon to indicate the column is sortable
    const defaultIcon = document.createElement("span");
    defaultIcon.className = "sort-icon";
    defaultIcon.style.color = "gray";
    defaultIcon.style.marginLeft = "5px";
    defaultIcon.textContent = "⇅"; // Default icon for sortable columns
    header.appendChild(defaultIcon);

    // Add click event listener for sorting
    header.addEventListener("click", () => sortTable(index));
  });
}

