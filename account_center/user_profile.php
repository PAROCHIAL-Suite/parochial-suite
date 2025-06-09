<?php


include '../config/connection.php';

// Get current user ID from cookie/session
$user_id = $_COOKIE['userID'] ?? null;
$user = null;


if ($user_id) {
    $sql = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .profile-card {
            background: #fff;
            box-shadow: 0 4px 24px rgba(42, 122, 226, 0.07), 0 1.5px 6px rgba(0, 0, 0, 0.03);
            max-width: 95%;
            margin: 40px auto 0 auto;
            padding: 32px 32px 24px 32px;
            text-align: left;
            position: relative;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 10%;
            background: radial-gradient(circle at 50% 50%, rgba(42, 122, 226, 0.2) 0%, rgba(42, 122, 226, 0.1) 100%);
            /* background: linear-gradient(120deg, rgb(48, 48, 48) 30%, rgb(12, 94, 217) 100%); */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 20px 28px auto;
            font-size: 2.8em;
            color: #2a7ae2;
            border: 4px solid #fff;
            box-shadow: 0 2px 8px rgba(42, 122, 226, 0.08);
            float: left;
        }

        .profile-name {
            font-size: 1.5em;
            font-weight: 600;
            color: #2a3b4d;
            margin-bottom: 6px;
            margin-left: 30px;
            margin-top: 20px;
        }

        .profile-role {
            font-size: 1em;
            color: #2a7ae2;
            font-weight: 500;
            margin-bottom: 18px;

        }

        .profile-info-list {
            float: left;

        }

        .profile-info-list li {
            margin-bottom: 12px;
            font-size: 1.05em;
            color: #2a3b4d;
            display: flex;
            align-items: center;
        }

        .profile-info-list i {
            color: rgb(59, 101, 156);
            margin-right: 12px;
            min-width: 22px;
            text-align: center;
        }

        .profile-date {
            font-size: 0.98em;
            color: #888;
            margin-top: 20px;
            margin-left: 113px;
        }

        .profile-actions {
            margin-top: 20px;
        }

        .profile-actions a {
            margin: 0 8px;
            text-decoration: none;
            color: #fff;
            background: #2a7ae2;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 1em;
            transition: background 0.2s;
            display: inline-block;
        }

        .profile-actions a:hover {
            background: #1a5ca0;
        }
    </style>
</head>

<body>
    <div class="pageName" style="text-align:left;">
        <h3>User Profile</h3>
    </div>
    <div class="profile-card">
        <?php if ($user): ?>
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-name"><?php echo htmlspecialchars($user['Name']); ?></div>
            <div class="profile-role">
                <i class="fas fa-user-tag"></i>
                <?php echo ucfirst(htmlspecialchars($user['role'])); ?>
            </div>


            <hr>
            <br>
            <ul class="profile-info-list">
                <li><i class="fas fa-church"></i> <?php echo htmlspecialchars($user['stationCode']); ?></li>
                <li><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></li>
                <li><i class="fas fa-user-shield"></i> Privileges: <?php echo htmlspecialchars($user['privileges']); ?></li>
            </ul>
            <br><br><br><br>
            <div class="profile-date" style="margin-top: 150px;">
                <i class="fas fa-calendar-alt"></i>
                Joined: <?php echo date('d M Y, h:i A', strtotime($user['created_on'])); ?>
            </div>
            <div class="profile-date">
                <i class="fas fa-calendar-alt"></i>
                Last updated:
                <?php
                if (!empty($user['updated_on']) && $user['updated_on'] !== '0000-00-00 00:00:00') {
                    echo date('d M Y', strtotime($user['updated_on']));
                } else {
                    echo 'Never';
                }
                ?>
            </div>

        <?php else: ?>
            <div class="ps-note warning">User not found or not logged in.</div>
        <?php endif; ?>
    </div>
</body>

</html>