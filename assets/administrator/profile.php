<?php
if($loggedin == "false") {
  header("Location: /");
}
if(!in_array($loggedin_username, $adminlist)) {
  header("Location: /?message=noPermissions");
}
$changeUser = $_GET['m'];
if(isset($_GET['m'])) {
  if($_GET['m'] != "") {
  } else {
    header("Location: /?p=administrator/userliste&message=noUser");
    echo('
    <div class="alert alert-danger" role="alert">
      Den Benutzer gibt es nicht!
    </div>');
  }
}

$user_statement = $pdo->prepare("SELECT * FROM users WHERE username LIKE :Benutzername");
$user_statement->bindParam("Benutzername", $changeUser);
$user_statement->execute();
$user = $user_statement->fetch();
if(isset($_POST['email'])) {
  $email = $_POST['email'];
  $user_statement = $pdo->prepare("UPDATE users SET email = :value WHERE username LIKE :username");
  $user_statement->bindParam("value", $email);
  $user_statement->bindParam("username", $changeUser);
  $user_statement->execute();
  header("Location: /?p=administrator/profile&m=" . $_GET['m']);
}
if(isset($_POST['password'], $_POST['password1'])) {
  $password = $_POST['password'];
  $password1 = $_POST['password1'];
  if($password == $password1) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $user_statement = $pdo->prepare("UPDATE users SET password = :value WHERE username LIKE :username");
    $user_statement->bindParam("value", $password);
    $user_statement->bindParam("username", $changeUser);
    $user_statement->execute();
    header("Location: /?p=administrator/profile&m=" . $_GET['m']);
  } else {
    echo('
    <div class="alert alert-danger" role="alert">
      Das Passwort konnte nicht geändert werden, da die Passwörter nicht übereinstimmen!
    </div>');
  }
}
?>
<main class="container">
  <div class="row">
    <span class="col-sm-auto"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">Rang</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Rang:</label>
            <label class="form-control"><?php if(in_array($changeUser, $adminlist)) { echo("Administrator"); } else { echo("User"); } ?></label>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-auto"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">Benutzername ändern</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Benutzername:</label>
            <label class="form-control"><?php echo($user['username']); ?></label>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-auto"></span>
</main>
<main class="container">
  <div class="row">
    <span class="col-sm-auto"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">E-Mail ändern</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Alte E-Mail:</label>
            <label class="form-control"><?php echo($user['email']); ?></label>
            <label for="email1">Neue E-Mail:</label>
            <input type="email" id="email1" name="email" class="form-control" placeholder="E-Mail" required>
          </div>
          <div class="form-group">
            <button type="submit" id="exampleButtonLogin1" class="btn btn-outline-success float-right">Speichern</button>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-auto"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">Passwort ändern</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Altes Passwort:</label>
            <label type="password" class="form-control">••••••••••</label>
            <label>Neues Passwort:</label>
            <input type="password" name="password" class="form-control" placeholder="Passwort" required>
            <label>Neues Passwort Wiederholen:</label>
            <input type="password" name="password1" class="form-control" placeholder="Passwort" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-outline-success float-right">Speichern</button>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-auto"></span>
  </div>
</main>
<br></br>
