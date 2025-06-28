<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <title>Report - Baptism</title>
</head>

<body>
    <?php @include '../nav/app_header_nav.php';
    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>PRIEST RECORDS</h3>
    </div>
    <br>
    <?php include '../simpleSearchBox.php'; ?>

    <!-- Disply 10 priest -->
    <div class="container-widgets">
        <!-- Recent Transactions -->
        <div class="widget-row">
            <div class="widget table-widget" style="max-height: 80%;">
                <div class="widget-content">
                    <table class="data-table" id="table">
                        <thead>
                            <tr>
                                <th>ACTIONS</th>
                                <th onclick="sortTable(2);">NAME</th>
                                <th>DESIGNATION</th>
                                <th>START DATE</th>
                                <th>END DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM priest WHERE stationID = '$STATION_CODE' ORDER BY start_date DESC";
                            $result = $conn->query($sql);
                            while ($rows = $result->fetch_assoc()) {
                                $id = $rows['ID'];
                                ?>
                                <tr>
                                    <td><a href="edit_priest.php?id=<?php echo $rows['ID']; ?>">Edit</a></td>
                                    <td><?php echo $rows['name']; ?></td>
                                    <td><?php echo $rows['designation']; ?></td>
                                    <td><?php echo $rows['start_date']; ?></td>
                                    <td><?php echo $rows['end_date']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/export.js"></script>
    <script src="../js/search_script.js"></script>




</body>

</html>