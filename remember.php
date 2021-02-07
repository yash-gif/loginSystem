<?php
session_start();
include ('_dbconnect.php');
if (isset($_REQUEST['username']) || isset($_REQUEST['password']))
{
    $uname = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    $_SESSION['uname'] = $uname;
    $_SESSION['pass'] = $pass;
    $_SESSION['pass'] = md5($_SESSION['pass']);
    $sql = "select * from itlabexcerciseusers where username = '$_SESSION[uname]' and password = '$_SESSION[pass]'";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 1)
    {
        $_SESSION['cookname'] = 'Username';
        $_SESSION['cookname1'] = 'Password';
        if (isset($_REQUEST['checkbox1']))
        {
            if (isset($_REQUEST['register']))
            {
                $_SESSION['value1'] = $_SESSION['uname'];
                $_SESSION['value2'] = $_SESSION['pass'];
                $_SESSION['expiry'] = time()+60*60*24*2;
                setcookie($_SESSION['cookname'],$_SESSION['value1'],$_SESSION['expiry']);
                setcookie($_SESSION['cookname1'],$_SESSION['value2'],$_SESSION['expiry']);
                echo "<script>alert('Login Successfull!!!, Welcome $_SESSION[uname] And I Will Remember You When You Back');window.location.href='reg_form.php';</script>";
            }
        }
        else if (isset($_REQUEST['logout']))
        {
                $_SESSION['value1'] = $_SESSION['uname'];
                $_SESSION['value2'] = $_SESSION['pass'];
                $_SESSION['expiry'] = time()- 60*60*24*2;
                setcookie($_SESSION['cookname'],$_SESSION['value1'],$_SESSION['expiry']);
                setcookie($_SESSION['cookname1'],$_SESSION['value2'],$_SESSION['expiry']);
                echo "<script>alert('Logout Successfull!!!, $_SESSION[uname]');window.location.href='remember.php';</script>";
        }
        else if (isset($_REQUEST['register']))
        {
            echo "<script>alert('Login Successfull!!!, Welcome $_SESSION[uname] And I Will Not Able To Remember You');window.location.href='reg_form.php';</script>";
        }
            
    }
     else {
        echo "<script>alert('OPPS,Invalid UserName Or Password!!!');window.location.href='remember_login.php';</script>";
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>

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

    

    <div class="signup-box">
    <h1>Login</h1>
    <form action="/Question1/remember.php" method="post">
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

     
    <button type="submit" class="btn" name="logout">logout</button>
    
    <button type="submit" class="btn" name="register">login</button>
  </form><br>
  
    </div>
</body>
</html>