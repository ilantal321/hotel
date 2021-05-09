<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
$host = 'localhost'; //https://aws.
$user = 'root'; //מסיבות אבטחה - כדאי לבחור שם אחר
$pass = ''; //Strong pass.
$dbName = 'pro1'; //שם הדטה בייס
session_start();
$_SESSION["massageupdatew"]="";
$_SESSION["massageaddw"]="";
$_SESSION["massagecharge"]="";
$_SESSION["massagecout"]="";
$_SESSION["massageupdate"]="";
$_SESSION["massageaddg"]="";
 //1) new mysqli() 
$mysqli = new mysqli($host, $user, $pass, $dbName);
if($mysqli->connect_error){
    //מציג שגיאה
    die("Connection Failed");
}
    $email = $_POST['email'];
    $password = $_POST['password'];
    $SQL = "SELECT * FROM workers
    WHERE email = '$email'
    AND password = '$password'"; 
    
    //echo $SQL; בדיקה
    //נריץ את השאילתה
    $result = $mysqli->query($SQL);

    //var_dump($result); בדיקה
    // אם יש תשובה וגם מס' השורות בתשובה הוא 1 
    //כלומר יש בדיוק משתמש אחד עם אותה סיסמא ואימייל
    if($result && $result->num_rows == 1){
        if($email=='ilan.tal@gmail.com' && $password=='aaaaaaaa')
        {
            $_SESSION["pass"]="admin";
            header('Location: admin.php');
        }
        else{
            $_SESSION["pass"]="worker";
        header('Location: guestsout.php');
        }
    }else{
        header('Location: login.php');
    }
}else
{
    header('Location: error.html');
}
?>