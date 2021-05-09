<?php
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}
$isNumSet = isset( $_POST["echarge"]);
$IDcheack = $_POST["echarge"];
$num = preg_replace('/\s+/', '', $IDcheack);
$ncharge = intval(preg_replace("/[^0-9]+[-]/", "", $num));
$ocharge= $_POST["charge"];
$ccharge=floatval($ncharge)+floatval($ocharge);
$isPost = $_SERVER['REQUEST_METHOD'] == 'POST'; //boolean - true/false
$isCNumberSet = isset( $_POST["echarge"]);

// אם כל הקלט תקין: פוסט וגם מוגדר שם פרטי, משפחה ואימייל
//אם אחד מהם לא תקין - עבור לדף אחר מבלי להכנס לדטה-בייס
if(!$isNumSet )
{
    header('Location: error.html');
}
else
{
if($ccharge < 0  )
{
    $_SESSION["massagecharge"] = "the sub number its bigger then the charge!";
    header('Location: guestsin.php');
}else
{
if(!$isPost )
{
    header('Location: error.html');
}else
{
//הגענו לכאן דרך טופס ששלח אלינו 4 נתונים:
//POST הנתונים הגיעו בבקשת 
$pkid = $_POST['pkid'];
$charge= $_POST["charge"];
$newcharge = floatval($ncharge)+floatval($charge);
//מה נעשה עם הנתונים?
//שאילתת עדכון לדטה-בייס
//נעדכן את פרטי הסטודנט בדטה-בייס
$host = 'localhost';
$user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
$pass = ''; //Strong pass.
$dbName = 'pro1'; //שם הדטה בייס
$mysql = new mysqli($host, $user, $pass, $dbName);//חיבור לשרת
$qg = "UPDATE guests
      SET charge=$newcharge
      WHERE pkid=$pkid";
//perform the query - ביצוע השאילתה
$mysql->query($qg);

//go home:
$_SESSION["massagecharge"] = "charge success!";
header('location: guestsin.php');
}
}
}
?>