<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <title>Report - Baptism</title>
</head>

<body>
    <?php include '../config/connection.php'; ?>
    <div class="pageName">
        <h3>PRIEST RECORDS</h3>
    </div>
    <br>

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
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>PRIVILEGE</th>
                                <th>CREATED ON</th>
                                <th>LAST UPDATED</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM users WHERE stationCode = '$STATION_CODE' ";
                            $result = $conn->query($sql);
                            while ($rows = $result->fetch_assoc()) {
                                $id = $rows['ID'];
                                ?>
                                        <tr>
                                            <td><a href="edit_users.php?id=<?php echo $rows['ID']; ?>">Edit</a></td>
                                            <td><?php echo $rows['Name']; ?></td>
                                            <td><?php echo $rows['email']; ?></td>
                                            <td><?php echo $rows['role']; ?></td>
                                            <td><?php echo $rows['privileges']; ?></td>
                                            <td><?php echo $rows['created_on']; ?></td>
                                            <td><?php echo $rows['updated_on']; ?></td>
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