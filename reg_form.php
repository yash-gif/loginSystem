<!-- code for registration page -->
<?php
// variable for showing success and error alerts
$showalert = false;
$showError = false;
// if request id post request then connecting with the database
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $username = $_POST["username"] ?? 'undefined';
    $password = $_POST["password"] ?? 'undefined';
    $cpassword = $_POST["cpassword"] ?? 'undefined';
    $mobile = $_POST["phone"] ?? 'undefined';
    
    // check whether username exists
    $existSql = "Select * from itlabexerciseusers where username = '$username'";
    $result = mysqli_query($conn,$existSql);
    $numExistRows = mysqli_num_rows($result);
    // if number of rows is greater then 0 then it means user alredy exists
    if($numExistRows > 0){
        
        $showError = "Username Already Exists!";
    }
    else{
        // verifying the passwords and then converting into hash and inserting into the database 
        if(($password == $cpassword) && $password != null){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `itlabexerciseusers` ( `username`, `password`, `phone`, `dt`) VALUES ( '$username', '$hash', '$mobile', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showalert = true;
                $showUsername = $username;
                $mobileNo = $mobile;
            }
        }
        else{
            $showError = "Password do not match Please fill correct details";
        }
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
<!-- code for showing success and error alerts  -->
<?php 
if($showalert){
    require "alert.php";
    echo '<div class="alert success">
    <input type="checkbox" id="alert2"/>
    <label class="close" title="close" for="alert2">
  <i class="icon-remove"></i>
</label>
    <p class="inner">
        '. $showUsername.' account is now created with mobile no. '.$mobileNo.' and you can login.
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
    
    <!-- html for this page -->
    <div class="signup-box">
    <h1>Signup</h1>
    <form action="/Question1/reg_form.php" method="post">
    <div class=textbox >
    <i class="fa fa-user" aria-hidden="true"></i>
      <input type="text" placeholder="Username" id="username" name="username" >
    </div>
     
    <div class=textbox >
    <i class="fa fa-lock" aria-hidden="true"></i>
      <input type="password" placeholder="password" id="password" name="password" >
    </div>

     <div class=textbox >
    <i class="fa fa-lock" aria-hidden="true"></i>
      <input type="password" placeholder="confirm password" id="cpassword" name="cpassword" >
    </div> 
     
    <div class=textbox >
    <i class="fa fa-phone" aria-hidden="true"></i>
      <input type="text" placeholder="phone number" id="phone" name="phone" >
    </div> 

    <button type="submit" class="btn">SignUp</button>
  </form>
    </div>
</body>
</html>