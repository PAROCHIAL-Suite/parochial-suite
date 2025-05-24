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
            echo @$role = $rows['role'];
            @$url = $rows['url'];
            echo "<br>" . @$email = $rows['email'];
            echo "<br>" . @$p = $rows['password'];
            @$stationCode = $rows['stationCode'];
            @$parishID = $rows['parishID'];
            @$login_Status = $rows['login_status'];
        }

        $cookie_name = "user";
        $cookie_value = @$stationCode;
        setcookie($cookie_name, $cookie_value, time() + 86400);         // 86400 = 1 day   

        $cookie_name = "username";
        $cookie_value = @$email;
        setcookie($cookie_name, $cookie_value, time() + 86400);         // 86400 = 1 day     

        $cookie_name = "userID";
        $cookie_value = @$id;
        setcookie($cookie_name, $cookie_value, time() + 86400);         // 86400 = 1 day    

        if (@$role == "Administrator") {
            header("Location: admin/default.php?ref=$id");
        } else if (@$role == 'Superuser') {
            header("Location: ./superuser/default.php?ref=$id&page=");
        } else {
            echo "<script>alert('User does not exist')</script>";
        }

    } else {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Parochial Suite</title>
    <style>
        :root {
            --primary: #2a7ae2;
            --primary-dark: #1a5ca0;
            --bg-light: #f5f7fa;
            --bg-card: #fff;
            --border: #e0e0e0;
            --text-main: #2a3b4d;
            --text-muted: #888;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            flex-direction: row;
            background: var(--bg-card);
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(42, 122, 226, 0.07), 0 1.5px 6px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            min-height: 480px;
        }

        .login-left {
            background: linear-gradient(120deg, #e3f0ff 70%, #f5f7fa 100%);
            flex: 1.1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            text-align: center;
        }

        .login-left img {
            max-width: 500px;
            width: 100%;
            height: auto;
            margin: 0 auto 24px auto;
            display: block;
            /* border-radius: 16px; */
            /* box-shadow: 0 2px 18px rgba(42, 122, 226, 0.12); */
        }

        .login-left h2 {
            color: var(--primary-dark);
            font-size: 1.5rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .login-right {
            flex: 1.3;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-card);
            padding: 40px 32px;
        }

        .login-form {
            width: 100%;
            max-width: 340px;
            background: var(--bg-card);
            border-radius: 12px;
            box-shadow: none;
            padding: 0;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 28px;
            color: var(--primary-dark);
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 500;
            color: var(--text-main);
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
            background: #f8fafc;
            color: var(--text-main);
            transition: border 0.2s;
        }

        .form-group input:focus {
            border: 1.5px solid var(--primary);
            outline: none;
            background: #fff;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.08rem;
            font-weight: 600;
            margin-top: 8px;
            transition: background 0.18s;
            box-shadow: 0 2px 8px rgba(42, 122, 226, 0.07);
        }

        .login-button:hover {
            background: var(--primary-dark);
        }

        .forgot-password {
            text-align: center;
            margin-top: 16px;
        }

        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.97rem;
            transition: color 0.15s;
        }

        .forgot-password a:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                min-height: unset;
                max-width: 98vw;
            }

            .login-left,
            .login-right {
                flex: unset;
                width: 100%;
                padding: 32px 12px;
            }

            .login-left {
                border-radius: 18px 18px 0 0;
            }

            .login-right {
                border-radius: 0 0 18px 18px;
            }
        }

        @media (max-width: 600px) {
            .login-form {
                max-width: 98vw;
                padding: 0;
            }

            .login-left,
            .login-right {
                padding: 18px 4vw;
            }

            .login-left img {
                max-width: 180px;
                margin: 0 auto 16px auto;
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <img src="./res/ngp_logo_big.png" alt="Company Logo">
        </div>
        <div class="login-right">
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="on">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required
                        autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                        autocomplete="current-password">
                </div>
                <button type="submit" class="login-button" name="login">Login</button>
                <div class="forgot-password">
                    <a href="#">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>