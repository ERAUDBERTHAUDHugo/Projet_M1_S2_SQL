
<link rel="stylesheet" type="text/css" href="View/styleAdminPages.css">

<div id=adminContent>
    <?php
    //var_dump($_FILES["fileToUpload"]);
    
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
        $GroupsInfo=displayTreeViewCheckbox();
        if (isset(array_keys($_POST)[0])){
            displayStudents(array_keys($_POST)[0]);
        }
    }
    ?>

   
</div>





