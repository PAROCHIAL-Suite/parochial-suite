<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <title>Create User</title>
</head>

<body>
    <div class="pageName ps-content-heading">
        <h3>CREATE NEW USER</h3>
    </div>
    <br>
    <?php
    include '../config/connection.php';
    function generateRandomID($length = 22)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    $form_error_message = '';
    $form_success_message = '';

    if (isset($_POST['create_user'])) {
        $id = generateRandomID(22); // Generate 22-character alphanumeric ID
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = strtolower(trim($_POST['email']));
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $privileges = mysqli_real_escape_string($conn, $_POST['privileges']);
        $password = $_POST['password']; // Don't escape yet, validate first
        $created_on = date('Y-m-d H:i:s');
        $stationCode = isset($_COOKIE['user']) ? mysqli_real_escape_string($conn, $_COOKIE['user']) : '';

        // Password validation: min 8 chars, at least 1 number, 1 uppercase
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password)
        ) {
            $form_error_message = "Password must be at least 8 characters, contain a number and an uppercase letter.";
        } else {
            $password = mysqli_real_escape_string($conn, $password);
            // Check if email already exists
            $check_sql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
            $check_result = $conn->query($check_sql);
            if ($check_result && $check_result->num_rows > 0) {
                $form_error_message = "A user with this email already exists.";
            } else {
                // Insert new user with generated ID
                $insert_sql = "INSERT INTO users (id, stationCode, name, email, role, privileges, password, created_on) 
                           VALUES ('$id', '$stationCode', '$name', '$email', '$role', '$privileges', '$password', '$created_on')";
                if ($conn->query($insert_sql)) {
                    $form_success_message = "User created successfully.";
                } else {
                    $form_error_message = "Failed to create user. " . $conn->error;
                }
            }
        }
    }
    ?>

    <!-- Success Message -->
    <?php if (!empty($form_success_message)): ?>
        <div class="ps-note success" id="formSuccessDialog"
            style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px; background:#e6f9ea; color:#256029; border:1px solid #b2dfdb;">
            <?php echo $form_success_message; ?>
            <button type="button"
                style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#256029;"
                onclick="document.getElementById('formSuccessDialog').style.display='none';" title="Close">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if (!empty($form_error_message)): ?>
        <div class="ps-note warning" id="formErrorDialog"
            style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px;">
            <?php echo $form_error_message; ?>
            <button type="button"
                style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#b71c1c;"
                onclick="document.getElementById('formErrorDialog').style.display='none';" title="Close">&times;</button>
        </div>
    <?php endif; ?>

    <form id="createUserForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
        enctype="multipart/form-data" autocomplete="on">
        <div class="form-section">
            <div class="form-section-header">
                <h3>User Details</h3>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required autocomplete="username">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="administrator">Administrator</option>
                        <option value="superuser">Superuser</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="privileges">Privileges</label>
                    <input type="text" id="privileges" name="privileges" placeholder="e.g. view,edit,delete" required>
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password"
                        minlength="8" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$"
                        title="Password must be at least 8 characters, contain a number and an uppercase letter.">
                </div>
                <div class="form-group"></div>
            </div>
        </div>
        <div class="form-header">
            <div class="form-actions">
                <button type="submit" class="btn-primary" name="create_user">
                    Create
                </button>
                <button class="btn-secondary" type="button"
                    onclick="document.getElementById('createUserForm').reset();">
                    Reset
                </button>
            </div>
        </div>
        <br><br>
    </form>
</body>

</html>