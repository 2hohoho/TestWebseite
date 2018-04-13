<?php
include_once("checkLogin.php");
if(isset($_POST['username'], $_POST['password'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $login_statement = $pdo->prepare("SELECT * FROM users WHERE username LIKE :username");
  $login_statement->bindParam("username", $username);
  $login_statement->execute();
  $user = $login_statement->fetch();

  if($user != null) {
    if(password_verify($_POST['password'],$user['password'])) {
      $_SESSION['username'] = $user['username'];
      header("Location: /?message=loggedin");
    } else {
      echo('
      <div class="alert alert-danger" role="alert">
        Benutzername oder Passwort ist falsch!
      </div>');
    }
  } else {
    echo('
    <div class="alert alert-danger" role="alert">
      Benutzername oder Passwort ist falsch!
    </div>');
  }
}
?>
<main class="container">
  <div class="row">
    <span class="col-sm-3"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">Anmelden</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Benutzername</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Benutzername" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Passwort</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Passwort" required>
          </div>
          <div class="form-group">
            <a href="/?p=register" class="btn btn-outline-danger float-left" role="button" aria-disabled="true">Noch nicht registriert?</a>
            <button type="submit" class="btn btn-outline-success float-right" id="exampleButtonLogin">Anmelden</button>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-3"></span>
  </div>
</main>
