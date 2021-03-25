<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="View/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
  <title>Plateforme d'apprentissage de la BDD</title>
</head>
<body>


<?php
session_start();

//--------------------------------------Includes-------------------------------


include("Controller/bddManagement.php");
include("Controller/PDOFactory.php");
include('View/header.php');
include("Controller/connectionRegisterCheck.php");
include("Controller/displayExercice.php");


//------------------------------------Redirection---------------------------------------
var_dump($_SESSION);
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
        case "dashboard":
            include('View/dashboard.php');
            break;
        default:
            include('View/main.php');
        break;
    }
}

include('View/footer.php');

//disconnect();

?>

</body>
</html>
