<!-- php code for the changing the current password with the new password -->
<?php
// variable for showing the success or error messages initially both contains false.
$showSuccess = false;
$showError = false;

// if request is POST then connecting with the database
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
 
 $username = $_POST['username'] ;
 $cpassword = $_POST['cpassword'] ;
 $npassword = $_POST['npassword'] ;
 
 // query for selecting qll tuples whose username is equal to entered username 
 $get_row = "SELECT * FROM itlabexerciseusers WHERE username='$username';";
//  code for handle the error in executing the above query
 if(($responce = $conn->query($get_row)) === false){
     echo $conn->error; echo "<br>";
        die("Error occured! Abort.");
 }

 $output = $responce->fetch_row();
//  echo "output is".$output;
// code for if no such entry found in the database
 if($output == NULL){
     $showError = "No such entries found!, please try again.";
 }
 else{ 
        // code for verifying the current password
        if(password_verify($cpassword, $output[1])){
            $showError = "Incorrect current password.";
        }
        // converting new password into hash
        $npassword_hash = password_hash($npassword, PASSWORD_DEFAULT);
        // query for updating the current password with the new password
        $alter = "UPDATE itlabexerciseusers SET password='$npassword_hash' WHERE username='$username'";
        
        // code for if an error comes in changing the password
        if(($responce = $conn->query($alter)) === false){
            echo $conn->error; echo "<br>";
            $showError = "Error occured in changing pass in DB! Abort.";
        }
        
        // success message password changed successfully as a dismissable alert
        $showSuccess =  "Password changed successfully";
    }
}
                        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    
    <!-- css for this page -->
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
<!-- code for the dismissable alert -->
<?php 
// code for showing the success alert
if($showSuccess){
    require "alert.php";
    echo '<div class="alert success">
    <input type="checkbox" id="alert2"/>
    <label class="close" title="close" for="alert2">
  <i class="icon-remove"></i>
</label>
    <p class="inner">
    <strong>Success!</strong> '.$showSuccess.'
    </p>
</div>';
    
}
// code for showing the warning alert
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
    
    <!-- html code -->
    <div class="signup-box">
    <h1>Change Password</h1>
    <form action="/Question1/changepass.php" method="post">
    <div class=textbox >
    <i class="fa fa-user" aria-hidden="true"></i>
      <input type="text" placeholder="Username" id="username" name="username" >
    </div>
     
    <div class=textbox >
    <i class="fa fa-lock" aria-hidden="true"></i>
      <input type="password" placeholder="current password" id="password" name="cpassword" >

    </div>

    <div class=textbox >
    <i class="fa fa-lock" aria-hidden="true"></i>
      <input type="password" placeholder="New password" id="password" name="npassword" >

    </div>
   
     
    

    <button type="submit" class="btn">Change Password</button>
  </form>
  
    </div>
</body>
</html>