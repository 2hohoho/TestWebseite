<body class="bg-secondary">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">2hohoho.de</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-0">
        <li class="nav-item active">
          <a class="nav-link" href="/">Startseite</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/?p=news">News</a>
        </li>
      </ul>
      <?php if($loggedin == "false") { ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/?p=login">Login</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/?p=register">Registrieren</a>
          </li>
        </ul>
      <?php } else { ?>
        <ul class="navbar-nav mr-0">
          <?php if(in_array($loggedin_username, $adminlist)) {?>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administration
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/?p=administrator/userliste">Userliste</a>
                <a class="dropdown-item" href="/?p=administrator/news">News Verfassen</a>
              </div>
            </li>
          <?php } ?>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if(in_array($loggedin_username, $adminlist)) {?>
            <li class="nav-item active">
              <a class="nav-link" href="/?p=profile&amp;m=<?php echo($loggedin_username); ?>">Admin: <?php echo($loggedin_username); ?></a>
            </li>
          <?php } else  {?>
            <li class="nav-item active">
              <a class="nav-link" href="/?p=profile&amp;m=<?php echo($loggedin_username); ?>">User: <?php echo($loggedin_username); ?></a>
            </li>
          <?php } ?>
          <li class="nav-item active">
            <a class="nav-link" href="/?message=logout">Abmelden</a>
          </li>
        </ul>
      <?php }?>
    </div>
  </nav>
</body>
