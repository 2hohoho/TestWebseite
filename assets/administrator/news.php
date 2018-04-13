<?php
if($loggedin == "false") {
  header("Location: /");
}
if(!in_array($loggedin_username, $adminlist)) {
  header("Location: /?message=noPermissions");
}
if(isset($_POST['editor2'])) {
  $message = $_POST['editor2'];
  date_default_timezone_set("Europe/Berlin");
  $timestamp = time();
  $datum = date("d.m.Y H:i",$timestamp);
  $news_statement = $pdo->prepare('INSERT INTO news (ersteller, datum , news) VALUES (:ersteller, :datum,:textarea)');
  $news_statement->bindParam("textarea", $message);
  $news_statement->bindParam("datum", $datum);
  $news_statement->bindParam("ersteller", $loggedin_username);
  $news_statement->execute();

  echo('
  <div class="alert alert-success" role="alert">
    Du hast erfolgreich eine neue News verfasst!
  </div>');
}
?>
<main class="container">
  <div class="row">
    <span class="col-sm-auto"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">News</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>News Verfassen:</label>
            <textarea name="editor2" id="editor2" rows="10" cols="80">
            </textarea>
            <script>
              CKEDITOR.replace( 'editor2' );
            </script>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-outline-success float-right">Posten</button>
          </div>
        </form>
      </div>
    </div>
    <span class="col-sm-auto"></span>
  </div>
</main>
<br></br>
<br></br>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="/textareass/ckeditor/ckeditor.js"></script>
    </meta></head>
    <body>
        <form>
            <script>
              CKEDITOR.replace( 'editor2' );
            </script>
        </form>
    </body>
</html>
