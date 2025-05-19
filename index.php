<?php

$servername = "localhost";
$database = "u381709061_parochial_db";
$username = "u381709061_Ecclesiastical";

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
if ($conn->connect_error) {
    echo "\'<h2>Running Status :<b> Active</b></h2>";
    die("Connection failed. " . $conn->connect_error);
}
// $conn = mysqli_connect($servername, $username, '/vV+q6=C', $database);

// Check connection

if (!$conn) {
    die("Unable to connect: " . mysqli_connect_error());
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT COUNT(*) FROM users WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $users_Exist = mysqli_num_rows($result);


    if ($users_Exist == 1) {
        //  echo "The user is valid.";
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
        setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day   

        $cookie_name = "username";
        $cookie_value = @$email;
        setcookie($cookie_name, $cookie_value, time() + 86400); // 86400 = 1 day       


        if (@$role == 'Adminstrator') {
            header("Location: ./admin/default.php?ref=$id");
        } else if (@$role == 'Superuser') {
            header("Location: ./superuser/default.php?ref=$id");
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
    <!-- <link rel="stylesheet" type="text/css" href="../css/nav.css"> -->
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .partition {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-partition {
            background-color: #ffffff;
        }

        .right-partition {
            background-color: #e9e9e9;
        }

        .logo {
            max-width: 300px;
            max-height: 300px;
        }


        .login-form {
            width: 500px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 18px;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-button:hover {
            background-color: #45a049;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="partition left-partition">
        <!-- Logo Section -->
        <div class="logo-container">
            <img src="./res/nagpur_logo.jpg" alt="Company Logo" class="logo"><br>
            <center>
                <h2>Archdiocese of Nagpur</h2>
            </center>
        </div>
    </div>

    <div class="partition right-partition">
        <!-- Login Form -->
        <div class="login-form">
            <h2>Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-button" name="login">Login</button>
                <div class="forgot-password">
                    <a href="#">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>