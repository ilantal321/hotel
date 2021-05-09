<?php
//צד שרת - תקינות קלט:
session_start();
if ($_SESSION["pass"]!='admin')
{
  header('Location: index.html');
}
else{
//נגדיר משתנה בוליאני: אמת או שקר

//isPost = האם הבקשה היא פוסט?
//אמת או שקר
$isPost = $_SERVER['REQUEST_METHOD'] == 'POST'; //boolean - true/false
if (!$isPost)
{
    header('Location: error.html');
}
$isPasswodSet = isset( $_POST["password"]);
$passcheack = $_POST["password"];
$Password = preg_replace('/\s+/', '', $passcheack);
$isPasswordValid = strlen($Password) == 8;
if (!$isPasswodSet ||!$isPasswordValid)
{
    $_SESSION["massageupdatew"]="cheack password";
    header('Location: admin.php ');
}
$isEmailSet = isset( $_POST["email"]);
$emailcheack = $_POST["email"];
$email = preg_replace('/\s+/', '', $emailcheack);
if (!$isEmailSet)
{
    $_SESSION["massageupdatew"]="cheack email";
    header('Location: admin.php ');
}
// אם כל הקלט תקין: פוסט וגם מוגדר שם פרטי, משפחה ואימייל
//אם אחד מהם לא תקין - עבור לדף אחר מבלי להכנס לדטה-בייס
if(!$isPost || !$isPasswodSet || !$isEmailSet || !$isPasswordValid){
    header('Location: admin.php');
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
$qu = 'SELECT * FROM workers WHERE pkid='.$pkid;
$resultu = $mysql->query($qu);

//נגדיר משתנה חדש עבור השורה היחידה שיש בתוצאה
//while הפעם אין לנו צורך בלולאה - אין 
$rowu = $resultu->fetch_array();
if ($rowu['email']==$email)
{
$q = "UPDATE workers
      SET password='$Password', email='$email'
      WHERE pkid=$pkid";
      $_SESSION["massageupdatew"]="worker updated";
//perform the query - ביצוע השאילתה
$mysql->query($q);
}
else
{
    $host = 'localhost'; //https://aws.
        $user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
        $pass = ''; //Strong pass.
        $dbName = 'pro1'; //שם הדטה בייס

        //חיבור בשיטה מונחית עצמים:

        //מונחה עצמים - יוצרים אובייקט
        $mysqli = new mysqli($host, $user, $pass, $dbName);
    $qcheack="SELECT * FROM workers WHERE email='$email'";
        $re= $mysqli->query($qcheack);
        if ($re->num_rows >0)
        {
            $_SESSION["massageupdatew"]="email in the db";
            header('Location: admin.php ');
        }

        else
        {
            if($mysqli->connect_errno){
            header('Location: error.html ');

        }
        else
        {
            $q = "UPDATE workers
            SET password='$Password', email='$email'
            WHERE pkid=$pkid";
            //perform the query - ביצוע השאילתה
            $_SESSION["massageupdatew"]="worker updated";
            $mysql->query($q);
        }
}
}
//go home:
header('location: admin.php');
}
}
?>