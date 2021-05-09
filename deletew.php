<?php
session_start();
if ($_SESSION["pass"]!='admin')
{
  header('Location: index.html');
}
else{
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
    $delete = "DELETE FROM workers WHERE pkid=".$idToDelete;
    $mysqli->query($delete);
    $mysqli->close();
}
?>