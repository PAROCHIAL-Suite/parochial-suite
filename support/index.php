<?php
include '../config/connection.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['add_priest'])) {
    // code...
    $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
    $designation = mysqli_real_escape_string($conn, $_REQUEST['designation']);
    $start_date = $_REQUEST['start_date'];

    $end_date = $_REQUEST['end_date'];

    $sql = "INSERT INTO priest (ID, stationID, name, designation, start_date, end_date) 
	        VALUES ('', '$STATION_CODE', '$name', '$designation', '$start_date', '$end_date')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('A name had been added successfully!');</script>";
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }

}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <link rel="stylesheet" type="text/css" href="print.css">
    <title></title>
</head>

<body>
    <?php include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>ADD A PRIEST</h3>
    </div>
    <br>

    <!-- form to raise a new ticket -->
    <form id="raiseTicketForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-section">
            <div class="form-section-header">
                <h3>Raise a Ticket</h3>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="" hidden>Select</option>
                        <option>Technical</option>
                        <option>Billing</option>
                        <option>General</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
            </div>
        </div>
        <div class="form-header">
            <div class="form-actions">
                <button type="submit" class="btn-primary" name="raise_ticket">
                    <i class="fas fa-save"></i> Submit
                </button>
                <button class="btn-secondary" onclick="location.reload(); return false;">
                    <i class="fas fa-times"></i> Reset
                </button>
            </div>
        </div>
        <br><br>
    </form>

    <?php
    // Generate a unique alphanumeric ticket ID
    function generateTicketID($length = 6)
    {
        $characters = '0123456789';
        $ticket_id = '';
        for ($i = 0; $i < $length; $i++) {
            $ticket_id .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return 'PS-' . $ticket_id;
    }
    // Handle ticket submission
    if (isset($_POST['raise_ticket'])) {
        // Assuming user details are stored in session
    
        $user_id = isset($_COOKIE['userID']) ? $_COOKIE['userID'] : null;
        $user_name = isset($_COOKIE['username']) ? $_COOKIE['username'] : 'Unknown';
        $station_code = isset($_COOKIE['user']) ? $_COOKIE['user'] : null;

        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $status = 'Open';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $ticket_id = generateTicketID(6);

        if ($user_id) {
            // Duplicate check: all fields must match
            $dup_sql = "SELECT * FROM ps_internal_sys.support_tickets 
                WHERE user_id = '$user_id'
                AND user_name = '$user_name'
                AND subject = '$subject'
                AND category = '$category'
                AND description = '$description'
                AND status = '$status'
                AND date = '$date'
                AND time = '$time'
                LIMIT 1";
            $dup_result = $conn->query($dup_sql);

            if ($dup_result && $dup_result->num_rows > 0) {
                echo "<script>alert('This ticket already exists. Duplicate entry not allowed.');</script>";
            } else {
                $sql = "INSERT INTO ps_internal_sys.support_tickets (ticket_id, user_id, user_name, subject, category, description, status, date, time)
                        VALUES ('$ticket_id', '$user_id', '$user_name', '$subject', '$category', '$description', '$status', '$date', '$time')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Ticket raised successfully!');</script>";
                } else {
                    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
                }
            }
        } else {
            echo "<script>alert('User not logged in. Please log in to raise a ticket.');</script>";
        }
    }
    ?>

    <!-- Display 10 priests -->
    <div class="container-widgets">
        <!-- Recent Priests -->

        <!-- Raised Tickets -->
        <div class="widget-row">
            <div class="widget table-widget" style="max-height: 55%;">
                <div class="widget-header">
                    <h3>Recently Raised Tickets</h3>
                </div>
                <div class="widget-content">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
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
                            $user_id = isset($_COOKIE['userID']) ? $_COOKIE['userID'] : null;
                            $sql = "SELECT ticket_id, subject, category, description, status, date, time FROM ps_internal_sys.support_tickets";
                            if ($user_id) {
                                $sql .= " WHERE user_id = '$user_id'";
                            }
                            $sql .= " ORDER BY date DESC, time DESC LIMIT 10";
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
</body>

</html>