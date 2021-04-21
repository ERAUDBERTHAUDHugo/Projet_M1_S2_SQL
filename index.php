<!DOCTYPE html>
<html lang="en" dir="ltr" style='position:relative'>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="View/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
    <script src="Controller\adminFonctionsJs"></script>

    <title>Plateforme d'apprentissage de la BDD</title>
</head>
<body>

<?php
session_start();

//--------------------------------------Includes-------------------------------

include("Controller/bddManagement.php");
include("Controller/PDOFactory.php");
include("Controller/connectionRegisterCheck.php");
include('View/header.php');
include("Controller/displayExercice.php");
//exportDatabaseV2('localhost','root','','db_project','DatabaseBackup\mydata.sql');
//------------------------------------LogOut-------------------------------------------
if(isset($_POST["disconnect"])){
    disconnect();
}

if($_GET["page"]!="exercice"){
    $_SESSION["question"]=-1;
}
//var_dump($_SESSION);
//------------------------------------Redirection---------------------------------------


if(isset($_SESSION['connected'])){
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
            case "dashboard": // faire la diff entre admin et étudiant ( if en fonction du user. A implémenter à la fin pour faciliter le developpement)
                include('View/dashboard.php');
                break;
            case "adminDashboard":
                include("View/adminDashboard.php");
                break;
            default:
                include('View/main.php');
            break;
        }
    }
}else{// Acces au site seulement une fois que l'on est connecté
    include('View/login.php');
}
//include('View/footer.php');
?>

</body>
</html>
