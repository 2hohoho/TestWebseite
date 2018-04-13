<?php require_once("core.php"); ?>
<?php require_once("assets/footer/foot.php"); ?>
<?php
if(!isset($_SESSION)) {
  session_start();
}
if(isset($_SESSION['username'])) {
  $loggedin = "true";
  $loggedin_username = $_SESSION['username'];
} else {
  $loggedin = "false";
}
require_once("assets/navbar/nologin.php");

if(isset($_GET['message'])) {
  $message = $_GET['message'];
  if($message == "noUser") {
    echo('
    <div class="alert alert-danger" role="alert">
      Dieser Benutzer existiert nicht!
    </div>');
  }
  if($message == "registered") {
    echo('
    <div class="alert alert-success" role="alert">
      Du hast dich erfolgreich registriert!
    </div>');
  }
  if($message == "loggedin") {
    echo('
    <div class="alert alert-success" role="alert">
      Du hast dich erfolgreich angemeldet!
    </div>');
  }
  if($message == "logoutChange") {
    session_destroy();
    $loggedin = "false";
    header("Location: /?message=logouted1");
  }
  if($message == "logout") {
    session_destroy();
    $loggedin = "false";
    header("Location: /?message=logouted");
  }
  if($message == "logouted1") {
    echo('
    <div class="alert alert-success" role="alert">
      Du wurdest ausgeloggt, da du dein Profil bearbeitet hast!
    </div>');
  }
  if($message == "logouted") {
    echo('
    <div class="alert alert-success" role="alert">
      Du hast dich erfolgreich ausgeloggt!
    </div>');
  }
  if($message == "noPermissions") {
    echo('
    <div class="alert alert-danger" role="alert">
      Für diese Seite hast du nicht die Berechtigung!
    </div>');
  }
}
if(isset($_GET['p'])) {
  $seite = $_GET['p'];
} else {
  $seite = "index";
}
?>
<!DOCTYPE html>
<html>
  <header>
    <title><?php echo($title); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </header>
  <body>
    <?php
      include("assets/". $seite . ".php");
    ?>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
