<!-- code for welcome page -->
<?php
// if user not loggedin the redirect into login page 
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
   
}

?>

<!-- html and css for welcome page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome- <?php echo $_SESSION['username'] ?></title>
    <style>
        body{
          margin:0;
          padding:0;
          font-family:sans-serif;
          background:url(bg.jpg) no-repeat;
          background-size: cover;
       }

       p{

       }
    </style>

</head>
<body>
<?php require '_nav.php' ?>
<div class="container">
<p style="color:white;">Welcome- <?php echo $_SESSION['username'] ?></p>
</div>
</body>
</html>

