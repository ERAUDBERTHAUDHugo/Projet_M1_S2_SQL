
<link rel="stylesheet" type="text/css" href="View/styleAdminPages.css">
<div id=adminContent>
    <?php
    include("Controller/displayAdminPages.php");
    if (isset($_GET["func"])){
        if($_GET["func"]=="groupes"){
            displayManageGroups();
            displayButtons("exercices","page principale");
        }elseif($_GET["func"]=="exercices"){
            displayManageExercise();
            displayButtons("groupes","page principale");
        }else{
            header('Location: index.php?page=dashboard');
        }
    }
    else{
        displayButtons("groupes","exercices");
        displayStudents(1,1);
    }
    ?>  
</div>


