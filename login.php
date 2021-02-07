<!--php code for login page -->
<?php
// variable for showing success and error alert 
$login = false;
$showError = false;
// connnecting to the database when request is post request
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["username"] ;
    $password = $_POST["password"] ;
    
    // query for selecing tuples where username is equal to entered usrename
    $sql = "Select * from itlabexerciseusers where username = '$username'";
     $result = mysqli_query($conn, $sql);
     $num = mysqli_num_rows($result);
    //  number of rows is 1 then verify the  password , and starting the session then setting the session cookie and cookies and when login is equal to true redirect into welcome.php
     if ($num == 1){
         while($row = mysqli_fetch_assoc($result)){
             if(password_verify($password,$row['password'])){
                // $login = true;
                session_start();
                $SESSION['cookname'] = "username";
                $SESSION['cookname1'] = "password";
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                if (isset($_POST['checkbox1']))
                {
                    if (isset($_POST['register']))
                    {
                        $_SESSION['value1'] = $_SESSION['username'];
                        $_SESSION['value2'] = $_SESSION['password'];
                        $_SESSION['expiry'] = time()+60*60*24*2;
                        setcookie($_SESSION['cookname'],$_SESSION['value1'],$_SESSION['expiry']);
                        setcookie($_SESSION['cookname1'],$_SESSION['value2'],$_SESSION['expiry']);
                        $login = true;
                        header("location: welcome.php");

                    }
                }
                // header("location: welcome.php");
             }else{
                $showError = "Invalid Credentials";
             }
            
         }
        
        }
        else{
           $showError = "Invalid Credentials";
        }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
    <!-- css for the page -->
    <style>
    @import "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
       body{
          margin:0;
          padding:0;
          font-family:sans-serif;
          background:url(bg.jpg) no-repeat;
          background-size: cover;
       }

       .signup-box{
           width:280px;
           position:absolute;
           top:50%;
           left:50%;
           transform: translate(-50%,-50%);
           color: white;
       }

       .signup-box h1{
           float:left;
           font-size:40px;
           border-bottom:6px solid #4caf50;
           margin-bottom:50px;
           padding: 13px 0;
       }

       .textbox{
           width:100%;
           overflow:hidden;
           font-size: 20px;
           padding:8px 0;
           margin: 8px 0;
           border-bottom: 1px solid #4caf50;

       }

       .textbox i{
           width: 26px;
           float: left;
           text-align:center;

       }

       .textbox input{
           border:none;
           outline:none;
           background:none;
           color:white;
           font-size:18px;
           width:80%;
           float:left;
           margin: 0 10px;
       }

       .btn{
           width:100%;
           background:none;
           border: 2px solid #4caf50;
           color:white;
           padding: 5px;
           font-size: 18px;
           cursor:pointer;
           margin:12px 0;

       }
    </style>
</head>
<body>
<!-- nav bar -->
<?php require '_nav.php' ?>
<!-- for showing success and error alerts -->
<?php 
if($login){
    require "alert.php";
    echo '<div class="alert success">
    <input type="checkbox" id="alert2"/>
    <label class="close" title="close" for="alert2">
  <i class="icon-remove"></i>
</label>
    <p class="inner">
        You are logged in.
    </p>
</div>';
    
}

if($showError){
    require "alert.php";
    echo '<div class="alert error">
    <input type="checkbox" id="alert1"/>
<label class="close" title="close" for="alert1">
  <i class="icon-remove"></i>
</label>
    <p class="inner">
        <strong>Warning!</strong> '.$showError.'
    </p>
</div>';
}
?>
    
    <!-- html for the page -->
    <div class="signup-box">
    <h1>Login</h1>
    <form action="/Question1/login.php" method="post">
    <div class=textbox >
    <i class="fa fa-user" aria-hidden="true"></i>
      <input type="text" placeholder="Username" id="username" name="username" >
    </div>
     
    <div class=textbox >
    <i class="fa fa-lock" aria-hidden="true"></i>
      <input type="password" placeholder="password" id="password" name="password" >

    </div><br>

    <div class="checkbox">
       <label for="remember">Remember Me</label>
       <input type="checkbox" name="checkbox1">
    </div><br>

     
    

    <button type="submit" class="btn" name="register">login</button>
  </form><br>
  <a href="/Question1/forgetpassword.php" style="color:white;">Reset Password !</a><br><br>
    <a href="/Question1/changepass.php" style="color:white;">Change Password !</a>
    </div>
</body>
</html>