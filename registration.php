<?php
    $conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
    if ($conn->connect_error) {
        echo "\'<h2>Running Status :<b> Active</b></h2>";
        die("Connection failed. " . $conn->connect_error);
    }

    if (isset($_POST['reg_new_company'])) {
        $name =  mysqli_real_escape_string($conn,$_POST['name']);
        $email = $_POST['email'];
        $id = $_POST['userId'];
        $state = $_POST['state'];
        $city =  $_POST['city'];
        $password = $_POST['password'];
        $station_code = $_POST['station_code'];
        $date = date("d-m-Y");

        $sql1 = "INSERT INTO users values('$id', 'Demo Account', '$station_code', '$name', '$email', '$city', '$state', 'Adminstrator','$password', '$date', '../admin/?ref=', 'Logged Out') ";

        if (mysqli_query($conn, $sql1)) {
             // echo "<script>alert('You have been sucessfully registered');</script>";     
        }
        else{
            echo "Unable to register" . mysqli_error($conn);
        }        

        $parish_name =  mysqli_real_escape_string($conn,$_POST['parish_name']);
        $parish_add =  mysqli_real_escape_string($conn,$_POST['parish_add']);
        $diocese_name =  mysqli_real_escape_string($conn,$_POST['diocese_name']);
        // echo $parish_logo $_FILES["parish_logo"]["name"];

        $sql2 = "INSERT INTO parish_info VALUES('','$station_code', '$parish_name', '$diocese_name', '$parish_add', '')";

        if (mysqli_query($conn, $sql2)) {
            echo "<script>alert('You have been sucessfully registered');</script>"; 
            header("Location: index.php");
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
            max-width: 900px;
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
            <a href="index.php"><button class="" style="float: right;">Login</button></a> 
            <p style="font-size: 26px;">Welcome to Parochial Suite</p>
            <p style="font-size: 15px;">A bundle pack to manage your parish at one place.</p>
                
        </nav>
        <br><br><br>

 <medium style="color: var(--txtblue);"><B>SETUP REPORTING HEADER</B></medium>
    <hr><br>
    <form id="registrationForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login-box" enctype="multipart/form-data">
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
            <label for="password">Create a new password</label>
            <input type="password" id="password" name="password" required>
            <br><Br>
            <small><input type="checkbox" onclick="myFunction()"> Show Password   </small>
        </div>  
        <br>
        <medium style="color: var(--txtblue);"><B>SETUP REPORTING HEADER</B></medium><hr>
        <br>
        <div class="form-group">
            <label for="parish_name">Name of the parish</label>
            <input type="text" id="parish_name" name="parish_name" required>
            <!-- <small>Random 3-letter code</small> -->
        </div>                         

        <div class="form-group">
            <label for="station_code">Station Code:</label>
            <input type="text" id="station_code" name="station_code" readonly>
            <small>This is an auto-generated field</small>
        </div>        

        <div class="form-group">
            <label for="praish_add">Address of the parish</label>
            <input type="text" id="praish_add" name="parish_add" required>
            <!-- <small>Random 3-letter code</small> -->
        </div>     
        <div class="form-group">
            <label for="diocese_name">Name of the diocese</label>
            <input type="text" id="diocese_name" name="diocese_name" required>
            <!-- <small>Random 3-letter code</small> -->
        </div>

        <br><br>                                                           
        <input type="submit" name="reg_new_company" value="Register your parish" style="padding-left: 10px; padding-right: 10px;">
    </form>
        <br><br><br><br> <hr style="color: lightgrey;"><br>
        <div >


        </div>
    <script>
        // Generate IDs when page loads
        document.addEventListener('DOMContentLoaded', function() {
            generateUserId();
            generateStationCode();
        });

        // Function to generate 16-character alphanumeric ID
        function generateUserId() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let userId = '';
            
            for (let i = 0; i < 75; i++) {
                const randomIndex = Math.floor(Math.random() * chars.length);
                userId += chars[randomIndex];
            }
            
            document.getElementById('userId').value = userId;
        }

        // Function to generate random 3 letters (uppercase)
        function generateStationCode() {
            const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let stationCode = '';
            
            for (let i = 0; i < 3; i++) {
                stationCode += letters.charAt(Math.floor(Math.random() * letters.length));
            }
            
            document.getElementById('station_code').value = stationCode;
        }

        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>       
</body>
</html>