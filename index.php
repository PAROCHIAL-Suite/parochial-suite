<?php
        
        $conn = mysqli_connect('localhost', 'root', '', 'parochial_cloud');
    if ($conn->connect_error) {
        echo "\'<h2>Running Status :<b> Active</b></h2>";
        die("Connection failed. " . $conn->connect_error);
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
        
            while ($rows=$result->fetch_assoc()){ 
                $id = $rows['ID'];
                $role = $rows['role'];
                $url = $rows['url'];            
                echo $email = $rows['email'];           
                echo  "<br>" . $p = $rows['password'];            
                $stationCode = $rows['stationCode'];
                $parishID = $rows['parishID'];    
                $login_Status = $rows['login_status'];
            }

            $cookie_name = "user";
            $cookie_value = $stationCode;
            setcookie($cookie_name, $cookie_value,  time() + 86400); // 86400 = 1 day   

            $cookie_name = "username";
            $cookie_value = $email;
            setcookie($cookie_name, $cookie_value,  time() + 86400); // 86400 = 1 day       

            if(!isset($_COOKIE['user'])) {
               echo "Cookie named '" . $cookie_name . "' is not set!";            
            }
            else{
                if ($role == 'Adminstrator') {       
                  header("Location: ./admin/?ref=$id");
                }else{
                    echo "<script>alert('User does not exist')</script>";
                }

            }

        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/ui.css">
    <title>parochialCloud | Login</title>
    <style type="text/css">
        .login-box{
            border: none;
            width: 25%;
            height: 600px;
            padding: 0px;
            margin: auto;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border: 2px solid lightgrey;
            margin-top: 10px;
            background-color: white;
        }
        .login-box #loginTbl{
            margin: auto;
            
        
        }
        .login-box label{
            font-size: 16px;
            color: black;
            letter-spacing: 1px;
            margin-top: 30px;
        }
        .login-box input[type="submit"]{
            margin-top: 30px;

        }
        .login-box input[type="text"], .login-box input[type="password"]{
            width: 90%;
            font-size: 17px;
            padding: 10px;
            border-radius:5px;
            
        }
        nav{
            padding: 16px;
        }
        #loginTbl input[type="submit"]{
            background-color: var(--txtblue);
            padding: 2px;
            height: 38px;
            width: 140px;
            font-size: 19px;
            font-weight: 400;
            letter-spacing: 1px;
        }
        footer{
            bottom: 0;
            position: fixed;
            background-color: whitesmoke;
            width: 100%;
            margin: auto;
            font-size: 20px;
            font-weight: 350;
            color: var(--txtblue);
            padding: 10px;
            height: 70px;
        }
        footer label{
            font-size: 15px;
        }
        footer p{
            font-size: 27px;
        }
    </style>
</head>
<body>    
    <br><br>
    <div class="login-box">
        <nav class="nav" style="padding:20px; font-weight: 500; font-size: 32px;">
            <p style="font-size: 22px;">Parochial Suite</p>
        </nav>
        <br>
        <!-- <center><h3>Archdiocese of Nagpur</h3></center> -->
        <br>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2 style="color: var(--txtblue); text-align: center;">&nbsp;&nbsp;Log In</h2>
            <br><br>
            <table width="70%" id="loginTbl" border="0">
                <tr>
                    <td><label for="username">USERNAME</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="username" style="width: 300px;" required></td>
                </tr>
                <tr></tr><tr></tr>
                <tr>
                    <td><label for="username">PASSWORD</label></td>
                </tr>
                <tr>
                    <td><input type="password" id="myInput" name="password" style="width: 300px;" required></td>
                </tr>
                <tr>
                    <td><input type="checkbox" onclick="myFunction()"> Show Password    
                </td>
                </tr>
                <tr></tr>
                <tr>
                    <td> <input type="submit" name="login" value="Login" class="loginBtn"> </td>
                </tr>
            </table>
        </form>
    <br><br><hr style="color: lightgrey;"><br>
    <div style="text-align: center;">
        <a href="">Forget Password?</a>
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