<?php
//צד שרת - תקינות קלט:
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}


//נגדיר משתנה בוליאני: אמת או שקר

//isPost = האם הבקשה היא פוסט?
//אמת או שקר
$isPost = $_SERVER['REQUEST_METHOD'] == 'POST'; //boolean - true/false
if (!$isPost)
{
    header('Location: error.html');
}
else{
$isPNumberSet = isset( $_POST["pname"]);
$phonecheack = $_POST["pname"];
$PNumber = preg_replace('/\s+/', '', $phonecheack);
$isPNumberValid = strlen($PNumber) >= 9;
if (!$isPNumberSet ||!$isPNumberValid)
{
    $_SESSION["massageaddg"]="cheack phone number";
    header('Location: guestsout.php ');
}
$isEmailSet = isset( $_POST["email"]);
$emailcheack = $_POST["email"];
$email = preg_replace('/\s+/', '', $emailcheack);
if (!$isEmailSet)
{
    $_SESSION["massageaddg"]="cheack email";
    header('Location: guestsout.php ');
}
$isIDSet = isset( $_POST["id"]);
$IDcheack = $_POST["id"];
$num = preg_replace('/\s+/', '', $IDcheack);
$id = intval(preg_replace("/[^0-9]/", "", $num));
$isIDValid = strlen($id) == 9;
if(!$isIDSet || !$isIDValid )
{
    $_SESSION["massageaddg"]="cheack id";
    header('Location: guestsout.php ');
}

// אם כל הקלט תקין: פוסט וגם מוגדר שם פרטי, משפחה ואימייל
//אם אחד מהם לא תקין - עבור לדף אחר מבלי להכנס לדטה-בייס
if(!$isPNumberSet || !$isIDSet || !$isEmailSet || !$isPNumberValid|| !$isIDValid){
    header('Location: guestsout.php');
}
else
{

        //קבלת הנתונים מהטופס
        $password=rand(1000,9999);
        // 1) ניצור חיבור למאגר הנתונים
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
            $_SESSION["massageaddg"]="email in the db";
            header('Location: guestsout.php ');
        }

        else
        {
            if($mysqli->connect_errno){
            echo '<h1> connection ERROR!!</h1>';

        }
        else
        {
            $qcheack="SELECT * FROM guests WHERE id='$id'";
            $rid= $mysqli->query($qcheack);
            if ($rid->num_rows >0)
            {
                $_SESSION["massageaddg"]="ID in the db";
                header('Location: guestsout.php ');
            }
    
            else
            {
                if($mysqli->connect_errno){
                echo '<h1> connection ERROR!!</h1>';
    
            }
        //התחברנו בהצלחה - אפשר להריץ שאילתה
        //הגדרנו מחרוזת טקסט - q
            $q = "INSERT INTO guests(id, phonenum, email, password)
                VALUES('$id', '$PNumber', '$email', '$password')";
                $_SESSION["massageaddg"]="guest added";
            //נריץ את השאילתה מול הדטה-בייס:
         $mysqli->query($q);

         
         header('location:guestsout.php');
        }
        }
    }
}
}
?>