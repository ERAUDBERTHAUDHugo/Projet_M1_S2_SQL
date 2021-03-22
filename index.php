<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="View/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
  <title>Apprendre la BDD avec DD</title>
</head>
<body>


<?php
session_start();

//--------------------------------------Includes-------------------------------

include("Controller/PDOFactory.php");
include('View/header.php');
include("Controller/connectionRegisterCheck.php");

//------------------------------------Redirection---------------------------------------

if(!isset($_GET['page'])){
    $page=' ';
    include('View/main.php');
}
else{
    $page = $_GET['page'];
    switch ($page) {
        case "home":
            include('View/main.php');
            break;
        case "exercice":
            include('View/exercice.php');
            break;
        case "login":
            include('View/login.php');
            break;
            case "register":
                include('View/register.php');
                break;
        default:
            include('View/main.php');
        break;
        }
    }
include('View/footer.php')
?>

</body>
</html>
