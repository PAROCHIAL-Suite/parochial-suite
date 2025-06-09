<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket History</title>
    <link rel="stylesheet" href="../css/parochialUI.css">
    <script src="print.js"></script>
</head>

<body>
    <?php

    include '../nav/global_nav.php';

    include '../config/connection.php';
    $user_id = isset($_COOKIE['userID']) ? $_COOKIE['userID'] : null;
    $station_code = isset($_COOKIE['user']) ? $_COOKIE['user'] : null;
    ?>


    <br><br>
    <div class="pageName">
        <h3>Ticket History</h3>
    </div>
    <br>

    <div class="container-widgets " style="margin-bottom: 55px;">
        <div class="widget-row ">
            <div class="widget table-widget ">
                <div class="widget-header "
                    style="background-color:rgba(231, 236, 249, 0.48); border:none !important; ">
                    <div class="search-actions ">
                        <label for="statusFilter">Status:</label>
                        <select id="statusFilter" class="btn btn-secondary-exp">
                            <option value="">All</option>
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                            <option value="Pending">Pending</option>
                            <!-- Add more statuses as needed -->
                        </select>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const statusFilter = document.getElementById('statusFilter');
                                const table = document.querySelector('.data-table');
                                statusFilter.addEventListener('change', function () {
                                    const filterValue = this.value.toLowerCase();
                                    const rows = table.querySelectorAll('tbody tr');
                                    rows.forEach(row => {
                                        const statusCell = row.cells[3];
                                        if (!filterValue || (statusCell && statusCell.textContent.toLowerCase() === filterValue)) {
                                            row.style.display = '';
                                        } else {
                                            row.style.display = 'none';
                                        }
                                    });
                                });
                            });
                        </script>

                        <button class="btn btn-secondary-exp " id="exportBtn" onclick="location.reload()">
                            <i class="fa fa-refresh refresh reload"></i>
                        </button>
                    </div>
                    <div class="search-actions">

                    </div>


                    <div class="search-actions" style="float: left;">

                        <input type="text" id="searchbox" name="searchbox" class="search-input"
                            placeholder="Type here to search" style="min-width: 400px;">
                        <i class="fa-solid fa-magnifying-glass"></i>

                    </div>
                    <p>Total Records: <span id="rowCount">0</span></p>
                </div>
            </div>
        </div>
    </div>





    <div class="container-widgets">
        <!-- Raised Tickets -->
        <div class="widget-row">
            <div class="widget table-widget" style="max-height: 55%;">

                <div class="widget-content">
                    <table class="data-table" id="table">
                        <thead>
                            <tr>
                                <th>TICKET ID</th>
                                <th>SUBJECT</th>
                                <th>CATEGORY</th>
                                <th>DESCRIPTION</th>
                                <th>STATUS</th>
                                <th>DATE</th>
                                <th>TIME</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Show tickets for this user and this station code
                            $sql = "SELECT ticket_id, subject, category, description, status, date, time 
                                FROM ps_internal_sys.support_tickets 
                                WHERE user_id = '$user_id'
                                ORDER BY date DESC, time DESC LIMIT 20";
                            $result = $conn->query($sql);
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['ticket_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['time']); ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="6">No tickets found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>

        const pageTitle = document.title;
        // Function to count rows in the table (excluding the header)
        function updateRowCount() {
            const table = document.getElementById('table');
            const rowCount = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
            document.getElementById('rowCount').textContent = rowCount;
        }

        // Update row count on page load
        window.addEventListener('DOMContentLoaded', updateRowCount);
    </script>

</body>

</html>