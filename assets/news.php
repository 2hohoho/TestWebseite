<?php
  $userlist_statement = $pdo->prepare('SELECT * FROM news ORDER BY identity DESC');
  $userlist_statement->execute();

?>
<main class="container">
  <div class="row">
    <span class="col-sm-auto"></span>
    <div class="card text-white bg-dark col" style="margin-top: 100px;">
      <div class="card-header text-center">Aktuelles</div>
      <div class="card-body">
      <?php while($row = $userlist_statement->fetch()) { ?>
        <div class="row">
          <div class="col-sm">
            <div class="float-left">
              <label>Author: </label>
              <?php
                echo($row['ersteller']);
              ?>
            </div>
            <div class="float-right">
              <label>Verfasst: </label>
              <?php
              echo($row['datum']);
              ?>
            </div>
          </div>
        </div>
        <br></br>
        <div class="row">
          <div class="col-sm">
            <?php
            echo($row['news']);
            ?>
          </div>
        </div>
        <p></p>
        <div class="row">
          <div class="col-sm-6 float-right">
            <label>Erkennungsnummer: </label>
            <?php
            echo($row['identity']);
            ?>
          </div>
        </div>
        <br></br>
        <hr></hr>
        <br></br>
      <?php } ?>
      </div>
    </div>
    <span class="col-sm-auto"></span>
  </div>
</main>
