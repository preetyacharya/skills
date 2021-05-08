<!DOCTYPE html>
<html>
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel = "stylesheet" type = "text/css" href = "this.css">   
</head>
<body>
<?php
    require('conn.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM  myproject WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <div id = "frm"> 
    <center>
        <form  method="POST">
            <input type="hidden" name="action" value="login" autocomplete="off">
        <table>
            <h1>Login</h1>
             <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                        <img src="pp.png" style="width: 140px; height: 140px" class="img rounded-circle" alt="profile">
                    </div>
               </div>
            <tr>
                <td>Username:</td>
                <td><input type="username" name="username"required/></td>
            </tr>
            
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
             <tr>
                <td></td>
                <td><input type="submit" id = "btn" name="submit" value="submit"></td>
               </tr>
               <p>Not  a user?<a href="register.php"><b>Register</b></a></p>
        </table
      </form>
</center>
</div>
</body>
</html>
<?php
    }
?>
</body>
</html>