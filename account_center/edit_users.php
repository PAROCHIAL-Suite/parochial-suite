<?php
// edit_users.php

// Database connection (update with your credentials)
include '../config/connection.php';


?>

<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/parochialUI.css">
</head>

<body>
    <div class="pui-container" style="">
        <!-- Top of the page -->
        <div class="pageName ps-content-heading">
            <h3>EDIT USER</h3>
        </div>
        <br>

        <!-- Success Message -->
        <?php if (!empty($success)): ?>
            <div class="ps-note success" id="formSuccessDialog"
                style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px; background:#e6f9ea; color:#256029; border:1px solid #b2dfdb;">
                <?php echo $success; ?>
                <button type="button"
                    style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#256029;"
                    onclick="document.getElementById('formSuccessDialog').style.display='none';"
                    title="Close">&times;</button>
            </div>
        <?php elseif (!empty($error)): ?>
            <div class="ps-note warning" id="formErrorDialog"
                style="margin-bottom:18px; position:relative; margin: 0px 20px 10px 20px;">
                <?php echo $error; ?>
                <button type="button"
                    style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:1.2em;cursor:pointer;color:#b71c1c;"
                    onclick="document.getElementById('formErrorDialog').style.display='none';"
                    title="Close">&times;</button>
            </div>
        <?php endif; ?>

        <form id="editUserForm" method="post" class="pui-form">
            <div class="form-section">
                <div class="form-section-header">
                    <h3>User Details</h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="username" class="pui-label">Username</label>
                        <input type="text" id="username" name="username" class="pui-input"
                            value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="pui-label">Email</label>
                        <input type="email" id="email" name="email" class="pui-input"
                            value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="role" class="pui-label">Role</label>
                        <select id="role" name="role" class="pui-select" required>
                            <option value="admin" <?php if ($role === 'admin')
                                echo 'selected'; ?>>Admin</option>
                            <option value="user" <?php if ($role === 'user')
                                echo 'selected'; ?>>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="privileges" class="pui-label">Privileges</label>
                        <input type="text" id="privileges" name="privileges"
                            value="<?php echo htmlspecialchars($user['privileges']); ?>" required>
                    </div>
                </div>
                <!-- Add more form-grids as needed for password or other fields -->
            </div>
            <div class="form-header">
                <div class="form-actions">
                    <button type="submit" class="btn-primary" name="update_user">
                        Update
                    </button>
                    <button class="btn-secondary" type="button"
                        onclick="document.getElementById('editUserForm').location.refresh();">
                        Reset
                    </button>
                </div>
            </div>
            <br><br>
        </form>
    </div>
</body>

</html>