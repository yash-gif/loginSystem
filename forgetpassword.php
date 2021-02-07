 <?php
 $showSuccess = false;
 $showError = false;
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
                        
    $username = $_POST['username'] ;
    $phone = $_POST['phone'];

    // if($phone == -1)
                        //     return;
                        
    $get_row = "SELECT * FROM  itlabexerciseusers WHERE username='$username' AND phone='$phone';";
        if(($responce = $conn->query($get_row)) === false){
            // echo $conn->error; echo "<br>";
            // die("Error occured! Abort.");
            $showError = "Error occured! Abbort.";
            
         }

         $output = $responce->fetch_row();
         if($output == NULL){
            //  die("No such entries found!, please try again.");
            $showError = "No such entries found!, please try again.";
         }
         else{
             $random_pass = "yash123456";
             $random_pass = str_shuffle($random_pass);
             $rand_pass_hash = password_hash($random_pass, PASSWORD_DEFAULT);
             $alter = "UPDATE itlabexerciseusers  SET password='$rand_pass_hash' WHERE username='$username' AND phone='$phone';";
                            
             if(($responce = $conn->query($alter)) === false){
                    echo $conn->error; echo "<br>";
                    // die("Error occured in changing pass in DB! Abort.");
                    $showError = "Error occured in changing pass in DB! Abort.";
                     }

            // echo "Your new password is ".$random_pass;
            $showSuccess = "Your password is ".$random_pass;
             }
            }                        
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
<?php require '_nav.php' ?>
<?php 
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

    

    <div class="signup-box">
    <h1>Password Reset</h1>
    <form action="/Question1/forgetpassword.php" method="post">
    <div class=textbox >
    <i class="fa fa-user" aria-hidden="true"></i>
      <input type="text" placeholder="Username" id="username" name="username" >
    </div>
     
    <div class=textbox >
    <i class="fa fa-phone" aria-hidden="true"></i>
      <input type="text" placeholder="phone number" id="phone" name="phone" >
    </div> 
   

    
  
     
     
    

    <button type="submit" class="btn">change password</button>
  </form>
  
    </div>
</body>
</html>