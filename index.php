<?php

$servername = "localhost";
$database = "parochial_cloud";
$username = "root";

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
if ($conn->connect_error) {
    echo "\'<h2>Running Status :<b> Active</b></h2>";
    die("Connection failed. " . $conn->connect_error);
}

// Check connection
if (!$conn) {
    die("Unable to connect: " . mysqli_connect_error());
}

// ...existing code...
$login_error = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT COUNT(*) as cnt FROM users WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $users_Exist = $row['cnt'];

    if ($users_Exist == 1) {
        $sql = "SELECT * FROM users WHERE email = '$username'";
        $result = $conn->query($sql);

        while ($rows = $result->fetch_assoc()) {
            @$id = $rows['ID'];
            @$role = $rows['role'];
            @$url = $rows['url'];
            @$email = $rows['email'];
            @$p = $rows['password'];
            @$stationCode = $rows['stationCode'];
            @$parishID = $rows['parishID'];
            @$login_Status = $rows['login_status'];
        }

        $cookie_name = "user";
        $cookie_value = @$stationCode;
        setcookie($cookie_name, $cookie_value, time() + 86400);

        $cookie_name = "username";
        $cookie_value = @$email;
        setcookie($cookie_name, $cookie_value, time() + 86400);

        $cookie_name = "userID";
        $cookie_value = @$id;
        setcookie($cookie_name, $cookie_value, time() + 86400);

        if (@$role == "Administrator") {
            header("Location: admin/default.php?ref=$id");
        } else if (@$role == 'Superuser') {
            header("Location: ./superuser/default.php?ref=$id&page=");
        } else {
            $login_error = "User does not exist.";
        }
    } else {
        $login_error = "Invalid username or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Parochial Suite</title>
    <link href="https://fonts.googleapis.com/css?family=Segoe+UI:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        :root {
            --primary: rgb(56, 80, 131);
            --primary-dark: #1741a6;
            --primary-light: #e8f0fe;
            --bg-gradient: linear-gradient(135deg, rgba(19, 50, 113, 0.82) 0%, rgba(19, 63, 133, 0.78) 100%);
            --bg-card: #fff;
            --border: #e0e0e0;
            --text-main: #1a202c;
            --text-muted: #6b7280;
            --shadow: 0 8px 32px rgba(37, 99, 235, 0.13), 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-glass {
            background: rgba(240, 239, 243, 0.97);
            border-radius: 10px;
            box-shadow: var(--shadow);
            max-width: 410px;
            width: 100%;
            padding: 48px 38px 32px 38px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1.5px solid rgba(37, 99, 235, 0.08);
            backdrop-filter: blur(2.5px);
        }

        .login-glass .logo {
            width: 100%;
            height: 150px;

            margin-bottom: 18px;

            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-glass .logo img {
            width: 100%;
            height: 80px;
            object-fit: contain;
        }



        .login-form {
            width: 100%;
        }

        .login-form h2 {
            font-size: 26px;
            margin-bottom: 24px;
            color: var(--primary-dark);
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: var(--text-main);
            font-size: 1rem;
            letter-spacing: 0.2px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid var(--border);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1.08rem;
            background: #f8fafc;
            color: var(--text-main);
            transition: border 0.2s, box-shadow 0.2s;
            height: 55px;
        }

        .form-group input:focus {
            border: 1.5px solid var(--primary);
            outline: none;
            background: #fff;
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .login-button {
            width: 100%;
            padding: 13px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 1.08rem;
            font-weight: 600;
            margin-top: 8px;
            transition: background 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.07);
        }

        .login-button:hover,
        .login-button:focus {
            background: var(--primary-dark);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.12);
        }

        .forgot-password {
            text-align: left;

            margin-bottom: 8px;
            margin-top: 50px;
        }

        .forgot-password a {
            color: var(--primary-dark);
            text-decoration: none;
            font-size: 0.98rem;
            transition: color 0.15s;

        }

        .forgot-password a:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        .login-footer {
            text-align: center;
            margin-top: 32px;
            color: var(--text-muted);
            font-size: 0.97rem;
            letter-spacing: 0.2px;
        }

        .login-footer span {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .login-error {
            background: #ffeaea;
            color: #b71c1c;
            border: 1px solid #f5c6cb;
            padding: 10px 16px;
            border-radius: 6px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: 500;
            font-size: 1rem;
        }

        .login-glass .powered {
            margin-top: 24px;
            color: var(--primary-dark);
            font-size: 1.01rem;
            font-weight: 500;
            letter-spacing: 0.1px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-glass .powered i {
            margin-right: 7px;
            color: var(--primary);
        }

        @media (max-width: 600px) {
            .login-glass {
                padding: 18px 4vw 18px 4vw;
                max-width: 98vw;
            }
        }
    </style>
</head>

<body>
    <div class="login-glass">
        <div class="logo">
            <img src="./res/ngp_logo_big.png" alt="Parochial Suite Logo">
        </div>

        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="on">
            <h2>
                Login
            </h2>
            <?php if (!empty($login_error)): ?>
                <div class="login-error">
                    <?php echo htmlspecialchars($login_error); ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Enter your username" required
                    autocomplete="username">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Enter your password" required
                    autocomplete="current-password">
            </div>
            <button type="submit" class="login-button" name="login">
                Login
            </button>
            <!-- <div class="forgot-password">
                <a href="#"><i class="fa-solid fa-key"></i> Forgot password?</a>
            </div> -->
        </form>
        <div class="powered">
            <i class="fa-solid fa-shield-halved"></i>
            Enterprise Security &amp; Reliability
        </div>
    </div>
    <!-- <div class="login-footer">
        &copy; <?php //cho date('Y'); ?> <span>Parochial Suite</span> &mdash; All rights reserved.
    </div> -->
</body>

</html>