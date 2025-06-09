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
    const months = [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];
    const now = new Date();
    const formattedDate = `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear().toString().slice(-2)}`;

    // Create the header HTML as in exportToWord
    const htmlHeader = `
        <div style="text-align: left;">
            <p
                style="margin:0; font-family: 'Archivo'; font-size:1.6rem; font-weight: 600; letter-spacing: 1px; color:rgb(205, 0, 31);">
                PAROCHIAL<span class="span"
                    style="color:rgb(46, 47, 49); font-weight: 500; margin-left: 2px;">Suite</span>
            </p>
        </div>
        <hr><br>
        <div style="text-align: right; font-size: 12px; color: dimgrey; font-family: 'Archivo', sans-serif;">
             ${formattedDate} at ${now.toLocaleTimeString()}
        </div>
        <br>
    `;

    // Create a wrapper div to combine header and content
    const wrapper = document.createElement('div');
    wrapper.innerHTML = htmlHeader;
    wrapper.appendChild(clonedElement);

    // Set the HTML content to be used for Word export
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
                    text-align: left;
                    font-family: 'Archivo', sans-serif;
                    font-size: 12px;
                    width: 100%;
                }
                th{
                    background-color: #f2f2f2;
                    border: 1px solid black;
                    font-family: 'Archivo', sans-serif;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                    float: left;
                }
            </style>
        </head>
        <body>
            ${wrapper.innerHTML}
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




       function showPDFProgressBar() {
            const overlay = document.getElementById('pdf-progress-overlay');
            const bar = document.getElementById('pdf-progress-bar');
            overlay.style.display = 'flex';
            bar.style.width = '0%';
            let percent = 0;
            overlay._interval = setInterval(() => {
                percent = Math.min(percent + 5, 95);
                bar.style.width = percent + '%';
            }, 200);
        }
        function hidePDFProgressBar() {
            const overlay = document.getElementById('pdf-progress-overlay');
            clearInterval(overlay._interval);
            overlay.style.display = 'none';
        }

        
function exportToPDF(elementId, filename = 'export.pdf') {
    let progressTimeout;
    let progressShown = false;

    // Load required libraries dynamically
    const jsPDFScript = document.createElement('script');
    jsPDFScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';

    const html2canvasScript = document.createElement('script');
    html2canvasScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';

    document.head.appendChild(jsPDFScript);
    document.head.appendChild(html2canvasScript);

    Promise.all([
        new Promise(resolve => { jsPDFScript.onload = resolve; }),
        new Promise(resolve => { html2canvasScript.onload = resolve; })
    ]).then(() => {
        const element = document.getElementById(elementId);
        const { jsPDF } = window.jspdf;

        // Show progress bar if process takes more than 2.5 seconds
        progressTimeout = setTimeout(() => {
            showProgressBar();
            progressShown = true;
        }, 2500);

        html2canvas(element, {
            scale: 2,
            logging: false,
            useCORS: true,
            allowTaint: true
        }).then(canvas => {
            // Check file size first
            canvas.toBlob(blob => {
                if (blob && blob.size > 1024 * 1024 && !progressShown) {
                    clearTimeout(progressTimeout);
                    showProgressBar();
                    progressShown = true;
                }
                // Start exporting after file size check and progress bar if needed
                generatePDF(canvas);
            }, 'image/png');
        });

        function generatePDF(canvas) {
            clearTimeout(progressTimeout);

            // ...existing PDF generation code...
            const months = [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            const now = new Date();
            const formattedDate = `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear().toString().slice(-2)}`;

            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const margin = 15;
            const pageWidth = 210;
            const pageHeight = 295;
            const usableWidth = pageWidth - margin * 2;
            const imgHeight = canvas.height * usableWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = margin + 20;

            // Add header
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(18);
            pdf.setTextColor(205, 0, 31);
            pdf.text('PAROCHIAL', margin, margin + 8);
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(16);
            pdf.setTextColor(46, 47, 49);
            pdf.text('Suite', margin + 38, margin + 8);
            pdf.setDrawColor(150);
            pdf.setLineWidth(0.5);
            pdf.line(margin, margin + 11, pageWidth - margin, margin + 11);
            pdf.setFontSize(14);
            pdf.setTextColor(105, 105, 105);
            pdf.text(`${formattedDate} at ${now.toLocaleTimeString()}`, pageWidth - margin, margin + 8, { align: 'right' });

            // Add image (content)
            pdf.addImage(imgData, 'PNG', margin, position, usableWidth, imgHeight);
            heightLeft -= (pageHeight - position);

            // Add new pages if content is longer than one page
            while (heightLeft > 0) {
                pdf.addPage();
                // Add header on each page
                pdf.setFont('helvetica', 'bold');
                pdf.setFontSize(18);
                pdf.setTextColor(205, 0, 31);
                pdf.text('PAROCHIAL', margin, margin + 8);
                pdf.setFont('helvetica', 'normal');
                pdf.setFontSize(10);
                pdf.setTextColor(46, 47, 49);
                pdf.text('Suite', margin + 45, margin + 8);
                pdf.setDrawColor(150);
                pdf.setLineWidth(0.5);
                pdf.line(margin, margin + 11, pageWidth - margin, margin + 11);
                pdf.setFontSize(10);
                pdf.setTextColor(105, 105, 105);
                pdf.text(`${formattedDate} at ${now.toLocaleTimeString()}`, pageWidth - margin, margin + 8, { align: 'right' });

                position = margin + 20;
                pdf.addImage(
                    imgData,
                    'PNG',
                    margin,
                    position - (imgHeight - heightLeft),
                    usableWidth,
                    imgHeight
                );
                heightLeft -= (pageHeight - position);
            }

            pdf.save(filename);

            // Hide progress bar after download starts
            if (progressShown) hideProgressBar();
        }
    });
}
// Usage:
// exportToPDF('myTable', 'table_export.pdf');df');
// exportToPDF('contentToExport', 'div_content.pdf');