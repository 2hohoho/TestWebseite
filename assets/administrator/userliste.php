<?php
if($loggedin == "false") {
  header("Location: /");
}
if(!in_array($loggedin_username, $adminlist)) {
  header("Location: /?message=noPermissions");
}
  $userlist_statement = $pdo->prepare("SELECT * FROM users");
  $userlist_statement->execute();
?>
<main class="container">
  <div class="row" >
    <span class="col-sm-3"></span>
    <table class="table" style="margin-top: 100px; padding: 0px; background-color:#fff">
      <thead class="thead-dark">
        <tr>
          <th scope="col">User ID</th>
          <th scope="col">Rang</th>
          <th scope="col">Username</th>
          <th scope="col">E-Mail</th>
          <th scope="col">Bearbeiten</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $userlist_statement->fetch()) {?>
          <tr>
            <th scope="row"><?php echo($row['id']); ?></th>
            <th scope="row"><?php if(in_array($row['username'], $adminlist)) { echo("Admin"); } else { echo("User"); } ?></th>
            <td><?php echo($row['username']); ?></td>
            <td><?php echo($row['email']); ?></td>
            <?php if($loggedin_username == $row['username']) { ?>
              <td><a href="/?p=administrator/profile&amp;m=<?php echo($row['username']); ?>" class="btn btn-success float-left disabled" role="button" aria-disabled="true">Bearbeiten</a></td>
            <?php } else { ?>
              <td><a href="/?p=administrator/profile&amp;m=<?php echo($row['username']); ?>" class="btn btn-success float-left" role="button" aria-disabled="true">Bearbeiten</a></td>
            <?php }?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>
