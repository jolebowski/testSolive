<?php
include("auth.php");
?>
<link rel="stylesheet" href="style.css">

<div class="body content">
<p>Si vous souhaitez vous déconnectez cliquez <a class="right-align" href="logout.php">ici</a></p>

  <div class="welcome">
      <br>
      <img src="<?= $_SESSION['avatar'] ?>"><br><br>
      Bienvenue a toi  <span class="user"><?= $_SESSION['username'] ?></span>
      <?php
      $mysqli = new mysqli("localhost", "root", "", "testsolive");
      $sql = "SELECT username, avatar FROM users";
      $result = $mysqli->query($sql);
      ?>
      <div id='registered'>
      <span>Voici tous les utilisateurs authentifiés:</span>
      <?php
      while($row = $result->fetch_assoc()){
          echo "<div class='userlist'><span>$row[username]</span><br />";
          echo "<img src='$row[avatar]'></div>";
      }
      ?>
      </div>
  </div>
</div>
