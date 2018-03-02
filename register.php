<?php

$_SESSION['message'] = '';

$mysqli = new mysqli("localhost", "root", "", "testsolive");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['password'] == $_POST['confirmpassword']) {
    $username = $mysqli->real_escape_string($_POST['username']);

    $name = $mysqli->real_escape_string($_POST['name']);

    $password = md5($_POST['password']);

    $avatar_path = $mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);

    if (preg_match("!image!",$_FILES['avatar']['type'])) {

      if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){

        $_SESSION['username'] = $username;
        $_SESSION['avatar'] = $avatar_path;

        $sql = "INSERT INTO users (username, name, password, avatar) "
        . "VALUES ('$username', '$name', '$password', '$avatar_path')";

        if ($mysqli->query($sql) === true){
            $_SESSION['message'] = "Bienvenue $username !";
            header("location: login.php");
        }
        else {
            $_SESSION['message'] = 'User pas ajouté dans la BDD';
        }
        $mysqli->close();
      }
      else {
        $_SESSION['message'] = 'Echec réessayez ;)!';
      }
    }
    else {
      $_SESSION['message'] = 'S\'il vous plaît seulement télécharger des images GIF, JPG ou PNG !';
    }
  }
  else {
    $_SESSION['message'] = 'Vos deux mots de passes ne correspondent pas !';
  }
}
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="style.css" type="text/css">
<div class="row">
  <h1>S'enregister</h1>
  <form class="form" method="post" action="register.php" enctype="multipart/form-data" autocomplete="off">
    <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
    <input type="text" placeholder="Prénom" name="username" required/>
    <input type="text" placeholder="Nom" name="name" required/>
    <input type="password" placeholder="Mot de passe" name="password" autocomplete="new-password" required/>
    <input type="password" placeholder="Confirmer mot de passe" name="confirmpassword" autocomplete="new-password" required/>
    <div class="avatar"><label>Selectionnez votre avatar : </label><input type="file" name="avatar" accept="image" required/></div>
    <input type="submit" name="register" value="S'enregistrer" class="btn-btn-block btn-primary">
  </form>
  <br>
  <p>Si vous connaisez vos identifiants vous pous vous connectez <a href='login.php'>ici</a></p>
</div>
