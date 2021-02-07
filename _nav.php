<!-- code for the nav bar -->
<?php

// if user is loggedin then only home and logout displays in nav bar and if user not loggedin then home , register and login displays
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true; 
    
}
else{
    $loggedin = false;
}
echo '<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}
</style>
</head>
<body>

<ul>
<li><a class="active" href="/Question1/login.php">iSecure</a></li>

<li><a href="/Question1/welcome.php">Home</a></li>';

if(!$loggedin){
  echo'<li><a href="/Question1/reg_form.php">Register</a></li>
  <li><a href="/Question1/login.php">Login</a></li>';
}
  if($loggedin){
  echo '<li><a href="/Question1/logout.php">Logout</a></li>';
  }
 
  
echo '</ul>

</body>
</html>';
?>