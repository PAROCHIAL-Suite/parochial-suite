<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sample HTML Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <!-- <link rel="stylesheet" type="text/css" href="../print.css">
    <script src="../print.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">


    <style type="text/css">
        #data td:nth-child(1) {
            background: ;
            padding-left: 30px;
        }

        .widget-container {
            width: 50%;
            height: 100%;
            background-color: white;
            padding: 30px;
            border: 1px solid lightgrey;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .reportContainer {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 0px;
            border: none;
            background-color: white;

        }
    </style>
</head>

<body>
    <div class="ps-flex-layout max-height">
        <div class="ps-left-panel ps-print-dialog" style="height: 50%;">
            <h4>PRINT SETTINGS</h4>
            <br>
            <div style="margin-top: 20px;">
                <input type="checkbox" id="printWithHeader" checked>
                <label for="printWithHeader">Print with header</label>
            </div>
            <br><br>
            <button type="button" class="btn-link" onclick="printWithHeaderOption()">
                Print
            </button>
            <br><br>
            <label>
                <i>
                    Create PDF and save to archive.
                </i>
            </label>
            <div style="margin-top: 20px;">
                <button type="button" class="btn-link saveToArchive" onclick="saveReportAsPDF()">
                    Save To Archive
                </button>
            </div>
        </div>

    </div>
    <script>
        // Toggle header visibility based on checkbox before printing
        document.addEventListener('DOMContentLoaded', function () {
            var printWithHeader = document.getElementById('printWithHeader');
            var emptySpace = document.getElementById('letterHeadSpace');
            var header = document.getElementById('showHeader');

            // Initial state
            if (printWithHeader.checked) {
                if (header) header.style.display = '';
                if (emptySpace) emptySpace.style.display = 'none';
            } else {
                if (header) header.style.display = 'none';
                if (emptySpace) emptySpace.style.display = '';
            }

            // Toggle on checkbox change
            printWithHeader.addEventListener('change', function () {
                if (this.checked) {
                    if (header) header.style.display = '';
                    if (emptySpace) emptySpace.style.display = 'none';
                } else {
                    if (header) header.style.display = 'none';
                    if (emptySpace) emptySpace.style.display = '';
                }
            });
        });

        function printWithHeaderOption() {
            var printWithHeader = document.getElementById('printWithHeader').checked;
            var header = document.getElementById('showHeader');
            var emptySpace = document.getElementById('letterHeadSpace');

            // Show/hide header and empty space for print
            if (printWithHeader) {
                if (header) header.style.display = '';
                if (emptySpace) emptySpace.style.display = 'none';
            } else {
                if (header) header.style.display = 'none';
                if (emptySpace) emptySpace.style.display = '';
            }

            printJS('reportContainer', 'html');

            // Restore to match checkbox state after print
            setTimeout(function () {
                if (printWithHeader) {
                    if (header) header.style.display = '';
                    if (emptySpace) emptySpace.style.display = 'none';
                } else {
                    if (header) header.style.display = 'none';
                    if (emptySpace) emptySpace.style.display = '';
                }
            }, 1000);
        }

        // Attach to button
        document.addEventListener('DOMContentLoaded', function () {
            var printBtn = document.querySelector('button[onclick*="printJS"]');
            if (printBtn) {
                printBtn.onclick = printWithHeaderOption;
            }
        });

        function saveReportAsPDF() {
            var reportContainer = document.getElementById('reportContainer');
            if (!reportContainer) {
                alert('Report container not found!');
                return;
            }
            var printWithHeader = document.getElementById('printWithHeader').checked;
            var header = document.getElementById('showHeader');
            if (header) {
                header.style.display = printWithHeader ? '' : 'none';

            }
            var reportName = "Baptism_Certificate";
            html2canvas(reportContainer).then(function (canvas) {
                var imgData = canvas.toDataURL('image/png');
                var pdf = new window.jspdf.jsPDF('p', 'mm', 'a4');
                var pageWidth = pdf.internal.pageSize.getWidth();
                var imgProps = pdf.getImageProperties(imgData);
                var pdfWidth = pageWidth;
                var pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                var pdfBlob = pdf.output('blob');
                var formData = new FormData();
                formData.append('pdf', pdfBlob, reportName + '.pdf');
                formData.append('folder', 'archive/baptism');
                fetch('../savePdf.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('PDF saved successfully!');
                        } else {
                            alert('Failed to save PDF: ' + data.error);
                        }
                    })
                    .catch(error => {
                        alert('Error saving PDF: ' + error);
                    })
                    .finally(() => {
                        // Restore header after PDF save
                        if (header) header.style.display = '';
                    });
            });
        }
    </script>
</body>

</html>