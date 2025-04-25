<?php
    $conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
    if ($conn->connect_error) {
        echo "\'<h2>Running Status :<b> Active</b></h2>";
        die("Connection failed. " . $conn->connect_error);
    }

    echo $_GET['stCode'];

    if (isset($_POST['reg_new_company'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id = $_POST['userId'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $password = $_POST['password'];
        $station_code = $_POST['station_code'];
        $date = date("d-m-Y");

        $sql = "INSERT INTO users values('$id', 'Demo Account', '$station_code', '$name', '$email', '$city', '$state', 'Adminstrator','$password', '$date', '../admin/?ref=', 'Logged Out') ";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('You have been sucessfully registered');</script>"; 
            header("Location: parish_header_reg.php")           
        }
        else{
            echo "Unable to register" . mysqli_error($conn);
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/ui.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css">

    <title>Registration Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[readonly] {
            background-color: #f5f5f5;
        }

        button:hover {
            background-color: #45a049 !important;
        }
    </style>
</head>
<body>
        <nav class="nav" style="padding:20px; font-weight: 500; font-size: 32px;">
            <p style="font-size: 22px;">Parochial Suite</p>
        </nav>
        <br><br><br>

    <h1>Registration Form</h1>
    <hr><br>
    <form id="registrationForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login-box">
        <div class="form-group">
            <!-- <label hidden for="userId">User ID:</label> -->
            <input type="text" id="userId" name="userId" readonly hidden>
        </div>
        
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
        </div>
        
        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>
        </div>

        <div class="form-group">
            <label for="station_code">Station Code:</label>
            <input type="text" id="station_code" name="station_code" readonly>
            <!-- <small>Random 3-letter code</small> -->
        </div>        


        <div class="form-group">
            <label for="password">Create a new password</label>
            <input type="password" id="password" name="password" required>
            <!-- <small>Random 3-letter code</small> -->
        </div>             
        
        <input type="submit" name="reg_new_company" value="Register">
    </form>
        <br> <hr style="color: lightgrey;"><br>
        <div style="background: whitesmoke; padding: 10px;">
            <center >
                <h3>
                    Already a member...
                </h3><br>
                <a href="index.php"><button class="">Login</button></a>
            </center>  

        </div>

</body>
</html>