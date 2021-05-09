<?php
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}
$_SESSION["massagecout"]="";
$_SESSION["massageaddg"]="";
$host = 'localhost'; //https://aws.
$user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
$pass = ''; //Strong pass.
$dbName = 'pro1'; //שם הדטה בייס

 //1) new mysqli() 
$mysql = new mysqli($host, $user, $pass, $dbName);

 //2) mysqli->query
 $q = 'SELECT * FROM guests WHERE roomnum!="0"';

 $result = $mysql->query($q);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>I.T hotel- guests in</title>

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
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="guestsin.php">guests in</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="guestsout.php">guests out</a>
            </li>
          </ul>
        </ul>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="logout.php">logout</a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
                <h1 class="site-heading text-center text-white d-none d-lg-block">
                    <span class="site-heading-upper text-primary mb-3">Guests In</span>
                    <span class="massage"><?php echo $_SESSION["massagecharge"] ;?></span>
                    <span class="massage"><?php echo $_SESSION["massageupdate"] ;?></span>
                </h1>
            <table class="table tac">
                <tr>
                    <th>pkid</th>
                    <th>id</th>
                    <th>email</th>
                    <th>password</th>
                    <th>charge</th>
                    <th>phone number</th>
                    <th>room number</th>
                    <th>check out</th>
                    <th>add charge</th>
                    <th>update</th>
                </tr>
                <?php
                //נציג את כל הסטודנטים הקיימים במכללה בתוך טבלה, בעזרת while loop
                    include 'guest.php';
                    //Cursor: נותן כל פעם את השורה הבאה
                    //fetch-array()-> מביא את השורה הבאה
                    //הלולאה נעצרת כשאין ערך
                    while($row = $result->fetch_array()){
                        // שורה במאגר נתונים הופכת לסטודנט, יוצרים מופע חדש של סטודנט כל שורה
                        $guest = new Guest($row['pkid'], $row['id'], $row['email'], $row['password'], $row['charge'], $row['phonenum'], $row['roomnum']);
                        echo "<tr>";
                        echo "<td>".$guest->pkid."</td>";
                        echo "<td>".$guest->id."</td>";
                        echo "<td>".$guest->email."</td>";
                        echo "<td>".$guest->password."</td>";
                        echo "<td>".$guest->charge."</td>";
                        echo "<td>".$guest->pnumber."</td>";
                        echo "<td>".$guest->roomnumber."</td>";
                        echo "<td>
                        <a href='cout.php?id=$guest->pkid'><img width='30' src='img/cout.png'></a>
                        </td>";
                        echo "<td> <a href='addcharge.php?id=$guest->pkid'><img width='30' src='img/add.png'></a> 
                        </td>";
                        echo "<td> <a href='updateguest.php?id=$guest->pkid'><img width='30' src='img/update.png'></a>
                     </td>";
                        echo "</tr>";

                    }
                ?>
            </table>
    </div>
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

