<!DOCTYPE html>
<?php
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}
$_SESSION["massagecharge"]="";
$_SESSION["massagecout"]="";
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>I.T hotel- add guest</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/bootstrap/css/bootstrap_fonts1.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap_fonts2.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">The workers web Site</span>
      <span class="site-heading-lower">I.T Hotel</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">I.T hotel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="fullrooms.php">full rooms</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="emptyrooms.php">empty rooms</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="guestsin.php">guests in</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="guestsout.php">guests out</a>
            </li>
          </ul>
        </ul>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="login.html">login</a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
    <h4 class="text-white d-none d-lg-block">
      <span class="site-heading-lower">Add guest</span>
    </h4>
            <br>
            <form method="POST" action="newguest.php">
                <div class="form-group">
                    <label class="text-white d-none d-lg-block" for="email">Email Address</label>
                    <input required type="email" class="form-control" name="email" id="email" placeholder="Email...">
                </div>
                <div class="form-group">
                    <label class="text-white d-none d-lg-block" for="id">ID</label>
                    <input required minlength="9" maxlength="9" type="text" class="form-control" name="id" id="id" placeholder="ID...">
                </div>
                <div class="form-group">
                    <label class="text-white d-none d-lg-block" for="pname">Phone number</label>
                    <input required minlength="9" type="text" class="form-control" name="pname" id="pname" placeholder="Phone number...">
                </div>
                <button type="submit" class="btn btn-primary center">Add Guest</button>
            </form>
    </div>
    <br>
    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; I.T wed site it's a project created and maintained by Ilan Tal at Etgar Collage. Start Bootstrap website CC BY 3.0.Based on Bootstrap.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

