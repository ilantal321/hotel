<?php
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}
$isPost = $_SERVER['REQUEST_METHOD'] == 'POST'; //boolean - true/false

// אם כל הקלט תקין: פוסט וגם מוגדר שם פרטי, משפחה ואימייל
//אם אחד מהם לא תקין - עבור לדף אחר מבלי להכנס לדטה-בייס
if(!$isPost){
    header('Location: error.html');
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
$qg = "UPDATE guests
      SET roomnum='0', charge='0'
      WHERE pkid=$pkid";
$qr = "UPDATE rooms
      SET state='empty', gpkid='0'
      WHERE gpkid=$pkid";
//perform the query - ביצוע השאילתה
$mysql->query($qr);
$mysql->query($qg);
session_start();
$_SESSION["massagecout"]="cheack out success!";
//go home:
header('location: guestsout.php');
}
?>