<?php
// Database connection
include '../config/connection.php';
// include('../mobile_connection.php');


$getFamilyCount = "SELECT COUNT(*) AS totalFamilyCount FROM users";
$result = $conn->query($getFamilyCount);

while ($rows = $result->fetch_assoc()) {
    $totalFamilyCount = $rows['totalFamilyCount'];
}

$baptismCount = "SELECT COUNT(*) AS baptismCount FROM baptism";
$result = $conn->query($baptismCount);
while ($rows = $result->fetch_assoc()) {
    $baptismCount = $rows['baptismCount'];
}
$communionCount = "SELECT COUNT(*) AS communionCount FROM eucharist";
$result = $conn->query($communionCount);

while ($rows = $result->fetch_assoc()) {
    $communionCount = $rows['communionCount'];
}
$confirmationCount = "SELECT COUNT(*) AS confirmationCount FROM confirmation";
$result = $conn->query($confirmationCount);
while ($rows = $result->fetch_assoc()) {
    $confirmationCount = $rows['confirmationCount'];
}
$burialCount = "SELECT COUNT(*) AS burialCount FROM burial";

$result = $conn->query($burialCount);
while ($rows = $result->fetch_assoc()) {
    $burialCount = $rows['burialCount'];
}
$getMemberCount = "SELECT COUNT(*) AS totalUsers FROM family_member";
$result = $conn->query($getMemberCount);
while ($rows = $result->fetch_assoc()) {
    $getMemberCount = $rows['totalUsers'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/parochialUI.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <?php include '../nav/global_nav.php'; ?>

    <br><br>
    <div class="pageName">
        <h3>HOME</h3>
    </div>
    <br>
    <div class="container-widgets">
        <!-- KPI Widgets Row -->
        <div class="widget-row">
            <div class="widget kpi-widget">
                <div class="widget-header">
                    <h3>Baptism</h3>
                </div>
                <div class="widget-content">
                    <div class="kpi-value"><?php echo $baptismCount; ?> </div>

                </div>

            </div>
            <div class="widget kpi-widget">
                <div class="widget-header">
                    <h3>Communion</h3>
                </div>
                <div class="widget-content">
                    <div class="kpi-value"><?php echo $communionCount; ?> </div>
                </div>
            </div>
            <div class="widget kpi-widget">
                <div class="widget-header">
                    <h3>Confirmation</h3>
                </div>
                <div class="widget-content">
                    <div class="kpi-value"><?php echo $confirmationCount; ?> </div>
                </div>
            </div>
            <div class="widget kpi-widget">
                <div class="widget-header">
                    <h3>Burial</h3>
                </div>
                <div class="widget-content">
                    <div class="kpi-value"><?php echo $burialCount; ?> </div>
                </div>
            </div>
        </div>



    </div>
    <!--  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <script src="superDashboard.js"></script> -->
    <script src="scripts.js"></script>

</body>

</html>