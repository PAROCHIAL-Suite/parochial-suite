
// csv = target table ID;
// filename = Your desired file name for the exported file.

function downloadCSV(csv, filename) {
    let csvFile;
    let downloadLink;

    csvFile = new Blob([csv], { type: "text/csv" });

        downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";

        document.body.appendChild(downloadLink);
        downloadLink.click();
}

function exportToExcel(tableId, filename) {
    let csv = [];
    let rows = document.querySelectorAll("#" + tableId + " tr");

    for (let i = 0; i < rows.length; i++) {
        let row = [];
        let cols = rows[i].querySelectorAll("td, th");
        
        for (let j = 0; j < cols.length; j++) {
            row.push(cols[j].innerText);
        }

        csv.push(row.join(","));
    }
        downloadCSV(csv.join("\n"), filename);
}
 
/**
 * Converts HTML table or div content to a Word document and downloads it
 * @param {string} elementId - The ID of the table or div to convert
 * @param {string} fileName - The name for the downloaded Word file (without extension)
 */
function exportToWord(elementId, fileName = 'document') {
    // Get the HTML element
    const element = document.getElementById(elementId);
    
    if (!element) {
        console.error(`Element with ID '${elementId}' not found.`);
        return;
    }

    // Clone the element to avoid modifying the original
    const clonedElement = element.cloneNode(true);
    
    // Create a blob with the HTML content
    const htmlContent = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" 
              xmlns:w="urn:schemas-microsoft-com:office:word" 
              xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta charset="UTF-8">
            <title>Word Document</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            ${clonedElement.outerHTML}
        </body>
        </html>
    `;

    // Create a Blob with the HTML content
    const blob = new Blob(['\ufeff', htmlContent], {
        type: 'application/msword'
    });

    // Create download link
    const downloadLink = document.createElement('a');
    const url = URL.createObjectURL(blob);
    
    downloadLink.href = url;
    downloadLink.download = `${fileName}.doc`;
    document.body.appendChild(downloadLink);
    
    // Trigger the download
    downloadLink.click();
    
    // Clean up
    setTimeout(() => {
        document.body.removeChild(downloadLink);
        URL.revokeObjectURL(url);
    }, 100);
}



function exportToPDF(elementId, filename = 'export.pdf') {
    // Load required libraries dynamically
    const jsPDFScript = document.createElement('script');
    jsPDFScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
    
    const html2canvasScript = document.createElement('script');
    html2canvasScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';
    
    document.head.appendChild(jsPDFScript);
    document.head.appendChild(html2canvasScript);
    
    // Wait for both libraries to load
    Promise.all([
        new Promise(resolve => { jsPDFScript.onload = resolve; }),
        new Promise(resolve => { html2canvasScript.onload = resolve; })
    ]).then(() => {
        const element = document.getElementById(elementId);
        const { jsPDF } = window.jspdf;
        
        html2canvas(element, {
            scale: 2, // Higher quality
            logging: false,
            useCORS: true,
            allowTaint: true
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const imgWidth = 210; // A4 width in mm
            const pageHeight = 295; // A4 height in mm
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;
            
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
            
            // Add new pages if content is longer than one page
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            
            pdf.save(filename);
        });
    });
}

// Usage:
// exportToPDF('myTable', 'table_export.pdf');
// exportToPDF('contentToExport', 'div_content.pdf');