<?php
session_start();

require('db.php');

if (isset($_POST['username'])){
$username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($mysqli,$username);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($mysqli,$password);
$query = "SELECT * FROM users WHERE username='$username'
and password='".md5($password)."'";
$result = mysqli_query($mysqli,$query) or die(mysql_error());
$rows = mysqli_num_rows($result);
if($rows==1){
	$_SESSION['username'] = $username;
	header("Location: welcome.php");
}else{
	echo "<div class='form'>
<h3>Vos identifiants sont incorrectes.</h3>
<br/>Cliquez ici pour réessayez <a href='login.php'>Se connecter</a></div>";
}
}else{
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="style.css">
	<h1>S'identifier</h1>
	<div class="row">
	<form class="form" action="login.php" method="post">
		<input type="text" name="username" placeholder="Prénom" required />
		<input type="password" name="password" placeholder="Mot de passe" required />
		<input name="login" type="submit" value="Se connecter" class="btn-btn-block btn-primary" />
	</form>
	<p>Pas encore enregister ? <a href='register.php'>S'enregister</a></p>
</div>
<?php } ?>
