<?php
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}
$isPost = $_SERVER['REQUEST_METHOD'] == 'POST'; //boolean - true/false
if (!$isPost)
{
    header('Location: error.html');
}
else{
$isPNumberSet = isset( $_POST["phonenum"]);
$phonecheack = $_POST["phonenum"];
$PNumber = preg_replace('/\s+/', '', $phonecheack);
$isPNumberValid = strlen($PNumber) >= 9;
if (!$isPNumberSet ||!$isPNumberValid)
{
    $_SESSION["massageupdate"]="Cheack phone number";
    header('Location: guestsin.php ');
}
$isEmailSet = isset( $_POST["email"]);
$emailcheack = $_POST["email"];
$email = preg_replace('/\s+/', '', $emailcheack);
if (!$isEmailSet)
{
    $_SESSION["massageupdate"]="cheake email";
    header('Location: guestsin.php ');
}
$isIDSet = isset( $_POST["id"]);
$IDcheack = $_POST["id"];
$num = preg_replace('/\s+/', '', $IDcheack);
$id = intval(preg_replace("/[^0-9]/", "", $num));
$isIDValid = strlen($id) == 9;
if(!$isIDSet || !$isIDValid )
{
    $_SESSION["massageupdate"]="cheack ID";
    header('Location: guestsin.php ');
}

// אם כל הקלט תקין: פוסט וגם מוגדר שם פרטי, משפחה ואימייל
//אם אחד מהם לא תקין - עבור לדף אחר מבלי להכנס לדטה-בייס
if(!$isPNumberSet || !$isIDSet || !$isEmailSet || !$isPNumberValid|| !$isIDValid){
    header('Location: guestsin.php');
}else{


//הגענו לכאן דרך טופס ששלח אלינו 4 נתונים:
//POST הנתונים הגיעו בבקשת 
$pkid = $_POST['pkid'];
//מה נעשה עם הנתונים?
//שאילתת עדכון לדטה-בייס
//נעדכן את פרטי הסטודנט בדטה-בייס
$host = 'localhost';
$user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
$pass = ''; //Strong pass.
$dbName = 'pro1'; //שם הדטה בייס
$mysql = new mysqli($host, $user, $pass, $dbName);//חיבור לשרת
$qu = 'SELECT * FROM guests WHERE pkid='.$pkid;
$resultu = $mysql->query($qu);

//נגדיר משתנה חדש עבור השורה היחידה שיש בתוצאה
//while הפעם אין לנו צורך בלולאה - אין 
$rowu = $resultu->fetch_array();
if ($rowu['email']==$email && $rowu['id']==$id)
{

//מה נעשה עם הנתונים?
//שאילתת עדכון לדטה-בייס
//נעדכן את פרטי הסטודנט בדטה-בייס
$host = 'localhost';
$user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
$pass = ''; //Strong pass.
$dbName = 'pro1'; //שם הדטה בייס
$mysql = new mysqli($host, $user, $pass, $dbName);//חיבור לשרת
$q = "UPDATE guests
      SET phonenum='$PNumber', id='$id', email='$email'
      WHERE pkid=$pkid";
//perform the query - ביצוע השאילתה
$mysql->query($q);
$_SESSION["massageupdate"]="update success";
}
else if ($rowu['email']!=$email && $rowu['id']==$id)
{
    $host = 'localhost'; //https://aws.
        $user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
        $pass = ''; //Strong pass.
        $dbName = 'pro1'; //שם הדטה בייס

        //חיבור בשיטה מונחית עצמים:

        //מונחה עצמים - יוצרים אובייקט
        $mysqli = new mysqli($host, $user, $pass, $dbName);
    $qcheack="SELECT * FROM guests WHERE email='$email'";
        $re= $mysqli->query($qcheack);
        if ($re->num_rows >0)
        {
            $_SESSION["massageupdate"]="new email in the db";
            header('Location: guestsin.php ');
        }

        else
        {
            if($mysqli->connect_errno){
            header('Location: error.html ');

        }
        else
        {
            $q = "UPDATE guests
            SET phonenum='$PNumber', id='$id', email='$email'
            WHERE pkid=$pkid";
            //perform the query - ביצוע השאילתה
            $mysql->query($q);
            $_SESSION["massageupdate"]="update success";
        }
}
}else if(($rowu['email']==$email && $rowu['id']!=$id))
{
    $host = 'localhost'; //https://aws.
        $user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
        $pass = ''; //Strong pass.
        $dbName = 'pro1'; //שם הדטה בייס

        //חיבור בשיטה מונחית עצמים:

        //מונחה עצמים - יוצרים אובייקט
        $mysqli = new mysqli($host, $user, $pass, $dbName);
    $qcheack="SELECT * FROM guests WHERE id='$id'";
        $re= $mysqli->query($qcheack);
        if ($re->num_rows >0)
        {
            $_SESSION["massageupdate"]="new ID in the db";
            header('Location: guestsin.php');
        }

        else
        {
            if($mysqli->connect_errno){
            header('Location: error.html ');

        }
        else
        {
            $q = "UPDATE guests
            SET phonenum='$PNumber', id='$id', email='$email'
            WHERE pkid=$pkid";
            $_SESSION["massageupdate"]="update success";
            //perform the query - ביצוע השאילתה
            $mysql->query($q);
        }
}
}else if (($rowu['email']!=$email && $rowu['id']!=$id))
{
    $host = 'localhost'; //https://aws.
    $user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
    $pass = ''; //Strong pass.
    $dbName = 'pro1'; //שם הדטה בייס

    //חיבור בשיטה מונחית עצמים:

    //מונחה עצמים - יוצרים אובייקט
    $mysqli = new mysqli($host, $user, $pass, $dbName);
    $qcheack="SELECT * FROM guests WHERE id='$id'";
    $re= $mysqli->query($qcheack);
    if ($re->num_rows >0)
    {
        $_SESSION["massageupdate"]="ID in the db";
        header('Location: guestsin.php');
    }

    else
    {
        if($mysqli->connect_errno){
        header('Location: error.html ');

    }
    else
    {
        $mysqli = new mysqli($host, $user, $pass, $dbName);
        $qcheack="SELECT * FROM guests WHERE email='$email'";
            $re= $mysqli->query($qcheack);
            if ($re->num_rows >0)
            {
                $_SESSION["massageupdate"]="email in the db";
                header('Location: guestsin.php');
            }
    
            else
            {
                if($mysqli->connect_errno){
                header('Location: error.html ');
    
            }
        $q = "UPDATE guests
        SET phonenum='$PNumber', id='$id', email='$email'
        WHERE pkid=$pkid";
        //perform the query - ביצוע השאילתה
        $mysql->query($q);
        $_SESSION["massageupdate"]="update success";
    }
}
}
}
}
//go home:
header('location: guestsin.php');
}

?>