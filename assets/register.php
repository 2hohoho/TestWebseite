<?php
include_once("assets/checkLogin.php");
$username = "";
$email = "";
$password = "";

if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['repeatpassword'])) {
  if($_POST['password'] == $_POST['repeatpassword']) {
    $check_statement = $pdo->prepare('SELECT * FROM users WHERE username LIKE :username');
    $username = $_POST['username'];
    $check_statement->bindParam("username", $username);
    $check_statement->execute();
    $user = $check_statement->fetch();
    if($user['username'] != $username) {
      $register_statement = $pdo->prepare('INSERT INTO users (username,password,email,Rang) VALUES (:username, :password, :email, "User")');

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $register_statement->bindParam("username", $username);
      $register_statement->bindParam("password", $password);
      $register_statement->bindParam("email",$email);

      $register_statement->execute();
      header("Location: /?p=login&message=registered");
    } else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = "";
      echo('
      <div class="alert alert-danger" role="alert">
        Dieser Benutzername existiert bereits!
      </div>');
    }
  } else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = "";
    echo('
    <div class="alert alert-danger" role="alert">
      Die Passwörter stimmen nicht überein!
    </div>');
  }
}
?>
<main class="container">
  <div class="row">
    <span class="col-sm-3"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">Registrieren</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Benutzername</label>
            <input type="text" name="username"class="form-control" id="exampleInputEmail1" placeholder="Benutzername" required value="<?php echo($username); ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">E-Mail</label>
            <input type="email" name="email"class="form-control" id="exampleInputEmail1" placeholder="E-Mail" required value="<?php echo($email); ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Passwort</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Passwort" required value="<?php echo($password); ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputRepeatPassword1">Passwort Wiederholen</label>
            <input type="password" name="repeatpassword" class="form-control" id="exampleInputRepeatPassword1" placeholder="Passwort wiederholen" required value="<?php echo($password); ?>">
          </div>
          <div class="form-group">
            <a href="/?p=login" class="btn btn-outline-success float-left" role="button" aria-disabled="true">Bereits registriert?</a>
            <button type="submit" class="btn btn-outline-danger float-right" id="exampleButtonLogin">Registrieren</button>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-3"></span>
  </div>
</main>
