<!-- code for logout page -->
<?php
// when user logout then delete the set cookie and destroy the session and redirect into login page.
session_start();

$_SESSION['value1'] = $_SESSION['username'];
$_SESSION['value2'] = $_SESSION['password'];
$_SESSION['expiry'] = time()- 60*60*24*2;
setcookie($_SESSION['cookname'],$_SESSION['value1'],$_SESSION['expiry']);
setcookie($_SESSION['cookname1'],$_SESSION['value2'],$_SESSION['expiry']);
session_unset();
session_destroy();

header("location: login.php");
exit;

?>