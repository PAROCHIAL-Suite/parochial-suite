<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body oncontextmenu="return false;">
    <?php

    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>ACCOUNT CENTER</h3>
    </div>
    <div class="ps-flex-layout max-height">
        <div class="ps-left-panel">
            <h4>Profile</h4>
            <br>
            <ul>
                <li>
                    <a href="user_profile.php" class="btn-link" target="accountFrame">
                        <i class="fas fa-user"></i> User Profile
                    </a>
                </li>
                <li>
                    <a href="change_pass.php" class="btn-link" target="accountFrame">
                        <i class="fas fa-key"></i> Change Password
                    </a>
                </li>
            </ul>
            <br>
            <h4 hidden>User Control</h4>
            <br>
            <ul hidden>
                <li>
                    <a href="create_user.php" class="btn-link" target="accountFrame">
                        <i class="fas fa-user-plus"></i> Create Users
                    </a>
                </li>
                <li>
                    <a href="user_list.php" class="btn-link" target="accountFrame">
                        <i class="fas fa-users"></i> List of Users
                    </a>
                </li>

            </ul>
        </div>
        <div class="ps-content-area">
            <iframe class="ps-iframe" name="accountFrame" src="user_profile.php" width="100%" height="100%"
                style="border: none ;min-height:500px;"></iframe>
        </div>
    </div>

</body>

</html>