<?php
session_start();
if ($_SESSION["pass"]!='worker')
{
  header('Location: index.html');
}
$_SESSION["massagecharge"]="";
$_SESSION["massagecout"]="";
$_SESSION["massageupdate"]="";
$_SESSION["massageaddg"]="";
    $idToDelete = $_POST['pkid'];
    $host = 'localhost'; 
    $user = 'root'; 
    $pass = '';
    $dbName = 'pro1';
    $mysqli = new mysqli($host, $user, $pass, $dbName);
    if($mysqli->connect_error)
    {
        die("Connection Failed");
    }
    $isPost = $_SERVER['REQUEST_METHOD'] == 'POST'; //boolean - true/false
    if (!$isPost)
    {
        die("Connection Failed");
    }
    $delete = "DELETE FROM guests WHERE pkid=".$idToDelete;
    $mysqli->query($delete);
    $mysqli->close();
?>