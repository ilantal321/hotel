<?php
session_start();
$_SESSION["massageupdatew"]="";
$_SESSION["massageaddw"]="";
if ($_SESSION["pass"]!='admin')
{
  header('Location: index.html');
}
//מהבקשה idנקבל את ה
$pkid = $_GET['id'];

//נאחזר את הסטודנט מהדטה-בייס
$host = 'localhost'; //https://aws.
$user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
$pass = ''; //Strong pass.
$dbName = 'pro1'; //שם הדטה בייס
$mysql = new mysqli($host, $user, $pass, $dbName);
$q = 'SELECT * FROM workers WHERE pkid='.$pkid;
$result = $mysql->query($q);

//נגדיר משתנה חדש עבור השורה היחידה שיש בתוצאה
//while הפעם אין לנו צורך בלולאה - אין 
$row = $result->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>I.T hotel- update worker</title>

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
      <span class="site-heading-upper text-primary mb-3">The admin web Site</span>
      <span class="site-heading-lower">I.T Hotel</span>
    </h1>

    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">I.T hotel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        </ul>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="logout.php">logout</a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navigation -->
    <div class="container">
    <form method="POST" action="updatew.php">

    <div class="form-group">
        <label class="text-white d-none d-lg-block" for="email">Email Address</label>
        <input required type="email" value="<?php echo $row['email'];?>" class="form-control" name="email" id="email" placeholder="Email Address...">
    </div>
    <div class="form-group">
        <label class="text-white d-none d-lg-block" for="password">Password</label>
        <input required minlength="8" maxlength="8" type="password" value="<?php echo $row['password'];?>" class="form-control" name="password" id="password" placeholder="password...">
    </div> 
    <input type="hidden" value="<?php echo $row['pkid'];?>" class="form-control" name="pkid" id="pkid" placeholder="pkid...">
    <button type="submit" class="btn btn-primary center">Update</button>
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

