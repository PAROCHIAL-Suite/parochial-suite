<?php
include '../config/connection.php';

$userId = $_COOKIE['userID'];
$userData = null;
if ($userId) {
    $query = "SELECT * FROM users WHERE ID = '$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        $userName = $userData['Name'] ?? '';
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

    <div class="pageName ps-content-heading">
        <h3>CHANGE PASSWORD</h3>
    </div>
    <br>
    <div class="ps-note">



        <p class="ps-note warning">You are changing password for the currently logged in user
            <b><?php echo $userName; ?><b></b>
        </p>


    </div>
    <br>

    <!-- form to add new priest -->
    <form id="addNewPriestForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"
        style="width: 50%;">
        <div class="form-section">
            <div class="form-section-header">
                <h3>Request Form</h3>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="Pries Name">New Password</label>
                    <input type="password" id="new_pass" name="new_password" required>
                </div>
            </div>
        </div>
        <div class="form-header">
            <div class="form-actions">
                <button type="submit" class="btn-primary" name="change_passcode">
                    <i class="fas fa-save"></i> Save
                </button>
                <button class="btn-secondary" onclick="location.reload()">
                    <i class="fas fa-times"></i> Reset
                </button>
            </div>
        </div>
        <br><br>
    </form>

    <div></div>

    <?php
    include '../config/connection.php';

    // Make sure the form is submitted and the username is set
    $username = $_COOKIE['userID'] ?? '';


    if (isset($_POST['change_passcode'])) {
        $new_pass = $_POST['new_password'];
        $update_time = date('Y-m-d H:i:s');

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE users SET password = ?, updated_on = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $new_pass, $update_time, $username);
        if ($stmt->execute()) {
            echo "<script>alert('Password updated successfully.');</script>";
            exit;
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }
        $stmt->close();
    } elseif (isset($_POST['change_passcode'])) {
        echo "<script>alert('No user found.');</script>";
    }
    ?>
</body>

</html>