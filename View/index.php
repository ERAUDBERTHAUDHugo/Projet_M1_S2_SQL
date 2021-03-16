<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
  <title>Apprendre le SQL avec DD</title>
</head>
<body>

<?php
session_start();

//--------------------------------------Includes-------------------------------

include('header.php');

//----------------------------------------Redirection---------------------------------------

if(!isset($_GET['page'])){
    $page=' ';
    include('main.php');
}
else{
    $page = $_GET['page'];
    switch ($page) {
        case "home":
            include('main.php');
            break;
        case "exercice":
            include('exercice.php');
            break;
        case "login":
            include('login.php');
            break;
        
        default:
            include('main.php');
        break;
        }
    }
include('footer.php')
?>

</body>
</html>
