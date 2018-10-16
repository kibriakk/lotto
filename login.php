<?php
 
require_once('function.php');
connectdb();
session_start();

if (is_user()) {
    redirect("$baseurl/dashboard");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo $baseurl; ?>/images/fav.png" type="image/png">

  <title>Sign In</title>

  <link href="<?php echo $baseurl; ?>/css/style.default.css" rel="stylesheet">

</head>

                
                <form method="post" action="">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Don't have an Account? <a href="<?php echo $baseurl; ?>/signup"><strong>Sign Up</strong></a></p>
                        



<?php 

if ($_POST){
$username = $_POST['username'];
$password = md5($_POST['password']);

$count = mysql_fetch_array(mysql_unbuffered_query("SELECT COUNT(*) FROM users WHERE username='".$username."' AND password='".$password."'"));
if ($count[0]==1) {
$uu = $_POST['username']; 
$tm = time();
$si = "$uu$tm";
$sid = md5($si);
$_SESSION['sid'] = $sid;
$_SESSION['username'] = $username;
mysql_query("UPDATE users SET sid='".$sid."' WHERE username='".$uu."'");
redirect("$baseurl/dashboard");
}else{
echo '
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
Wrong username or password
</div>';
  }
}
 ?>




                        <?php if (!empty($_GET['error'])): ?>
                                
                                <?php endif ?>
                                
                    <input type="text" class="form-control uname" name="username" placeholder="Username" />  // username field
                    <input type="password" class="form-control pword" name="password" placeholder="Password" />  //password field
               
                    <button class="btn btn-success btn-block">Sign In</button> //sign in button
                    
                </form>
       </body>
