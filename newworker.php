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
else
{
$isPasswodSet = isset( $_POST["password"]);
$passcheack = $_POST["password"];
$Password = preg_replace('/\s+/', '', $passcheack);
$isPasswordValid = strlen($Password) == 8;
if (!$isPasswodSet ||!$isPasswordValid)
{
    $_SESSION["massageaddw"]="cheack password";
    header('Location: admin.php ');
}
$isEmailSet = isset( $_POST["email"]);
$emailcheack = $_POST["email"];
$email = preg_replace('/\s+/', '', $emailcheack);
if (!$isEmailSet)
{
    $_SESSION["massageaddw"]="check email";
    header('Location: admin.php ');
}
// אם כל הקלט תקין: פוסט וגם מוגדר שם פרטי, משפחה ואימייל
//אם אחד מהם לא תקין - עבור לדף אחר מבלי להכנס לדטה-בייס
if(!$isPost || !$isPasswodSet || !$isEmailSet || !$isPasswordValid){
    
    header('Location: admin.php');
}
else
{

        //קבלת הנתונים מהטופס
        // 1) ניצור חיבור למאגר הנתונים
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
            $_SESSION["massageaddw"]="email in the db";
            header('Location: admin.php ');
        }

        else
        {
            if($mysqli->connect_errno){
            header('Location: error.html ');

        }
        else
        {
            
        //התחברנו בהצלחה - אפשר להריץ שאילתה
        //הגדרנו מחרוזת טקסט - q
            $q = "INSERT INTO workers(email, password)
                VALUES('$email', '$Password')";

            //נריץ את השאילתה מול הדטה-בייס:
         $mysqli->query($q);

         $_SESSION["massageaddw"]="worker added!";
         header('location:admin.php');
        }
    }
}
}
}
?>