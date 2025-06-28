<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/ui.css">
    <link rel="stylesheet" type="text/css" href="../print.css">
    <script src="../print.js"></script>


    <title>Certificate - <?php echo $_GET['reg_no']; ?></title>
</head>

<body>
    <?php @include '../nav/app_header_nav.php';
    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName card-heading">
        <table border="0">
            <tr>
                <td width="40%">
                    <h3>CERTIFICATE PRINTING</h3>
                </td>
            </tr>
        </table>
    </div>
    <br>

    <?php require_once '../printNav.php'; ?>

    <div class="widget-container" id="reportContainer">
        <div class="reportContainer">
            <div class="reportContent">
                <div id="showHeader">
                    <?php include '../prefrences/letterHead_header.php'; ?>
                </div>
                <div id="letterHeadSpace" style=" height: 126px; display: none !important;"></div>
                <br>
                <div
                    style="text-align: center; font-size: 29px; font-style: italic; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Certificate of Burial</div>
                <br>
                <?php
                include '../config/connection.php';
                $reg_no = $_GET['reg_no'];
                $sql = "SELECT * FROM burial WHERE reg_no = '$reg_no'";
                $result = $conn->query($sql);
                if ($rows = $result->fetch_assoc()) {
                    ?>
                    <table class="certificateData" id="printContent" width="100%" border="0" cellpadding="0"
                        cellspacing="13" style="margin-left: 50px;">
                        <tr>
                            <td width="5%">1.</td>
                            <td width="20%">Registration No</td>
                            <td width="4px">:</td>
                            <td><?php echo htmlspecialchars($rows['reg_no']); ?></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Date of Death</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['date_of_death']); ?></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Date of Burial</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['date_of_burial']); ?></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['name']); ?></td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Surname</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['surname']); ?></td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Date of Birth</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['dob']); ?></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>Gender</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['gender']); ?></td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['address']); ?></td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Cause of Death</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['cause_of_death']); ?></td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>Source of Information</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['source_of_info']); ?></td>
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td>Grave No.</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['grave_no']); ?></td>
                        </tr>
                        <tr>
                            <td>12.</td>
                            <td>Minister Name</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($rows['minister_name']); ?></td>
                        </tr>
                        <tr>
                            <td>13.</td>
                            <td>Remarks</td>
                            <td>:</td>
                            <td style="font-size: 14px; font-style: italic">
                                <?php echo htmlspecialchars($rows['remarks']); ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                } else {
                    echo "<div style='color:red;'>No record found.</div>";
                }
                ?>
                <?php include '../prefrences/certificate_footer.php'; ?>
            </div>
        </div>
    </div>
    <br><br>
</body>

</html>